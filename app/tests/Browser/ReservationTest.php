<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;
use Illuminate\Support\Facades\Artisan;

class ReservationTest extends DuskTestCase
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

    public function test_予約詳細()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/index')
                    ->acceptDialog()
                    ->clicklink('テスト様')
                    ->assertSee('テスト様')
                    ->assertSee('埼玉') 
                    ->assertSee('07087976545')
                    ->assertSee('2022-03-21')
                    ->assertSee('13:00-13:30') 
                    ->assertSee('KOUCH')
                    ->assertSee('企業')
                    ->assertSee('ステーキ　生姜焼き 肉じゃが') 
                    ->assertSee('07087976545')
                    ->assertSee('2040')
                    ->assertSee('特になし')
                    ->pause(2000);
        });
    }

    public function test_予約編集()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/index')
                    ->acceptDialog()
                    ->clicklink('テスト様')
                    ->press('@edit-btn')
                    ->type('input[name="name"]', 'テスト8') 
                    ->type('input[name="address"]', '福島') 
                    ->type('input[name="telnum"]', '08012340986')
                    ->type('textarea[name="order"]', 'ステーキ') 
                    ->type('input[name="sumprice"]', '680') 
                    ->type('input[name="time"]', '2022-08-03')
                    ->type('input[name="backtime"]', '14:00')
                    ->type('input[name="category"]', 'コラボ') 
                    ->type('input[name="categoryname"]', '民家') 
                    ->type('input[name="remarks"]', 'なし')
                    ->press('@edit-create-btn')
                    ->acceptDialog()
                    ->acceptDialog()
                    ->pause(2000)
                    ->assertSee('更新完了');
        });
    }

    public function test_ボタン確認()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/create')
                    ->click('@name-btn')
                    ->click('@menu-btn')
                    ->click('@sum-btn')
                    ->assertInputValue('input[name="sumprice"]', '780')
                    ->click('@remove-btn')
                    ->click('@sum-btn')
                    ->assertInputValue('input[name="sumprice"]', 'undefined');
        });
    }
    
    public function test_顧客削除()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/index')
                    ->acceptDialog()
                    ->clicklink('テスト様')
                    ->press('@delete-btn')
                    ->acceptDialog()
                    ->acceptDialog()
                    ->assertSee('削除完了')
                    ->pause(2000);
        });
    }

    public function test_顧客検索_キーワード_日付()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/index')
                    ->acceptDialog()
                    ->type('input[name="search"]', ' テスト2')
                    ->type('input[name="date-search"]', '07-22-2022')
                    ->press('@search')
                    ->acceptDialog()
                    ->assertSee('テスト2様')
                    ->assertDontSee('テスト様');
        });
    }

    public function test_顧客検索_キーワード()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/index')
                    ->acceptDialog()
                    ->type('input[name="search"]', 'テスト2')
                    ->press('@search')
                    ->acceptDialog()
                    ->assertSee('テスト2様')
                    ->assertDontSee('test3様')
                    ->type('input[name="search"]', 'テスト3')
                    ->press('@search')
                    ->acceptDialog()
                    ->assertSee('テスト3様')
                    ->assertDontSee('テスト2様');
        });
    }

    public function test_顧客検索_日付()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/index')
                    ->acceptDialog()
                    ->type('input[name="date-search"]', '06-23-2022')
                    ->press('@search')
                    ->acceptDialog()
                    ->assertSee('テスト3様')
                    ->assertDontSee('テスト様');
        });
    }

    public function test_ペーネーション5以上()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/index')
                    ->acceptDialog()
                    ->click('a.page-link')
                    ->acceptDialog()
                    ->assertSee('テスト7様')
                    ->assertDontSee('テスト様')
                    ->click('a.page-link')
                    ->acceptDialog()
                    ->assertSee('テスト様')
                    ->assertDontSee('テスト7様');
        });
    }

    public function test_ペーネーション5以下の場合()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/index')
                    ->acceptDialog()
                    ->clicklink('テスト様')
                    ->press('@delete-btn')
                    ->acceptDialog()
                    ->acceptDialog()
                    ->clicklink('テスト6様')
                    ->press('@delete-btn')
                    ->acceptDialog()
                    ->acceptDialog()
                    ->assertSourceMissing('pagination.m-0');
        });
    }

    public function test_ハンバーガーメニュー ()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/infos/index')
                    ->clicklink('注文内容/TOP')
                    ->acceptDialog()
                    ->assertPathIs('/reservations/index')
                    ->clicklink('お客様情報一覧')
                    ->assertPathIs('/infos/index')
                    ->clicklink('新規お客様情報')
                    ->assertPathIs('/infos/create')
                    ->clicklink('売上')
                    ->assertPathIs('/reservations/sales/sum_sale')
                    ->clicklink('ログアウト')
                    ->acceptDialog()
                    ->assertPathIs('/');
        });
    }

    public function test_売上ページ変更確認()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/sales/sum_sale')
                    ->clicklink('日別平均')
                    ->assertPathIs('/reservations/sales/ave_sale')

                    ->clicklink('月別売上')
                    ->assertPathIs('/reservations/sales/month_sum_sale')

                    ->clicklink('月別平均')
                    ->assertPathIs('/reservations/sales/month_ave_sale')

                    ->clicklink('日別平均')
                    ->assertPathIs('/reservations/sales/sum_sale');
        });
    }

    public function test_売上ページ検索確認()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/sales/ave_sale')
                    ->type('input[name="search"]', '03-21-2022')
                    ->press('@search')
                    ->assertSee('2022/03/21')
                    ->assertSee('2件')
                    ->assertSee('￥1,700')
               
                    ->visit('/reservations/sales/month_sum_sale')
                    ->press('@search')
                    ->assertSee('2022/04')
                    ->assertSee('1件')
                    ->assertSee('￥680')


                    ->visit('/reservations/sales/month_ave_sale')
                    ->press('@search')
                    ->assertSee('2022/04')
                    ->assertSee('1件')
                    ->assertSee('￥680')

                    ->visit('/reservations/sales/sum_sale')
                    ->type('input[name="search"]', '03-21-2022')
                    ->assertSee('2022/03/21')
                    ->assertSee('2件')
                    ->assertSee('￥3,400');
        });
    }

    public function test_売上ページ_5つ以上でページネーション確認()
    {
        $this->browse(function (Browser $browser){
            $browser->loginAs(User::find(1))
                    ->visit('/reservations/sales/ave_sale')
                    ->assertSourceHas('d-flex justify-content-center mt-5 mb-5')
               
                    ->visit('/reservations/sales/month_sum_sale')
                    ->assertSourceHas('d-flex justify-content-center mt-5 mb-5')

                    ->visit('/reservations/sales/month_ave_sale')
                    ->assertSourceHas('d-flex justify-content-center mt-5 mb-5')

                    ->visit('/reservations/sales/sum_sale')
                    ->assertSourceHas('d-flex justify-content-center mt-5 mb-5');
        });
    }
}
