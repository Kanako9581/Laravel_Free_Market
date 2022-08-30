@extends('layouts.logged_in')
@section('title')
@section('content')
    <h1>{{ $title }}</h1>
    <h2>現在の画像</h2>
    @if($user->image !== '')
        <img src="{{ \Storage::url($user->image) }}">
    @endif
    <form method="post" action="{{ route('users.update_image', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>
            <label>
                画像を選択: <input type="file" name="image">
            </label>
        </div>
        <input type="submit" value="更新">
    </form>
@endsection