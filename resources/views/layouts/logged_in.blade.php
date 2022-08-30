@extends('layouts.default')
@section('header')
    <header>
        <ul class="header_nav">
            <li><a href="{{ route('top') }}">Market</a></li>
            <li>{{ Auth::user()->name }}さん、こんにちは！</li>
            <li>
                <a href="{{ route('users.index', Auth::user()) }}">
                    プロフィール
                </a>
            </li>
            <li>
                <a href="{{ route('likes.index') }}">
                    お気に入り一覧
                </a>
            </li>
            <li><a href="{{ route('users.exhibitions', Auth::user()) }}">出品商品一覧</a></li>
            <li>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <input type="submit" value="ログアウト">
                </form>
            </li>
        </ul>
    </header>
@endsection