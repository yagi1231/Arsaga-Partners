@extends('layouts.app')

@section('content')
<a href="/reservations/sales/sum_sale" class="btn btn-secondary">日別売上</a>
<a href="/reservations/sales/ave_sale" class="btn btn-secondary">日別平均</a>
<a href="#" class="btn btn-primary">月別売上</a>
<a href="/reservations/sales/month_ave_sale" class="btn btn-secondary">月別平均</a>
<div class="container">
  <div class="row">
    <div class="header-title">月別売上</div>
    <form class="form-inline my-2 my-lg-0 ml-2">
        <div class="form-group">
          <input type="month" class="info_form pull-right" name="search"  value="<?php echo date('Y-m');?>" placeholder="キーワードを入力" aria-label="検索...">
        </div>
      <input type="submit" value="検索" class="btn btn-info" dusk="search">
    </form>
    <table>
      <thead>
        <tr>
          <th>日付</th>
          <th>合計金額</th>
          <th>件数</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($results as $result)
        <tr>
          <td>{{$result->date}}</td>
          <td>￥{{number_format( floor( $result->month_sum_amount) ) . "\n"}}</td>
          <td>{{ $result-> month_sum_cuont}}件</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="d-flex justify-content-center mt-5 mb-5">
  {{ $results->links()}}
</div>
@endsection
