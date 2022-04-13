@extends('layouts.app')

@section('content')
<h3 id="place" style="margin-top:50px;"></h3>
<table id="forecast"></table>
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
    <input type="submit" value="検索" class="btn btn-success" dusk="search">
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
             <td>
               @if($reservation->is_liked_by_auth_user())
                 <a href="{{ route('reservation.upstatus', ['id' => $reservation->id]) }}">準備中</a>
               @else
                 <a href="{{ route('reservation.status', ['id' => $reservation->id]) }}">配達完了</a>
               @endif
             </td>
           </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="d-flex justify-content-center mt-5 mb-5">
  {{ $reservations->appends(request()->input())->links() }}
</div>
<script>
'use strict';


function success(pos) {
    ajaxRequest(pos.coords.latitude, pos.coords.longitude);
}

function fail(error) {
    alert('位置情報の取得に失敗しました。エラーコード:' + error.code);
}

function utcToJSTime(utcTime) {
    return utcTime * 1000;
}

function ajaxRequest(lat, long) {
    const url = 'https://api.openweathermap.org/data/2.5/forecast';
    const appId = 'a8cdaf03cabca4b4743db5488df9e663';

    $.ajax({
        url: url,
        data: {
            appid: appId,
            lat: lat,
            lon: long,
            units: 'metric',
            lang: 'ja'
        }
    })
    .done(function(data) {

        data.list.forEach(function(forecast, index) {
            const dateTime = new Date(utcToJSTime(forecast.dt));
            const month = dateTime.getMonth() + 1;
            const date = dateTime.getDate();
            const hours = dateTime.getHours();
            const min = String(dateTime.getMinutes()).padStart(2, '0');
            const temperature = Math.round(forecast.main.temp);
            const description = forecast.weather[0].description;
            const iconPath = `/images/${forecast.weather[0].icon}.svg`;

            $('#place').text(data.city.name);

             if(index <= 3) {
                const tableRow = `
            <ul class="mt-4"style="display: inline-block; >
              <li>
                    <div class="info">
                    ${month}/${date} :${hours}:${min}
                    </div>
                    <div class="icon"><img src="${iconPath}"></div>
                    <div><span class="description">${description}</span></div>
                    <div><span class="temp">${temperature}°C</span></div>
                    </li>
                    </ul>`
                    ;
                $('#forecast').append(tableRow);
            }
        });
    })
    .fail(function() {
        console.log('$.ajax failed!');
    })
}
</script>
@endsection
