@extends('layouts.not_logged_in')
@section('content')
    <h1>ユーザー登録</h1>
    <form method="post" action="{{ route('register') }}">
        @csrf
        <div>
            <label>
                ユーザー名:
                <input type="text" name="name">
            </label>
        </div>
        <div>
            <label>
                メールアドレス:
                <input type="email" name="email">
            </label>
        </div>
        <div>
            <label>
                パスワード:
                <input type="password" name="password">
            </label>
        </div>
        <div>
            <label>
                パスワード(確認用):
                <input type="password" name="password_confirmation">
            </label>
        </div>
        <input value="登録" type="submit">
    </form>
@endsection