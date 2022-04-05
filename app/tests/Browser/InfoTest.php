<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;
use Illuminate\Support\Facades\Artisan;

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
       Artisan::call('migrate:refresh');
       Artisan::call('db:seed');
       $user = factory(User::class)->create();  
    }

    public function test_顧客新規登録()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/infos/create')
                    ->type('@input-name', 'test_name')
                    ->type('input[name="address"]', 'aaa@gamil.com') 
                    ->type('input[name="telnum"]', '08012345786')
                    ->type('input[name="remarks"]', 'なし')
                    ->press('情報を登録する')
                    ->acceptDialog()
                    ->assertSee('作成完了')
                    ->pause(2000);
        });
    }

    public function test_顧客詳細_顧客編集()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/infos/index')
                    ->clicklink('test様')
                    ->assertInputValue('input[name="name"]', 'test')
                    ->assertInputValue('input[name="address"]', '埼玉') 
                    ->assertInputValue('input[name="telnum"]', '08087654321')
                    ->assertInputValue('input[name="remarks"]', 'なし')
                    ->clicklink('情報を編集する')
                    ->type('input[name="name"]', 'test_name') 
                    ->type('input[name="address"]', 'aaa@gamil.com') 
                    ->type('input[name="telnum"]', '08012345786')
                    ->type('input[name="remarks"]', 'なし')
                    ->click('@edit-btn')
                    ->acceptDialog()
                    ->pause(2000)
                    ->assertSee('更新完了');
        });
    }
    
    public function test_顧客削除()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/infos/index')
                    ->press('@delete-btn')
                    ->acceptDialog()
                    ->assertSee('削除完了')
                    ->pause(2000);
        });
    }

    public function test_顧客から予約に情報を渡す()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/infos/index')
                    ->clicklink('test様')
                    ->click('@new-btn')
                    ->assertInputValue('input[name="name"]', 'test')
                    ->assertInputValue('input[name="address"]', '埼玉') 
                    ->assertInputValue('input[name="telnum"]', '08087654321')
                    ->assertInputValue('input[name="remarks"]', 'なし')
                    ->type('textarea[name="order"]', 'ステーキ') 
                    ->type('input[name="time"]', '03-22-2022') 
                    ->type('input[name="backtime"]', '11:00')
                    ->type('input[name="sumprice"]', '780')
                    ->type('input[name="category"]', 'KOUCH') 
                    ->type('input[name="categoryname"]', '企業')
                    ->click('@new-submit')
                    ->acceptDialog()
                    ->pause(2000)
                    ->acceptDialog()
                    ->assertSee('作成完了');

        });
    }

    public function test_顧客検索_キーワード()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/infos/index')
                    ->type('input[name="search"]', 'test2')
                    ->press('@search')
                    ->assertSee('test2様')
                    ->assertDontSee('test3様')
                    ->type('input[name="search"]', 'test3')
                    ->press('@search')
                    ->assertSee('test3様')
                    ->assertDontSee('test2様');
        });
    }

    public function test_ペーネーション5以上()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/infos/index')
                    ->click('a.page-link')
                    ->assertSee('test6様')
                    ->assertDontSee('test様')
                    ->click('a.page-link')
                    ->assertSee('test様')
                    ->assertDontSee('test6様');
        });
    }

    public function test_ペーネーション5以下の場合()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/infos/index')
                    ->press('@delete-btn')
                    ->acceptDialog()
                    ->assertSourceMissing('pagination.m-0');
        });
    }
}
