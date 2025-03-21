<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function checkout($item_id)
    {
        $item = Item::findOrFail($item_id);
        return view('checkout', compact('item'));
    }

    public function payment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $item = Item::findOrFail($request->item_id);

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->title,
                    ],
                    'unit_amount' => $item->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/payment/success') . '?session_id={CHECKOUT_SESSION_ID}&item_id=' . $item->id,
            'cancel_url' => url('/') . '?cancel=true',
        ]);

        return redirect($session->url);
    }

    public function paymentSuccess(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $session_id = $request->query('session_id');
        $item_id = $request->query('item_id'); // セッション or URLパラメータから渡す

        // セッション情報取得（必要に応じて）
        $session = StripeSession::retrieve($session_id);

        // 購入情報をDBに保存
        \App\Models\Purchase::create([
            'user_id' => auth()->id(),
            'item_id' => $item_id,
            'payment_method' => 'card', // 今回はカード決済なので固定でもOK
            'status' => 'completed',
        ]);

        // 商品を sold に更新
        $item = \App\Models\Item::findOrFail($item_id);
        $item->status = 'sold';
        $item->save();

        return view('payment_success'); // 成功メッセージ用ビュー
    }
}
