@extends('layouts.app')

@section('content')
<div>-----</div>
<h3 class="header-title">お客様登録情報</h3>
<form method='POST' action="/reservations/create">
  @csrf
  <table>
    <tr>
      <th>名前</th>
      <td><input name='name' class="form-control width name" value="{{$info['name']}}" style=" border:solid 0px; background-color:white;" readonly>様</td>
    </tr>
    <tr>
      <th>住所</th>
      <td><input name='address' class="form-control width" value="{{$info['address']}}" style=" border:solid 0px; background-color:white;" readonly></td>
    </tr>
     <tr>
      <th>電話番号</th>
      <td><input type="tel" class="form-control width"  name="telnum"value="{{$info['telnum']}}" style=" border:solid 0px; background-color:white;" readonly></td>
    </tr>
     <tr>
      <th>備考</th>
      <td><input type="text" class="form-control width" name="remarks" value="{{$info['remarks']}}" style=" border:solid 0px; background-color:white;" readonly ></td>
    </tr>
  </table>
  <button type="submit" class="mt-5 mb-5 btn btn-outline-primary">新規登録画面へ</button>
</form>
<a href="/infos/edit/{{$info['id']}}" type="submit" class="mt-5  btn btn-outline-primary">情報を編集する</a>
<form action="/infos/delete/{{$info->id}}" method="POST">
  {{ csrf_field() }}
  <input type="submit" value="削除" class="mt-5 mb-5 btn btn-outline-primary btn-dell">
</form>
@endsection