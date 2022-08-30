<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\User;
use App\Item;

class LikeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index() {
        $user = \Auth::user();
        $like_items = $user->likeItems()->latest('likes.created_at')->get();
        return view('likes.index', [
            'title' => 'お気に入り一覧',
            'like_items' => $like_items,
        ]);
    }
}
