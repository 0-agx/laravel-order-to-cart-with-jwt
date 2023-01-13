<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use App\Models\User;
use App\Models\Store;
use App\Models\UserGroup;
use App\Models\Expedition;
use Illuminate\Support\Str;
use App\Models\ItemCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        UserGroup::factory()->create([
            'description' => 'Seller',
        ]);

        UserGroup::factory()->create([
            'description' => 'Customer',
        ]);

        User::factory()->create([
            'name' => 'Agik Bika Ristiawan',
            'user_group_id' => 1,
            'email' => 'agik@agx.site',
            'address' => 'Menganti Palem Pertiwi Gresik Jatim',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'name' => 'Budi Sudarsono',
            'user_group_id' => 2,
            'email' => 'budi@agx.site',
            'address' => 'Ciputra World Surabaya',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        Expedition::factory()->create([
            'description' => 'JNE',
            'price' => 15000,
        ]);

        Expedition::factory()->create([
            'description' => 'J&T',
            'price' => 12000,
        ]);

        Expedition::factory()->create([
            'description' => 'Si Cepat',
            'price' => 12500,
        ]);

        Expedition::factory()->create([
            'description' => 'Anter Aja',
            'price' => 13500,
        ]);

        Store::factory()->create([
            'user_id' => 1,
            'description' => 'Toko ATK Diamond',
        ]);

        ItemCategory::factory()->create([
            'description' => 'Buku',
        ]);

        ItemCategory::factory()->create([
            'description' => 'Pensil',
        ]);

        ItemCategory::factory()->create([
            'description' => 'Ballpoint',
        ]);

        ItemCategory::factory()->create([
            'description' => 'Penggaris',
        ]);

        ItemCategory::factory()->create([
            'description' => 'Penghapus',
        ]);

        Item::factory()->create([
            'item_category_id' => 1,
            'store_id' => 1,
            'description' => 'Buku Tulis Sinar Dunia 36 Lembar',
            'unit_price' => 36000,
        ]);

        Item::factory()->create([
            'item_category_id' => 1,
            'store_id' => 1,
            'description' => 'Buku Mewarnai Untuk Taman Kanak-Kanak',
            'unit_price' => 86000,
        ]);

        Item::factory()->create([
            'item_category_id' => 2,
            'store_id' => 1,
            'description' => 'Pensil 2B',
            'unit_price' => 6000,
        ]);

        Item::factory()->create([
            'item_category_id' => 2,
            'store_id' => 1,
            'description' => 'Pensil Mewarnai',
            'unit_price' => 96000,
        ]);

        Item::factory()->create([
            'item_category_id' => 3,
            'store_id' => 1,
            'description' => 'Ballpoint Standart',
            'unit_price' => 56000,
        ]);

        Item::factory()->create([
            'item_category_id' => 4,
            'store_id' => 1,
            'description' => 'Penggaris Siku',
            'unit_price' => 55000,
        ]);

        Item::factory()->create([
            'item_category_id' => 5,
            'store_id' => 1,
            'description' => 'Penghapus Faber Castell',
            'unit_price' => 5000,
        ]);
    }
}
