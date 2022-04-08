@extends('layouts.app')

@section('content')
<div>-----</div>
<h3 class="header-title">お客様情報登録</h3>
  @csrf
<table>
  <tr>
    <th>名前</th>
    <td>{{$reservation['name']}}様</td>
  </tr>

  <tr>
    <th>住所</th>
    <td>{{$reservation['address']}}</td>
  </tr>

   <tr>
    <th>電話番号<br>(クリックで電話可能)</th>
    <td><a href="tel:{{$reservation['telnum']}}" class="telcolor">{{$reservation['telnum']}}</a></td>
  </tr>

   <tr>
    <th>注文内容</th>
    <td>{{$reservation['order']}}</td>
  </tr>

  <tr>
    <th>金額</th>
    <td>￥{{number_format( floor($reservation['sumprice']))}}</td>
  </tr>
 
  <tr>
    <th>時間</th>
    <td>{{$reservation['time']}}<br><br>{{$reservation['backtime']}}</td>
  </tr>

  <tr>
    <th>カテゴリー</th>
    <td>{{$reservation['category']}}</td>
  </tr>

  <tr>
    <th>民家or企業</th>
    <td>{{$reservation['categoryname']}}</td>
  </tr>

  <tr>
    <th>備考</th>
    <td>{{$reservation['remarks']}}</td>
  </tr>

  <tr>
    <th>配達員</th>
    <td>{{$reservation['delivery']}}</td>
  </tr>

  <tr>
    <th>画像</th>
    <td><img src="{{ '/storage/' . $reservation['image']}}" class='w-100 mb-3'/></td>
  </tr>
</table>

<div class="print-area">
  <div class="receipt">
    <ul>
      <li class="receipt-title">領収書</li>
      <li class="receipt-date"><?php echo date('Y年-m月-d日');?></li><br>
      <li class="receipt-name">{{$reservation['name']}}様</li>
      <li class="receipt-price">¥  {{$reservation['sumprice']}} -</li>
      <li class="receipt-proviso">但 お弁当代として</li>
      <li class="receipt-proviso">上記正に領収いたしました</li><br>
      <li class="receipt-company">株式会社 蒼柚<br>埼玉県所沢市東町13-29H-CUBE 1B<br>河内 敏弘</li>
    </ul>
  </div>
</div>
<button class="print-btn">
  <span>領収書の印刷</span>
</button>
<div>
  <ul>
  </ul>
</div>
<a href="/reservations/edit/{{$reservation['id']}}" type="submit" class="mt-5  btn btn-outline-primary" dusk="edit-btn">情報を編集する</a>
<form action="/reservations/delete/{{$reservation->id}}" method="POST">
  {{ csrf_field() }}
  <input type="submit" value="削除" class="mt-5 mb-5 btn btn-outline-primary btn-dell" dusk="delete-btn">
</form>
@endsection