<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\models\Info;
use App\User;
use Illuminate\Support\Facades\Artisan;

class InfoTest extends TestCase
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
        $response = $this->get('infos/index');

        $response->assertStatus(200);
        
        $response->assertSeeText('埼玉');
    }

    public function test_詳細ページ確認()
    {
        $response = $this->get('infos/2');

        $response->assertStatus(200);

        $response = $this->get('/infos/7');//存在しないときの確認

        $response->assertStatus(404);
    }

    public function test_新規作成への確認()
    {
        $response = $this->get('/infos/create');

        $response->assertStatus(200);

        $data = [
             'name' => 'testname',
             'address' => 'ddd@gmail.com', 
             'telnum' => '08098789765',
             'remarks' =>'特になし', 
        ];

        $this->assertDatabaseMissing('infos', $data);
 
        $response = $this->post('infos/store', $data);

        $response->assertStatus(302)->assertRedirect('infos/7');
        
        $this->assertDatabaseHas('infos', ['name' => 'testname']);
    }

    public function test_更新確認()
    {
        $data = factory(Info::class)->create();

        $response = $this->get(route('info/edit', $data->id));

        $response->assertStatus(200);

        $update_data =
        [
            'name' => 'test_names',
             'address' => 'fff@gmail.com', 
             'telnum' => '07089762765',
             'remarks' =>'あり', 
        ];

        $this->assertDatabaseMissing('infos', $update_data);

        $update_url = route('infos.update', $data->id);

        $response = $this->put($update_url, $update_data);
    
        $response->assertStatus(302)
            ->assertRedirect('infos/index');

        $this->assertDatabaseHas('infos', ['name' => 'test_names']);
    }

    public function test_削除確認()
    {
        $data = factory(Info::class)->create();

        $this->assertDatabaseHas('infos', ['id' => $data->id]);

        $data =  Info::where('id', $data->id)->update([
            'status' => '2'
        ]);

        $response = $this->get('infos/index');

        $response->assertStatus(200);
        
        $response->assertDontSeeText('infos', ['name' => 'eee@gmail.com']);
    }
}
