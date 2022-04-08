@if (Route::has('login'))
    @auth
        <a href="/reservations/index" class="btn btn-outline-primary mt-5 brand-text font-weight-light font-weight-bold" style="width:40%;font-size:12px;">注文内容/TOP</a>
        <a href="/infos/index" class="btn btn-outline-primary mt-5 brand-text font-weight-light font-weight-bold" style="width:40%;font-size:12px;">お客様情報一覧</a>
        <a href="/infos/create" class="btn btn-outline-primary mt-5 brand-text font-weight-light font-weight-bold" style="width:40%;font-size:12px;">新規お客様情報登録</a>
        <a href="#" id="logout-btn"class="btn btn-outline-primary float-right mt-5 brand-text font-weight-light font-weight-bold">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
         @csrf
        </form> 
        <a href="/reservations/sales/sum_sale" class="btn btn-outline-primary mt-5 brand-text font-weight-light font-weight-bold" style="width:40%;font-size:12px;">売上</a>
    @else
        <button class="btn btn-outline-primary mt-5 brand-text font-weight-light font-weight-bold">
          <a href="{{ route('login.guest') }}" class="text-white">
            ゲストログイン
          </a>
        </button>
        <a href="{{ route('login') }}" class="btn btn-outline-primary mt-5 brand-text font-weight-light font-weight-bold">ログイン</a>
    @if (Route::has('register'))
        <a href="{{ route('register') }}" class="btn btn-outline-primary mt-5 brand-text font-weight-light font-weight-bold">新規作成</a>
    @endif
    @endauth
@endif
