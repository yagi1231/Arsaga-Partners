<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\models\Info;
use App\User;
use Illuminate\Support\Facades\Artisan;

class InfoTest extends TestCase
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
       $response = $this->get('/infos/create');
    }
    
    public function test_名前のバリデーション確認()
    {
        $data = 
        [
            'address' => 'ddd@gmail.com', 
            'telnum' => '08098789765',
            'remarks' =>'特になし', 
        ];

        $response = $this->post('infos/store', $data);

        $response->assertSessionHasErrors(['name' => '名前は必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('infos/create');
    }

    public function test_住所のバリデーション確認()
    {
        $data = 
        [
            'name' => 'test', 
            'telnum' => '08098789765',
            'remarks' =>'特になし', 
        ];

        $response = $this->post('infos/store', $data);
   
        $response->assertSessionHasErrors(['address' =>  '住所は必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('infos/create');
    }

    public function test_電話番号のバリデーション確認()
    {
        $data = 
        [
            'address' => 'ddd@gmail.com', 
            'name' => 'test',
            'remarks' =>'特になし', 
        ];

        $response = $this->post('infos/store', $data);

        $response->assertSessionHasErrors(['telnum' => '電話番号は必須です。']);

        $response->assertStatus(302)
            ->assertRedirect('infos/create');
    }

    public function test_電話番号の正規表現確認()
    {
        $data = 
        [
            'address' => 'ddd@gmail.com', 
            'telnum' => '090',
            'name' => 'test',
            'remarks' =>'特になし', 
        ];

        $response = $this->post('infos/store', $data);

        $response->assertSessionHasErrors(['telnum' => '電話番号に正しい形式を指定してください。']);

        $response->assertStatus(302)
            ->assertRedirect('infos/create');
    }
}
