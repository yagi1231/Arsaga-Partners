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

<form method='POST' action="{{ route('infos/update', ['id' => $info['id'] ] ) }}">
   @csrf
  <table>
    <tr>
      <th>名前</th>
      <td><input name='name' class="form-control width"rows="10" value="{{$info['name']}}">様</td>
    </tr>
    <tr>
      <th>住所</th>
      <td><input name='address' class="form-control width"rows="10" value="{{$info['address']}}"></td>
    </tr>
     <tr>
      <th>電話番号</th>
      <td><input type="tel" class="form-control width" inputmode="numeric" pattern="\d*" name="telnum"value="{{$info['telnum']}}"></td>
    </tr>
     <tr>
      <th>備考</th>
      <td><input type="text" class="form-control width" name="remarks" placeholder="(例)新住所でマップでは出てこないので" value="{{$info['remarks']}}" ></td>
    </tr>
  </table>
  <button type="submit" class="mt-5 mb-5 btn btn-outline-primary btn-completion" dusk="edit-btn">情報を登録する</button>
</form>
@endsection