<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            ['name' => 'Housing', 'icon' => 'home'],
            ['name' => 'Utilities', 'icon' => 'bolt'],
            ['name' => 'Groceries', 'icon' => 'shopping_cart'],
            ['name' => 'Dining', 'icon' => 'restaurant'],
            ['name' => 'Transportation', 'icon' => 'directions_car'],
            ['name' => 'Health & Medical', 'icon' => 'local_hospital'],
            ['name' => 'Education', 'icon' => 'school'],
            ['name' => 'Shopping', 'icon' => 'store'],
            ['name' => 'Entertainment', 'icon' => 'movie'],
            ['name' => 'Family', 'icon' => 'people'],
            ['name' => 'Travel', 'icon' => 'flight'],
            ['name' => 'Financial', 'icon' => 'account_balance_wallet'],
            ['name' => 'Business / Work', 'icon' => 'work'],
            ['name' => 'Subscriptions', 'icon' => 'subscriptions'],
            ['name' => 'Insurance', 'icon' => 'verified_user'],
            ['name' => 'Personal Care', 'icon' => 'self_improvement'],
            ['name' => 'Gifts & Donations', 'icon' => 'card_giftcard'],
            ['name' => 'Pets', 'icon' => 'pets'],
            ['name' => 'Taxes', 'icon' => 'receipt_long'],
            ['name' => 'Miscellaneous', 'icon' => 'category'],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->insert([
                'user_id' => null,
                'name' => $cat['name'],
                'icon' => $cat['icon'],
                'is_system' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
