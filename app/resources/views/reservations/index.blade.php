@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
  <p class="new user"></p>
  <div class="header-title">予約一覧表
  </div>
  <form class="form-inline my-2 my-lg-0 ml-2">
    <div class="form-group">
    <input type="search" class="reservation_form" name="search"  placeholder="キーワードを入力" >
    <input type="date" class="reservation_form" name="date-search" placeholder="キーワードを入力">
    </div>
    <input type="submit" value="検索" class="btn btn-info">
  </form>
    <table>
      <thead>
        <tr>
          <th class="AAA">名前<br>(クリックで詳細確認)</th>
          <th>住所</th>
          <th>時間</th>
          <th>カテゴリー</th>
          <th>配達者</th>
          <th>ステータス</th>
        </tr>
      </thead>
      <tbody>
        @foreach($reservations AS $reservation) 
           <tr>
             <td><a href="/reservations/{{$reservation['id']}}" class='d-block'>{{ $reservation['name'] }}様</a></td>
             <td>{{ $reservation['address'] }}</td>
             <td>{{$reservation['time']}}<br><br>{{$reservation['backtime']}}</td>
             <td>{{$reservation['category']}}</td>
             <td>{{$reservation['delivery']}}</td>
             <form method='POST' action="{{ route('reservations/update', ['id' => $reservation['id'] ] ) }}">
             @csrf
             <td>{{$reservation['task']}}</td>
           </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="d-flex justify-content-center mt-5 mb-5">
  {{ $reservations->links()}}
</div>
@endsection
