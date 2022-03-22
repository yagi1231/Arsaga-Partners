<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
@extends('layouts.app')

@section('content')     
        <div class="flex-center position-ref full-height">
          @if (Route::has('login'))
              <div class="top-right links">
                  @auth
                      
                  @else
                      <a href="{{ route('login') }}">Login</a>

                      @if (Route::has('register'))
                          <a href="{{ route('register') }}">Register</a>
                      @endif
                  @endauth
              </div>
          @endif
          
          <div class="top-menu">
            <h1>情報共有アプリ <br>kouch-deliveryとは？</h1>
            <p class="AppDescription-sentence">このアプリは「デリバリー専門店 KOUCH」というお店のデリバリー店員に向けて作ったものです。</p>
            <p class="AppDescription-sentence">デリバリー店員は配達が基本業務なので基本的にお店にいることは少なく忙しくなればなるほど一回で配達する件数も必然的に増えていきます。</p>
            <p class="AppDescription-sentence">そうなるとその日いるメンバー(平均4.5人)で時間に合わせるように効率が求められます。 そこで使用するのがこの情報共有アプリです。</p>
            <p class="AppDescription-sentence">デリバリー 専門店「KOUCH」で働く全ての人に情報共有を円滑に行う事で作業効率をあげて少しでも良いものをお客様に提供して欲しいという思いで作成しました。</p>
          <div>
        </div>
    </body>
</html>
@endsection('content')  