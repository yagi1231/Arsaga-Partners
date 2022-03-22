<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Artisan;

class UserTest extends TestCase
{
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
    }
    
    public function test_ログインテスト_email()
    {

        $response = $this->get('/login');

        $data = 
        [
            'email' => 'aa@gamil.com', 
            'password' => $this->user->password,
        ];
        $response = $this->post('/login', $data);

        $response->assertSessionHasErrors(['email' => 'ログイン情報が登録されていません。']);

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }

    public function test_ログインテスト_password()
    {

        $response = $this->get('/login');

        $data = 
        [
            'email' => $this->user->emal, 
            'password' => '',
        ];
        $response = $this->post('/login', $data);

        $response->assertSessionHasErrors(['password' => 'パスワードは必ず指定してください。']);

        $response->assertStatus(302)
            ->assertRedirect('/login');
    }

    public function test_新規登録テスト_name()
    {

        $response = $this->get('/register');

        $data = 
        [
            'name' => '',
            'email' => 'user@gmail.com', 
            'password' => 'aaaaaaaa',
            'password_confirmation' => 'aaaaaaaa',
        ];
        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['name' => 'ユーザー名は必ず指定してください。']);

        $response->assertStatus(302)
            ->assertRedirect('/register');
    }

    public function test_新規登録テスト_email()
    {

        $response = $this->get('/register');

        $data = 
        [
            'name' => 'aa@gamil.com',
            'email' => '', 
            'password' => 'aaaaaaaa',
            'password_confirmation' => 'aaaaaaaa',
        ];
        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['email' => 'メールアドレスは必ず指定してください。']);

        $response->assertStatus(302)
            ->assertRedirect('/register');
    }

    public function test_新規登録テスト_password()
    {

        $response = $this->get('/register');

        $data = 
        [
            'name' => 'aa@gamil.com',
            'email' => 'user@gmail.com', 
            'password' => '',
            'password_confirmation' => 'aaaaaaaa',
        ];
        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['password' => 'パスワードは必ず指定してください。']);

        $response->assertStatus(302)
            ->assertRedirect('/register');
    }

    public function test_新規登録テスト_password8文字以下()
    {

        $response = $this->get('/register');

        $data = 
        [
            'name' => 'aa@gamil.com',
            'email' => 'user@gmail.com', 
            'password' => 'aaaaaaa',
            'password_confirmation' => '',
        ];
        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['password' => 'パスワードは、8文字以上で指定してください。']);

        $response->assertStatus(302)
            ->assertRedirect('/register');
    }

    public function test_新規登録テスト_password_confirmation()
    {

        $response = $this->get('/register');

        $data = 
        [
            'name' => 'aa@gamil.com',
            'email' => 'user@gmail.com', 
            'password' => 'aaaaaaaa',
            'password_confirmation' => '',
        ];
        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['password' => 'パスワードと、確認フィールドとが、一致していません。']);

        $response->assertStatus(302)
            ->assertRedirect('/register');
    }
}
