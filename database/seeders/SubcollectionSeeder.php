<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcollections')->insert([
            'title' => 'Casual Shoes',
            'slug' => 'casual-shoes',
            'label_id' => 1,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Formal Shoes',
            'slug' => 'formal-shoes',
            'label_id' => 1,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Sports Shoes',
            'slug' => 'sports-shoes',
            'label_id' => 1,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Flip Flops',
            'slug' => 'flip-flops',
            'label_id' => 1,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Sports Sandal',
            'slug' => 'sports-sandal',
            'label_id' => 1,
        ]);


        DB::table('subcollections')->insert([
            'title' => 'Casual Shirts',
            'slug' => 'casual-shirts',
            'label_id' => 2,
        ]);


        DB::table('subcollections')->insert([
            'title' => 'T Shirts',
            'slug' => 't-shirts',
            'label_id' => 2,
        ]);


        DB::table('subcollections')->insert([
            'title' => 'Collard Shirts',
            'slug' => 'collared-shirts',
            'label_id' => 2,
        ]);


        DB::table('subcollections')->insert([
            'title' => 'Pants/Trouser',
            'slug' => 'pants-trouser',
            'label_id' => 2,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Ethic Ware',
            'slug' => 'ethic-ware',
            'label_id' => 2,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Jeans Ware',
            'slug' => 'jeans',
            'label_id' => 2,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Sweam Ware',
            'slug' => 'sweam-ware',
            'label_id' => 2,
        ]);


        DB::table('subcollections')->insert([
            'title' => 'Bag Packs',
            'slug' => 'bag-packs',
            'label_id' => 3,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Watches',
            'slug' => 'watches',
            'label_id' => 3,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Sunglasses',
            'slug' => 'sunglasses',
            'label_id' => 3,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Wallet',
            'slug' => 'wallet',
            'label_id' => 3,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Caps',
            'slug' => 'caps',
            'label_id' => 3,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Jewelerry',
            'slug' => 'jewelerry',
            'label_id' => 3,
        ]);

        DB::table('subcollections')->insert([
            'title' => 'Belts/Ties',
            'slug' => 'belts-ties',
            'label_id' => 3,
        ]);
    }
}
