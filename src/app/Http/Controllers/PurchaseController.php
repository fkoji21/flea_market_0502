<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 購入画面の表示
    /*public function showPurchaseForm($item_id)
    {
    $item = Item::findOrFail($item_id);
    $address = Auth::user()->address;

    if (!$address) {
    return redirect("/purchase/address/{$item_id}")->with('error', '住所情報を先に登録してください。');
    }

    return view('purchases.form', compact('item', 'address'));
    }

    // Stripe決済前に仮登録（決済完了時にpaymentSuccessで本登録）
    public function purchase(PurchaseRequest $request, $item_id)
    {
    $address = Auth::user()->address;

    Purchase::create([
    'user_id' => Auth::id(),
    'item_id' => $item_id,
    'payment_method' => $request->payment_method,
    'status' => 'pending', // Stripe完了後にcompletedへ変更
    'shipping_postal_code' => $address->postal_code ?? null,
    'shipping_address_line1' => $address->address_line1 ?? null,
    'shipping_address_line2' => $address->address_line2 ?? null,
    ]);

    return redirect()->route('checkout', ['item_id' => $item_id]);
    }*/

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
