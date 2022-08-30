@extends('layouts.logged_in')
@section('title')
@section('content')
    <h1>{{ $user->name }}の出品商品一覧</h1>
    <p><a href="{{ route('items.create') }}">新規出品</a></p>
    @forelse($user_items as $item)
        <li>
           <div class="item_content">
               <div class="item_body">
                   <div>
                        @if($item->image !== '')
                            <img src="{{ \Storage::url($item->image) }}">
                        @else
                            <img src="{{ asset('images/no_image.png') }}">
                        @endif
                   </div>
                   <div>
                       <p>{{ $item->description }}</p>
                   </div>
               </div>
               <p>商品名: {{ $item->name }} {{ $item->price }}</p>
               <p>カテゴリー: {{ $item->category }}</p>
               <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' :  '☆'}} </a>
               <form class="like" method="post" action="{{ route('items.toggle_like', $item) }}">
                    @csrf
                    @method('patch')
               </form>
               <p>[<a href="{{ route('items.edit', $item) }}">編集</a>] [<a href="{{ route('items.edit_image', $item) }}">画像を変更</a>]</p>
               <form method="post" class="delete" action="{{ route('items.destroy', $item )}}">
                   @csrf
                   @method('delete')
                   <input type="submit" value="削除">
               </form>
           </div> 
        </li>
    @empty
        <p>出品している商品はありません</p>
    @endforelse
@endsection