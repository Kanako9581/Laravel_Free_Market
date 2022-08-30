@extends('layouts.logged_in')
@section('title')
@section('content')
    <h1>{{ $title }}</h1>
    <p><span class="show_description">商品名</span>: {{ $item->name }}</p>
    <p><span class="show_description">画像</span></p>
    <img src="{{ \Storage::url($item->image) }}">
    <p><span class="show_description">カテゴリ</span>: {{ $item->category->name }}</p>
    <p><span class="show_description">価格</span>: {{ $item->price }}</p>
    <p><span class="show_description">説明</span>: {{ $item->description}}</p>
    @if($item->orderedUsers()->get()->count() > 0)
        <input type="submit" value="売り切れ" disabled>
    @else
        <input type="submit" value="購入する" onclick="location.href='{{ route('items.confirm', $item) }}'">
    @endif
@endsection