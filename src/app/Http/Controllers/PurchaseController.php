<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 購入済み商品一覧
    public function purchasedItems()
    {
        $purchasedItems = Purchase::with('item')
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->get();

        return view('user.purchased_items', compact('purchasedItems'));
    }
}
