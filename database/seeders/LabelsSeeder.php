<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Label::insert(['title' => 'Footware']);
        Label::insert(['title' => 'Clothings']);
        Label::insert(['title' => 'Accessories']);
        Label::insert(['title' => 'New Arrivals']);
    }
}
