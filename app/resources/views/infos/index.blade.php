@extends('layouts.app')

@section('content')
<a href="/infos/create" class="btn btn-outline-primary mt-5">新規登録</a>
<div class="container">
  <div class="row">
  <p class="new user"></p>
  <div class="header-title">顧客一覧表
  </div>
  <form class="form-inline my-2 my-lg-0 ml-2">
    <div class="form-group">
    <input type="search" class="info_form" name="search"  value="{{request('search')}}" placeholder="キーワードを入力" aria-label="検索...">
    </div>
    <input type="submit" value="検索" class="btn btn-info">
  </form>
    <table>
    <thead>
      <tr>
        <th class="AAA">名前<br>(クリックで詳細確認)</th>
        <th>住所</th>
        <th>電話<br>(クリックで通話可能)</th>
        <th>削除</th>
      </tr>
    </thead>
    <tbody>
      @foreach($infos AS $info) 
      <tr>
        <td><a href="/infos/{{$info['id']}}" class='d-block'>{{ $info['name'] }}様</a></td>
        <td>{{ $info['address'] }}</td>
        <td><a href="tel:<%= info.telnum %>" class="telcolor">{{ $info['telnum'] }}</a></td>
        <td>
          <form method='POST' action="/infos/delete/{{$info['id']}}" id='delete-form'>
             @csrf
            <button class='p-0 mr-2 btn-dell' value="削除" style='border:none;'><i id='delete-button' class="fas fa-trash"></i></button>
          </form>  
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="d-flex justify-content-center mt-5 mb-5">
  {{ $infos->links()}}
</div>
@endsection
