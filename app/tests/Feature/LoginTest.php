<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\User;
use Auth;
use Str;

class LoginTest extends TestCase
{
   use RefreshDatabase;

   public function setUp(): void
   {
       parent::setUp();                   

       // テストユーザ作成
       $this->user = factory(User::class)->create();           
   }
   /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_ログインテスト()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $user = factory(User::class)->create([
            'password'  => bcrypt('laraveltest123')
            //パスワードは好きな言葉で大丈夫です
        ]);

        // 認証されないことを確認
        $this->assertFalse(Auth::check());

        // ログインを実行
        $response = $this->post('login', [
            'email'    => $user->email,
            'password' => 'laraveltest123'
            //先ほど設定したパスワードを入力
        ]);

        // 認証されていることを確認
        $this->assertTrue(Auth::check());
        $response->assertRedirect('/reservations/index');
    }
    
   public function test_間違ったパスワードの場合()
  {
        $response = $this->get('/login');
        $response->assertStatus(200);

        // パスワードが正しく無い状態でログイン
        $response = $this->post('/login', [
            'email' => $this->user->email, 
            'password' => 'Test123'
        ]);
        // リダイレクトで戻ってくる。
        $response->assertStatus(302);
        // リダイレクトで戻ってきた時はログインページにいる事
        $response->assertRedirect('/login');
        // 失敗しているので認証されていない事
        $this->assertFalse(Auth::check());
  }

    public function test_ログアウトが正しくできるか()
  {
        // ログイン状態の作成
        $response = $this->actingAs($this->user);
        $response = $this->get('/');
        $response->assertStatus(200);
        $this->assertTrue(Auth::check());
        // ログアウト処理をする
        $this->post('logout');
        // ログアウト出来たら200番が帰ってきているか
        $response->assertStatus(200);
        // ログインページにいる事
        $response = $this->get('/login');
        $response->assertStatus(200);
        // 認証されていないことを確認
        $this->assertFalse(Auth::check());
  }

    public function test_ログインしていなければ登録ページに遷移できる()
   {
        $response = $this->get('/register');
 
        $response->assertStatus(200);
   }

   public function test_新規登録()
   {
         $this->assertFalse(Auth::check());
         $response = $this->post('/register', [
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => 'password',
             'password_confirmation' => 'password',
         ]);

         $this->assertAuthenticated();
         $response->assertRedirect('/reservations/index');
         $this->assertTrue(Auth::check());
   }
}