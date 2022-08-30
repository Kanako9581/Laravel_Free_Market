@extends('layouts.logged_in')
@section('title')
@section('content')
    <h1>{{ $title }}</h1>
    <h2>商品追加フォーム</h2>
    <form method="post" action="{{ route('items.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>
                商品名:
                <input type="text" name="name">
            </label>
        </div>
        <div>
            <label>
                商品説明:
                <textarea name="description" rows="30" cols="30"></textarea>
            </label>
        </div>
        <div>
            <label>
                価格:
                <input type="text" name="price">
            </label>
        </div>
        <div>
            <label>
                カテゴリー:
                <select name="category_id">
                @foreach($category_ids as $category_id)
                    <option value="{{ $category_id->id }}">{{ $category_id->name }}</option>
                @endforeach
                </select>
            </label>
        </div>
        <div>
            <label>
                画像を選択:
                <input type="file" name="image">
            </label>
        </div>
        <input type="submit" value="出品">
    </form>
@endsection