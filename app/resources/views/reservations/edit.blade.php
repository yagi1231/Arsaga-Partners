@extends('layouts.app')

@section('content')
<div>-----</div>
@if(count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<h3 class="header-title">お客様情報登録</h3>

<form method='POST' action="{{ route('reservations/update', ['id' => $reservation['id'] ] ) }}" enctype="multipart/form-data">
@csrf
  <table>
    <tr>
      <th>ステータス</th>
      <td>
        <select name="task" type="">
          <option value="準備中">準備中</option>
          <option value="準備完了">準備完了</option>
          <option value="配達中">配達中</option>
          <option value="配達完了">配達完了</option>
        </select>
      </td>
    </tr>
  
    <tr>
      <th>配達員</th>
      <td><input type="text" name="delivery" list="delivery" value="{{$reservation['delivery']}}">
      <datalist id="delivery">
        <option value="青柳樹"></option>
        <option value="うーちゃん"></option>
        <option value="まこちゃん"></option>
        <option value="小野"></option>
        <option value="修太"></option>
        <option value="もとき"></option>
        <option value="純平"></option>
        <option value="健太"></option>
        <option value="くすま"></option>
        <option value="小杉"></option>
        <option value="元"></option>
        <option value="ジャーミン"></option>
        <option value="鈴木"></option>
        <option value="ヨシ"></option>
        <option value="勇二"></option>
        <option value="大城"></option>
        <option value="大輝"></option>
        <option value="小川"></option>
        <option value="貴一"></option>
        <option value="浜岡"></option>
        <option value="優月"></option>
        <option value="幕内"></option>
        <option value="まゆ"></option>
        <option value="宮崎"></option>
        <option value="フミヤ"></option>
        <option value="もも"></option>
        <option value="ゆあさ"></option>
        <option value="優"></option>
        <option value="石井"></option>
        <option value="尾崎"></option>
        <option value="ルカ"></option>
        <option value="PANYA"></option>
        <option value="ARATA"></option>
        <option value="Gota"></option>
        <option value="鹿島"></option>
        <option value="けんしん"></option>
        <option value="優（田村）"></option>
      </datalist>
    <tr>

    <tr>
      <th>名前</th>
      <td><input name='name' class="form-control width" value="{{$reservation['name']}}">様</td>
    </tr>
      
    <tr>
      <th>住所</th>
      <td><input name='address' class="form-control width" value="{{$reservation['address']}}"></td>
    </tr>

    <tr>
      <th>電話番号</th>
      <td><input type="tel" class="form-control width" inputmode="numeric" pattern="\d*" name="telnum" value="{{$reservation['telnum']}}"></td>
    </tr>

    <tr>
      <th>注文内容</th>
      <td><div class="box">
        <textarea id="textarea" name="order" class="textarea" value="1" cols="50" style="width:80%;height:250px;">{{$reservation['order']}}</textarea>
        <p>省略ボタン</p>
        <div class="shop-name"  style="cursor: pointer;">KOUCHメニュー</div>
        <div class="click-btn">
          <input type="button" id="order-btn" value="x" onclick="prican()">
          <input type="button" id="order-btn" value="ヒレ丼   -780" onclick="menu(value)">
          <input type="button" id="order-btn" value="ステーキ  -680" onclick="menu(value)">
          <input type="button" id="order-btn" value="ロース   -680" onclick="menu(value)">
          <input type="button" id="order-btn" value="しょうが  -680" onclick="menu(value)">
          <input type="button" id="order-btn" value="ヒレ    -680" onclick="menu(value)">
          <input type="button" id="order-btn" value="ロースヒレ -780" onclick="menu(value)">
          <input type="button" id="order-btn" value="肉じゃが  -680" onclick="menu(value)">
          <input type="button" id="order-btn" value="なす豚   -600" onclick="menu(value)">
          <input type="button" id="order-btn" value="トリステーキ-600" onclick="menu(value)">
          <input type="button" id="order-btn" value="唐揚げ   -550" onclick="menu(value)">
          <input type="button" id="order-btn" value="なんばん  -550" onclick="menu(value)">
          <input type="button" id="order-btn" value="マグロカツ -600" onclick="menu(value)">
          <input type="button" id="order-btn" value="チーズみぞれ-600" onclick="menu(value)">
          <input type="button" id="order-btn" value="野菜炒め  -600" onclick="menu(value)">
          <input type="button" id="order-btn" value="カレー   -550" onclick="menu(value)">
          <input type="button" id="order-btn" value="豚汁    -190" onclick="menu(value)">
          <input type="button" id="order-btn" value="サバおひたし-250" onclick="menu(value)">
          <input type="button" id="order-btn" value="サラダ   -150" onclick="menu(value)">
          <input type="button" id="order-btn" value="揚げ出しなす-150" onclick="menu(value)">
          <input type="button" id="order-btn" value="ご飯    -190" onclick="menu(value)">
          <input type="button" id="order-btn" value="オムライス -250" onclick="menu(value)">
          <input type="button" id="order-btn" value="すき焼き  -680" onclick="menu(value)">
          <input type="button" id="order-btn" value="キムチチゲ -680" onclick="menu(value)">
        </div>
        <div class="shop-name">大戸屋メニュー</div>
        <div class="click-btn">
          <input type="button" id="order-btn" value="x" onclick="prican()">
          <input type="button" id="order-btn" value="トリクロ  -880" onclick="menu(value)">
          <input type="button" id="order-btn" value="スケソウ  -850" onclick="menu(value)">
        </div>
      </td>
    </tr>

    <tr>
      <th>金額</th>
      <td>
        <input type="button" value="x" onclick="prican()">
        <input type="text" id="pri" name="price" value="{{$reservation['price']}}">
        <input type="button"  value="=" onclick="sum()">
        <input size="20" type="text" id="sumpri" name="sumprice" value="{{$reservation['sumprice']}}">円
      </td>
    </tr>

    <tr>
      <th>日付-時間</th>
      <td><input type="date" name="time" value="{{$reservation['time']}}"> -
        <input type="text" name="backtime" min="11:00" max="21:00" list="time-list" value="{{$reservation['backtime']}}">
        <datalist id="time-list">
          <option value="11:00-11:30"></option>
          <option value="11:30">前後</option>
          <option value="11:30-12:00"></option>
          <option value="12:00">前後</option>
          <option value="12:00-12:30"></option>
          <option value="12:30">前後</option>
          <option value="12:30-13:00"></option>
          <option value="13:00">前後</option>
          <option value="13:00-13:30"></option>
          <option value="13:30">前後</option>
          <option value="13:30-14:00"></option>
          <option value="14:00">前後</option>
          <option value="14:00-14:30"></option>
          <option value="14:30">前後</option>
          <option value="14:30-15:00"></option>
          <option value="15:00">前後</option>
          <option value="15:00-15:30"></option>
          <option value="15:30">前後</option>
          <option value="15:30-16:00"></option>
          <option value="16:00">前後</option>
          <option value="16:00-16:30"></option>
          <option value="16:30">前後</option>
          <option value="16:30-17:00"></option>
          <option value="17:00">前後</option>
          <option value="17:00-17:30"></option>
          <option value="17:30">前後</option>
          <option value="17:30-18:00"></option>
          <option value="18:00">前後</option>
          <option value="18:00-18:30"></option>
          <option value="18:30">前後</option>
          <option value="18:30-19:00"></option>
          <option value="19:00">前後</option>
          <option value="19:00-19:30"></option>
          <option value="19:30">前後</option>
          <option value="19:30-20:00"></option>
          <option value="20:00">前後</option>
          <option value="20:00-20:30"></option>
          <option value="20:30">前後</option>
          <option value="20:30-21:00"></option>
          <option value="21:00">前後</option>      
        </datalist>
      </td>
    </tr>

    <tr>
      <th>カテゴリー</th>
      <td><input type="text" name="category" list="category" value="{{$reservation['category']}}">
        <datalist id="category">
          <option value="KOUCH"></option>
          <option value="大戸屋"></option>
          <option value="コラボ"></option>
        </datalist>
      </td>
    <tr>

    <tr>
      <th>企業or民家</th>
      <td><input type="text" name="categoryname" list="categoryname" value="{{$reservation['categoryname']}}">
        <datalist id="categoryname">
          <option value="企業"></option>
          <option value="民家"></option>
        </datalist>
      </td>
    <tr>
        
    <tr>
     <th>備考</th>
     <td><input type="text" name="remarks" placeholder="(例)マップでは出てこない" style="width:80%;height:100px;" value="{{$reservation['remarks']}}"></td>
    </tr>
      
    <tr>
      <th>画像</th>
      <td><input type="file" name="image" style="width:180px"></td>
    </tr>
  </table>
    <button type="submit" class="mt-5 mb-5 btn btn-outline-primary btn-completion" dusk="edit-create-btn">情報を登録する</button>
</form>
@endsection