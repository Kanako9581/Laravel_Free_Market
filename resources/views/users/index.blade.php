@extends('layouts.logged_in')
@section('title')
@section('content')
    <h1>{{ $title }}</h1>
    @if($user->image !== '')
        <img src="{{ \Storage::url($user->image) }}"><a href="{{ route('users.edit_image', $user) }}">画像を変更</a>
    @else
        <a href="{{ route('users.edit_image', $user) }}">画像を登録</a>
    @endif
    <p>{{ $user->name }}さん</p>
    <p>出品数: {{ $items_count }}</p>
    @if($user->profile !== '')
        <p>{{ $user->profile }} <a href="{{ route('users.edit', $user) }}">プロフィール編集</a></p>
    @else
        <p>プロフィールが設定されていません <a href="{{ route('users.edit', $user) }}">プロフィール設定</a></p>
    @endif
    <h2>購入履歴</h2>
    @forelse($order_items as $item)
        <p>{{ $item->name }}: {{ $item->price }}円 出品者:{{ $item->user->name }}さん</p>
    @empty
        <p>購入した商品はありません</p>
    @endforelse
@endsection