<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'profile_image' => 'https://placehold.jp/150x150.png',
            'postal_code' => '160-0022',
            'address_line1' => '東京都新宿区新宿3-1-1',
            'address_line2' => '○○ビル5F',
        ]);

        User::factory()->count(5)->create();

    }
}
