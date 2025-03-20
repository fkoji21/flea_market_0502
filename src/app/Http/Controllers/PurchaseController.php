<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Address;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function showPurchaseForm($item_id)
    {
        $item = Item::findOrFail($item_id);
        $address = Auth::user()->address;

        if (!$address) {
            return redirect("/purchase/address/{$item_id}")->with('error', '住所情報を先に登録してください。');
        }

        return view('purchases.form', compact('item', 'address'));
    }

    public function purchase(PurchaseRequest $request, $item_id)
    {
        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'payment_method' => $request->payment_method,
            /*'address_id' => Auth::user()->address->id,*/
        ]);

        $item = Item::findOrFail($item_id);
        $item->is_sold = true;
        $item->save();

        return redirect('/mypage')->with('success', '購入が完了しました！');
    }

    public function purchasedItems()
    {
        $items = Auth::user()->purchases()->with('item')->get()->pluck('item');
        return view('user.purchased_items', compact('items'));
    }
}
