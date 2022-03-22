<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;

class InfoTest extends DuskTestCase
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
       $user = factory(User::class)->create();  
       $response = $this->actingAs($user);
    }

    public function test_顧客新規登録()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))->visit('/infos/create')
                    ->clickLink('新規登録') // 一覧画面に遷移 // 一覧画面で新規作成リンクをクリック
                    ->type('input[name="name"]', 'test_name') // タイトルを入力する
                    ->type('input[name="address"]', 'aaa@gamil.com') 
                    ->type('input[name="telnum"]', '08012345786')
                    ->type('input[name="remarks"]', 'なし') // 著者を入力する
                    ->press('情報を登録する')
                    ->acceptDialog() // 送信ボタンをクリック
                    ->assertPathIs('/infos/'.$browser->id) // 一覧画面に遷移を確認
                    ->assertSee('顧客一覧表'); // 「タイトルテスト」というテキストが含まれていること
        });
    }
}
