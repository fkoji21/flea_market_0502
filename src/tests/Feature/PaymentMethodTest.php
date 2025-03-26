<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_method_is_reflected_on_checkout_page()
    {
        $user = User::factory()->create(['payment_method' => 'クレジットカード']);
        $item = Item::factory()->create();

        $response = $this->actingAs($user)->get(route('checkout', ['item_id' => $item->id]));

        $response->assertStatus(200);
        $response->assertSeeInOrder([
            'クレジットカード',
            'selected',
        ]);

    }
}
