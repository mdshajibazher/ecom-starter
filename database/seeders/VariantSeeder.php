<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variants')->insert([
            'title' => 'color',
            'description' => 'for size variants',
        ]);

        DB::table('variants')->insert([
            'title' => 'Size',
            'description' => 'for color variants',
        ]);
    }
}
