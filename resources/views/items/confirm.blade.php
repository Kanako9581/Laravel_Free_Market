@extends('layouts.logged_in')
@section('title')
@section('content')
    <h1>{{ $title }}</h1>
    <p><span class="show_description">商品名</span></p>
    <p>{{ $item->name }}</p>
    <p><span class="show_description">画像</span></p>
    <img src="{{ \Storage::url($item->image) }}">
    <p><span class="show_description">カテゴリ</span></p>
    <p>{{ $item->category->name }}</p>
    <p><span class="show_description">価格</span></p>
    <p>{{ $item->price }}</p>
    <p><span class="show_description">説明</span></p>
    <p>{{ $item->description}}</p>
    <input type="submit" value="内容を確認し、購入する" onclick="location.href='{{ route('items.finish', $item) }}'">
@endsection