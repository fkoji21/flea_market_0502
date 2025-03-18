<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'user_id' => 1,
            'title' => 'ヴィンテージバッグ',
            'description' => '上質なレザーで作られたヴィンテージバッグです。',
            'price' => 12000,
            'status' => 'available',
            'condition' => 'good',
            'category' => 'ファッション',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/bag.jpg',
        ]);

        Item::create([
            'user_id' => 1,
            'title' => 'メンズ腕時計',
            'description' => 'シンプルで高級感のあるデザインです。',
            'price' => 25000,
            'status' => 'available',
            'condition' => 'new',
            'category' => '時計',
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/watch.jpg',
        ]);
    }
}
