<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $tab = $request->query('tab', 'buy'); // デフォルトで購入履歴タブ
        $user = Auth::user();
        $purchasedItems = $user->purchases()->with('item')->get()->pluck('item');
        $soldItems = Item::where('user_id', $user->id)->get();

        return view('user.profile', compact('user', 'purchasedItems', 'soldItems', 'tab'));

    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = '/storage/' . $path;
        }
        $user->name = $request->name;
        $user->save();

        return redirect('/mypage');
    }
}
