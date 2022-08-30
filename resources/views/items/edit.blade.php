@extends('layouts.logged_in')
@section('title')
@section('content')
    <h1>{{ $title }}</h1>
    <h2>商品追加フォーム</h2>
    <form method="post" action="{{ route('items.update', $item) }}"> 
        @csrf
        @method('patch')
        <div>
            <label>
                商品名:
                <input type="text" name="name" value="{{ $item->name }}">
            </label>
        </div>
        <div>
            <label>
                商品説明:
                <textarea name="description" rows="30" cols="30">{{ $item->description }}</textarea>
            </label>
        </div>
        <div>
            <label>
                価格:
                <input type="text" name="price" value="{{ $item->price }}">
            </label>
        </div>
        <div>
            <label>
                カテゴリー: 
                <select name="category_id" >
                @foreach($category_ids as $category_id)
                    <option value="{{ $category_id->id }}" {{ $category_id->id === $item->category_id ? 'selected' : ''}}>{{ $category_id->name }}</option>
                @endforeach
                </select>
            </label>
        </div>
        <input type="submit" value="出品">
    </form>
@endsection