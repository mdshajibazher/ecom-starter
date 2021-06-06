<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::insert([
            'title'             => 'M',
            'short_description' => '(Medium): Chest 37.7″ inch/ 96 cm, Height 27.5″ inch/ 69 cm'
        ]);
        Size::insert([
            'title'             => 'L',
            'short_description' => '(large) : Chest 39.3″inch/ 100 cm, Height 28.3″/ 71 cm'
        ]);
        Size::insert([
            'title'            => 'XL',
            'short_description'=> '(Extra large): Chest 41″ inch/ 104 cm, Height 29.1″ inch/ 73 cm'
        ]);
        Size::insert([
            'title'             => 'XXL',
            'short_description' => '(Double Extra large) : Chest 42.5″inch/ 108 cm, Height 30″ inch/ 75 cm'
        ]);
    }
}
