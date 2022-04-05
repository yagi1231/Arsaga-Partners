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
        ]);

        $this->assertFalse(Auth::check());

        $response = $this->post('login', [
            'email'    => $user->email,
            'password' => 'laraveltest123'
        ]);
        $this->assertTrue(Auth::check());
        $response->assertRedirect('/reservations/index');
    }
    
   public function test_間違ったパスワードの場合()
  {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->post('/login', [
            'email' => $this->user->email, 
            'password' => 'Test123'
        ]);
 
        $response->assertStatus(302);
     
        $response->assertRedirect('/login');
 
        $this->assertFalse(Auth::check());
  }

    public function test_ログアウトが正しくできるか()
  {
      
        $response = $this->actingAs($this->user);
        $response = $this->get('/');
        $response->assertStatus(200);
        $this->assertTrue(Auth::check());

        $this->post('logout');

        $response->assertStatus(200);

        $response = $this->get('/login');
        $response->assertStatus(200);

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