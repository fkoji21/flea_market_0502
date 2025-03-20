<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    public function index()
    {
        $items = Item::where('is_sold', false)->get();
        return view('items.index', compact('items'));
    }

    public function mylist()
    {
        $user = Auth::user();
        $likedItems = $user->likes()->with('item')->get()->pluck('item');
        // ユーザーのlikesから関連付いたitemを取得
        return view('items.mylist', compact('likedItems'));

    }

    public function show($item_id)
    {
        $item = Item::with('comments.user')->findOrFail($item_id);
        return view('items.show', compact('item'));

    }

    public function create()
    {
        // 商品出品フォーム
        return view('items.create');
    }

    public function store(StoreItemRequest $request)
    {
        $path = $request->file('image_url')->store('items', 'public');
        $imageUrl = '/storage/' . $path;

        Item::create([
            'user_id' => Auth::id(),
            'image_url' => $imageUrl,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'condition' => $request->condition,
            'price' => $request->price,
            'is_sold' => false,
            'status' => 'available',
        ]);

        return redirect('/')->with('success', '商品を出品しました！');

    }

    public function soldItems()
    {
        $items = Item::where('user_id', Auth::id())->get();
        return view('user.sold_items', compact('items'));
    }

}
