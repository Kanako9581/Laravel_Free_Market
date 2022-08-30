@extends('layouts.logged_in')
@section('content')
    <p class="top_word">息をするように、買おう。</p>
    <p><a href="{{ route('items.create') }}">新規出品</a></p>
    @forelse($items as $item)
        <!--<p>-->
            <div class="item_content">
                <div class="item_body">
                    <div>
                        <a href="{{ route('items.show', $item) }}"><img src="{{ \Storage::url($item->image) }}"></a>    
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
                <!--pではダメです-->
                <div>
                    商品名: {{ $item->name }} {{ $item->price }}円
                    <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' :  '☆'}} </a>
                    <form class="like" method="post" action="{{ route('items.toggle_like', $item) }}">
                        @csrf
                        @method('patch')
                    </form>
                </div>
                <p>カテゴリー: {{ $item->category->name }} ({{ $item->created_at }})</p>
            </div>
        <!--</p>-->
    @empty
        <p>出品している商品はありません</p>
    @endforelse
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      /* global $ */
      $('.like_button').on('click', (event) => {
            console.log($(event.currentTarget).next());
          $(event.currentTarget).next().submit();
      })
    </script>
@endsection