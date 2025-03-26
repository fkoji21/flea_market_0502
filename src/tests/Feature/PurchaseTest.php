<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_purchase_item()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create(['is_sold' => false]);
        Address::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post("/purchase/{$item->id}", [
            'payment_method' => 'カード支払い',
        ]);

        $response->assertRedirect(route('checkout', ['item_id' => $item->id]));
        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'status' => 'pending',
        ]);
    }

    public function test_guest_cannot_purchase_item()
    {
        $item = Item::factory()->create(['is_sold' => false]);

        $response = $this->post("/purchase/{$item->id}", [
            'payment_method' => 'カード支払い',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('purchases', [
            'item_id' => $item->id,
        ]);
    }

    public function test_purchase_requires_payment_method()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create(['is_sold' => false]);
        Address::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post("/purchase/{$item->id}", [
            'payment_method' => '',
        ]);

        $response->assertSessionHasErrors(['payment_method']);
    }

    public function test_purchased_item_shows_sold_label_in_index_page()
    {
        $user = User::factory()->create();
        // 自分以外のユーザーの商品にする
        $item = Item::factory()->create([
            'is_sold' => true,
            'user_id' => User::factory()->create()->id,
        ]);

        // 購入後に商品一覧ページでSOLDが表示されるか確認
        $response = $this->actingAs($user)->get(route('items.index'));

        $response->assertStatus(200);
        $response->assertSee('SOLD');

    }
}
