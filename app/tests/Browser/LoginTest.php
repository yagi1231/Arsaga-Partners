<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Artisan;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function setUp(): void
    {
       parent::setUp();
       // テストユーザ作成
       Artisan::call('migrate:refresh');
    }

    public function testBasicExample()
    {
        $user = factory(User::class)->create([
            'password'  => bcrypt('laraveltest123')
            //パスワードは好きな言葉で大丈夫です
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('input[name="email"]', $user->email)
                    ->type('input[name="password"]', 'laraveltest123')
                    ->press('ログイン')
                    ->acceptDialog() 
                    ->assertPathIs('/reservations/index');
        });
    }

    public function test_ログアウト()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)->visit('/reservations/index')
                ->acceptDialog()
                ->assertSee('ログアウト')
                ->clickLink('ログアウト')
                ->acceptDialog() 
                ->acceptDialog() ;
        });
    }

    public function test_新規登録()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register') // 一覧画面に遷移 // 一覧画面で新規作成リンクをクリック
                    ->type('input[name="name"]', 'test_name') // タイトルを入力する
                    ->type('input[name="email"]', 'aaa@gamil.com') 
                    ->type('input[name="password"]', 'aaaaaaaa')
                    ->type('input[name="password_confirmation"]', 'aaaaaaaa') // 著者を入力する
                    ->press('同意する')
                    ->acceptDialog() // 送信ボタンをクリック
                    ->assertPathIs('/reservations/index') // 一覧画面に遷移を確認
                    ->assertSee('予約一覧表')
                    ->screenshot("logined"); // 「タイトルテスト」というテキストが含まれていること
        });
    }
}
