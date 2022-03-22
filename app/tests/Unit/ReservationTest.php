<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\models\Reservation;
use App\User;
use Illuminate\Support\Facades\Artisan;

class ReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void
    {
       parent::setUp();
       // テストユーザ作成
       $this->user = factory(User::class)->create();  
       $response = $this->actingAs($this->user);
       $response = $this->get('/reservations/create');
    }
    
    public function test_名前のバリデーション確認()
    {
        $data = 
        [
            'address' => 'ddd@gmail.com', 
            'telnum' => '08098789765',
            'time' => '2022/04/01',
            'backtime' =>'11:00', 
            'category' => ' KOUCH',
            'categoryname' => '企業', 
            'order' =>  'ステーキ', 
            'sumprice' => '880',
        ];

        $response = $this->post('reservations/store', $data);

        $response->assertSessionHasErrors(['name' => '名前は必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('reservations/create');
    }

    public function test_住所のバリデーション確認()
    {
        $data = 
        [
            'name' => 'test', 
            'telnum' => '08098789765',
            'time' => '2022/04/01',
            'backtime' =>'11:00', 
            'category' => ' KOUCH',
            'categoryname' => '企業', 
            'order' =>  'ステーキ', 
            'sumprice' => '880',
        ];

        $response = $this->post('reservations/store', $data);
   
        $response->assertSessionHasErrors(['address' =>  '住所は必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('reservations/create');
    }

    public function test_電話番号のバリデーション確認()
    {
        $data = 
        [
            'name' => 'test', 
            'address' => 'ddd@gmail.com',
            'time' => '2022/04/01',
            'backtime' =>'11:00', 
            'category' => ' KOUCH',
            'categoryname' => '企業', 
            'order' =>  'ステーキ', 
            'sumprice' => '880',
        ];

        $response = $this->post('reservations/store', $data);

        $response->assertSessionHasErrors(['telnum' => '電話番号は必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('reservations/create');
    }

    public function test_電話番号の正規表現確認()
    {
        $data = 
        [
            'telnum' => '090',
            'name' => 'test', 
            'address' => 'ddd@gmail.com',
            'time' => '2022/04/01',
            'backtime' =>'11:00', 
            'category' => ' KOUCH',
            'categoryname' => '企業', 
            'order' =>  'ステーキ', 
            'sumprice' => '880',
        ];

        $response = $this->post('reservations/store', $data);

        $response->assertSessionHasErrors(['telnum' => '電話番号は10桁から11桁の間で指定してください。']);

        $response->assertStatus(302)
            ->assertRedirect('reservations/create');
    }

    public function test_注文のバリデーション確認()
    {
        $data = 
        [
            'name' => 'test', 
            'address' => 'ddd@gmail.com', 
            'telnum' => '08098789765',
            'time' => '2022/04/01',
            'backtime' =>'11:00', 
            'category' => ' KOUCH',
            'categoryname' => '企業', 
            'sumprice' => '880',
        ];

        $response = $this->post('reservations/store', $data);

        $response->assertSessionHasErrors(['order' => '注文は必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('reservations/create');
    }

    public function test_日付のバリデーション確認()
    {
        $data = 
        [
            'name' => 'test', 
            'address' => 'ddd@gmail.com', 
            'telnum' => '08098789765',
            'backtime' =>'11:00', 
            'category' => ' KOUCH',
            'categoryname' => '企業', 
            'sumprice' => '880',
            'order' => 'ステーキ',
        ];

        $response = $this->post('reservations/store', $data);
   
        $response->assertSessionHasErrors(['time' =>  '日付は必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('reservations/create');
    }

    public function test_合計金額のバリデーション確認()
    {
        $data = 
        [
            'name' => 'test', 
            'address' => 'ddd@gmail.com', 
            'telnum' => '08098789765',
            'time' => '2022/04/01',
            'backtime' =>'11:00', 
            'category' => ' KOUCH',
            'categoryname' => '企業', 
            'order' => 'ステーキ',
        ];

        $response = $this->post('reservations/store', $data);
   
        $response->assertSessionHasErrors(['sumprice' =>  '合計金額は必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('reservations/create');
    }

    public function test_時間のバリデーション確認()
    {
        $data = 
        [
            'name' => 'test', 
            'address' => 'ddd@gmail.com',
            'telnum' => '08098789765',
            'time' => '2022/04/01',
            'category' => ' KOUCH',
            'categoryname' => '企業', 
            'order' =>  'ステーキ', 
            'sumprice' => '880',
        ];

        $response = $this->post('reservations/store', $data);

        $response->assertSessionHasErrors(['backtime' => '時間は必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('reservations/create');
    }
    public function test_カテゴリーのバリデーション確認()
    {
        $data = 
        [
            'address' => 'ddd@gmail.com', 
            'telnum' => '08098789765',
            'name' =>'test', 
            'time' => '2022/04/01',
            'backtime' =>'11:00', 
            'categoryname' => '企業', 
            'order' =>  'ステーキ', 
            'sumprice' => '880',
        ];

        $response = $this->post('reservations/store', $data);

        $response->assertSessionHasErrors(['category' => 'カテゴリーは必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('reservations/create');
    }

    public function test_住所or企業のバリデーション確認()
    {
        $data = 
        [
            'name' => 'test', 
            'telnum' => '08098789765',
            'address' => 'ddd@gmail.com', 
            'time' => '2022/04/01',
            'backtime' =>'11:00', 
            'category' => ' KOUCH',
            'order' =>  'ステーキ', 
            'sumprice' => '880',
        ];

        $response = $this->post('reservations/store', $data);
   
        $response->assertSessionHasErrors(['categoryname' =>  '企業or民家は必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('reservations/create');
    }
}
