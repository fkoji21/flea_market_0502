<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function showChangeForm($item_id)
    {
        $address = Auth::user()->address;
        return view('purchases.edit', compact('address', 'item_id'));
    }

    public function updateAddress(Request $request, $item_id)
    {
        $user = Auth::user();

        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'postal_code' => $request->postal_code,
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
            ]
        );

        return redirect("/purchase/{$item_id}")->with('success', '住所情報を登録しました！');

    }
}
