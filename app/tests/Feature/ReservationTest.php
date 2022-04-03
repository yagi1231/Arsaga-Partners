<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\models\Reservation;
use App\User;
use Illuminate\Support\Facades\Artisan;

class ReservationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp(): void
    {
       parent::setUp();
       // テストユーザ作成
       Artisan::call('migrate:refresh');
       Artisan::call('db:seed');
       $this->user = factory(User::class)->create();  
       $response = $this->actingAs($this->user);
    }

    public function test_一覧画面表示確認()
    {
        $response = $this->get('reservations/index');

        $response->assertStatus(200);
        
        $response->assertSeeText('埼玉');
    }

    public function test_詳細ページ確認()
    {
        $response = $this->get('/reservations/1');

        $response->assertStatus(200);

        $response->assertSeeText('埼玉');

        $response = $this->get('/reservations/8');//存在しないときの確認

        $response->assertStatus(404);
    }

    public function test_新規作成への確認()
    {
        $response = $this->get('/reservations/create');

        $response->assertStatus(200);

        $data = [
             'name' => 'testname',
             'address' => 'ddd@gmail.com', 
             'telnum' => '08098789765',
             'remarks' =>'特になし', 
             'time' => '2022/04/01',
             'backtime' =>'11:00', 
             'category' => ' KOUCH',
             'categoryname' => '企業', 
             'order' =>  'ステーキ', 
             'image' => "",
             'price' => '880',
             'task' => '準備中',
             'sumprice' => '880',
             'status' => 1
        ];

        $this->assertDatabaseMissing('reservations', $data);
 
        $response = $this->post('reservations/store', $data);

        $response->assertStatus(302)
            ->assertRedirect('reservations/index');
        
        $this->assertDatabaseHas('reservations', ['address' => 'ddd@gmail.com']);
    }

    public function test_新規作成バリデーション確認()
    {
        $response = $this->get('/reservations/create');

        $response->assertStatus(200);

        $data = [
            'address' => 'ddd@gmail.com', 
        ];

        $this->assertDatabaseMissing('reservations', $data);
 
        $response = $this->post('reservations/store', $data);

        $response->assertStatus(302)
            ->assertRedirect('reservations/create');
        
        $this->assertDatabaseMissing('reservations',$data);
    }

    public function test_更新確認()
    {
        $data = factory(Reservation::class)->create();

        $response = $this->get(route('edit', $data->id));

        $response->assertStatus(200);

        $update_data =
        [
            'name' => 'test_names',
             'address' => 'fff@gmail.com', 
             'telnum' => '07089762765',
             'remarks' =>'あり', 
             'time' => '2022/04/02',
             'backtime' =>'13:00', 
             'category' => '大戸屋',
             'categoryname' => '民家', 
             'order' =>  '肉じゃが', 
             'price' => '680',
     
        ];

        $this->assertDatabaseMissing('reservations', $update_data);

        $update_url = route('reservations.update', $data->id);

        $response = $this->put($update_url, $update_data);
    
        $response->assertStatus(302)
            ->assertRedirect('reservations/edit/8');

        $this->assertDatabaseHas('reservations', ['address' => 'eee@gmail.com']);
    }

    public function test_削除確認()
    {
        $data = factory(Reservation::class)->create();

        $this->assertDatabaseHas('reservations', ['id' => $data->id]);

        $data =  Reservation::where('id', $data->id)->update([
            'status' => '2'
        ]);

        $response = $this->get('reservations/index');

        $response->assertStatus(200);
        
        $response->assertDontSeeText('reservations', ['address' => 'eee@gmail.com']);
    }
}