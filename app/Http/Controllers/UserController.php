<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;
use App\Order;
use App\Service\FileUploadService;
use App\Http\Requests\UserImageRequest;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $order_items = $user->orderItems()->get();
        $items_count = $user->items()->get()->count();
        return view('users.index', [
            'title' => 'プロフィール',
            'user' => $user,
            'order_items' => $order_items,
            'items_count' => $items_count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = \Auth::user();
        return view('users.edit', [
            'title' => 'プロフィール編集',
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        $user = \Auth::user();
        $user->update($request->only(['name', 'profile']));
        session()->flash('success', 'プロフィールを編集しました');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function exhibitions(){
        $user = \Auth::user();
        $user_items = $user->items()->latest()->get();
        return view('users.exhibition', [
            'title' => '出品商品一覧',
            'user_items' => $user_items,
        ]);
    }
    public function editImage(){
        $user = \Auth::user();
        return view('users.edit_image', [
            'title' => 'プロフィール画像変更画面',
            'user' => $user,
        ]);
    }
    public function updateImage(UserImageRequest $request, FileUploadService $service){
        $user = \Auth::user();
        $path = $service->saveImage($request->file('image'));
        if($user->image !== ''){
            \Storage::disk('public')->delete(\Storage::url($user->image));
        }
        $user->update([ 'image' => $path, ]);
        session()->flash('success', 'プロフィール画像を変更しました');
        return redirect()->route('users.index');
    }
}
