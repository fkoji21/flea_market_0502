<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\StoreItemRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        // 自分が出品した商品を除外
        if (Auth::check()) {
            $query->where('user_id', '!=', Auth::id());
        }

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where('title', 'like', "%{$keyword}%");
        }

        $items = $query->paginate(9);
        return view('items.index', compact('items'));
    }

    public function mylist(Request $request)
    {
        $user = Auth::user();
        $likedItemsQuery = $user->likes()->with('item');

        // 自分の商品は除外
        $likedItemsQuery->whereHas('item', function ($query) use ($user) {
            $query->where('user_id', '!=', $user->id);
        });

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $likedItemsQuery->whereHas('item', function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%");
            });
        }

        $likedItems = $likedItemsQuery->paginate(9);
        return view('items.mylist', compact('likedItems'));
    }

    public function show($item_id)
    {
        $item = Item::with(['comments.user', 'categories'])->findOrFail($item_id);
        return view('items.show', compact('item'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(StoreItemRequest $request)
    {
        $path = $request->file('image_url')->store('items', 'public');
        $imageUrl = '/storage/' . $path;

        $item = Item::create([
            'user_id' => Auth::id(),
            'image_url' => $imageUrl,
            'title' => $request->title,
            'description' => $request->description,
            'condition' => $request->condition,
            'price' => $request->price,
            'is_sold' => false,
        ]);

        $item->categories()->sync($request->input('categories'));
        return redirect('/')->with('success', '商品を出品しました！');
    }

    public function soldItem()
    {
        $items = Item::where('user_id', Auth::id())->get();
        return view('user.sold_items', compact('items'));
    }

    public function addComment(CommentRequest $request, $item_id)
    {
        Comment::create([
            'item_id' => $item_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'コメントを投稿しました！');
    }
}
