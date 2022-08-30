<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;
use App\Category;
use App\Like;
use App\Order;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemImageRequest;
use App\Service\FileUploadService;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $user_id = \Auth::id();
        $items = Item::orderBy('created_at', 'desc')->where('user_id', '!=', $user_id)->get();
        return view('top', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create', [
            'title' => '商品を出品',
            'category_ids' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function store(ItemStoreRequest $request, FileUploadService $service)
    {
        $path = $service->saveImage($request->file('image'));
        Item::create([
            'user_id' => \Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $path, 
        ]);
        return redirect()->route('users.exhibitions', \Auth::user());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return view('items.show', [
            'title' => '商品詳細',
            'item' => $item,
        ]);
    }
    public function confirm($id){
        $item = Item::find($id);
        return view('items.confirm', [
            'title' => '購入確認画面',
            'item' => $item,
        ]);
    }
    public function finish($id){
        $item = Item::find($id);
        Order::create([
            'user_id' => \Auth::user()->id,
            'item_id' => $item->id,
        ]);
        return view('items.finish', [
            'title' => 'ご購入ありがとうございました。',
            'item' => $item,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return view('items.edit', [
            'title' => '商品情報編集',
            'item' => $item,
            'category_ids' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, ItemRequest $request)
    {
        $item = Item::find($id);
        $item->update($request->only(['name', 'description', 'category_id', 'price']));
        session()->flash('success', '商品情報を編集しました');
        return redirect()->route('items.show', $item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if($item->image !== ''){
            \Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        \Session::flash('success', '商品情報を削除しました');
        return redirect()->route('items.index');
    }
    public function editImage($id){
        $item = Item::find($id);
        return view('items.edit_image', [
            'title' => '商品画像編集',
            'item' => $item,
        ]);
    }
    public function updateImage($id, ItemImageRequest $request, FileUploadService $service){
        $path = $service->saveImage($request->file('image'));
        $item = Item::find($id);
        if($item->image !== ''){
            \Storage::disk('public')->delete(\Storage::url($item->image));
        }
        $item->update(['image' => $path]);
        session()->flash('success', '商品画像を変更しました');
        return redirect()->route('items.show', $item);
    }
    public function toggle_like($id){
        $user = \Auth::user();
        $item = Item::find($id);
        if($item->isLikedBy($user)){
            $item->likes->where('user_id', $user->id)->first()->delete();
            \Session::flash('success', 'いいねをとりけしました');
        }else{
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            \Session::flash('success', 'いいねしました');
        }
        return redirect()->route('top');
    }
}
