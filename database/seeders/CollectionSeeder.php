<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collections')->insert([
            'title' => 'Men',
            'slug' => 'men',
        ]);

        DB::table('collections')->insert([
            'title' => 'Women',
            'slug' => 'women',
        ]);

        DB::table('collections')->insert([
            'title' => 'Kids',
            'slug' => 'kids',
        ]);
    }
}
