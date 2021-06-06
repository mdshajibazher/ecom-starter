<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::insert([
            'title'      => 'BARA RED',
            'color_code' => '#ED4C67'
        ]);
        Color::insert([
            'title'      => 'HOLYHOCK',
            'color_code' => '#833471'
        ]);
        Color::insert([
            'title' => 'BLUE MARTINA',
            'color_code' => '#12CBC4'
        ]);
        Color::insert([
            'title' => 'SUNFLOWER',
            'color_code' => '#FFC312'
        ]);
        Color::insert([
            'title' => 'PUFFINS BILL',
            'color_code' => '#EE5A24'
        ]);
    }
}
