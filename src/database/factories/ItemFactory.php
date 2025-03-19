<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'image_url' => 'https://placehold.jp/300x300.png',
            'category' => $this->faker->randomElement(['ファッション', '家電', '本', 'ゲーム']),
            'condition' => $this->faker->randomElement(['新品・未使用', '目立った傷や汚れなし', 'やや傷や汚れあり']),
            'price' => $this->faker->numberBetween(500, 5000),
            'status' => '販売中',
            'user_id' => 1, // ダミーユーザーID
        ];
    }
}
