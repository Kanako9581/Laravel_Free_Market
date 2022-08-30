@extends('layouts.logged_in')
@section('title')
@section('content')
    <h1>{{ $title }}</h1>
    @forelse($user_items as $item)
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
                @if($item->orderedUsers()->get()->count() > 0)
                    <p class="sold_out">売り切れ</p>
                @else
                    <p>出品中</p>
                @endif
                <p>商品名: {{ $item->name }} {{ $item->price }}円</p>
                <p>カテゴリー: {{ $item->category->name }}</p>
                <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' :  '☆'}} </a>
                <form class="like" method="post" action="{{ route('items.toggle_like', $item) }}">
                    @csrf
                    @method('patch')
                </form>
                <p>[<a href="{{ route('items.edit', $item) }}">編集</a>] [<a href="{{ route('items.edit_image', $item) }}">画像を変更</a>]</p>
                <form method="post" action="{{ route('items.destroy', $item) }}" class="delete">
                    @csrf
                    @method('delete')
                    <input type="submit" value="削除">
                </form>
            </div>
        </p>
    @empty
        <p>出品している商品はありません</p>
    @endforelse
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      /* global $ */
      $('.like_button').on('click', (event) => {
          $(event.currentTarget).next().submit();
      })
    </script>
@endsection