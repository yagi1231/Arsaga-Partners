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
                ->acceptDialog() ;
        });
    }

    public function test_新規登録()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('input[name="name"]', 'test_name')
                    ->type('input[name="email"]', 'aaa@gamil.com') 
                    ->type('input[name="password"]', 'aaaaaaaa')
                    ->type('input[name="password_confirmation"]', 'aaaaaaaa') 
                    ->press('同意する')
                    ->acceptDialog()
                    ->assertPathIs('/reservations/index')
                    ->assertSee('予約一覧表')
                    ->screenshot("logined");
        });
    }
}
