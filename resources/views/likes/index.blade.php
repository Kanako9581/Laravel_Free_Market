@extends('layouts.logged_in')
@section('title')
@section('content')
    <h1>{{ $title }}</h1>
    @forelse($like_items as $item)
        <p>
            <div class="item_content">
                <div class="item_body">
                    <div>
                        @if($item->image !== '')
                            <a href="{{ route('items.show', $item) }}"><img src="{{ \Storage::url($item->image) }}"></a>
                        @else
                            <img src="{{ asset('images/no_image.png') }}">
                        @endif
                    </div>
                    <div>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
                @if(is_array($item->orderedUsers()->get()))
                    <p class="sold_out">売り切れ</p>
                @else
                    <p>出品中</p>
                @endif
                <p>商品名: {{ $item->item_name }} {{ $item->price }}</p>
                <p>カテゴリー: {{ $item->category->name }} {{ $item->created_at }}</p>
            </div>
        </p>
    @empty
        <p>お気に入りの商品はありません</p>
    @endforelse
@endsection