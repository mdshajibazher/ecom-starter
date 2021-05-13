<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Subcollection;
use Illuminate\Database\Seeder;
use Database\Seeders\CollectionSeeder;
use Database\Seeders\SubcollectionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Collection::factory(100)->create();
        // Subcollection::factory(100)->create();
        // $this->call(VariantSeeder::class);
        // $this->call(SettingSeeder::class);
        // $this->call(LabelsSeeder::class);
        // $this->call(CollectionSeeder::class);
        // $this->call(SubcollectionSeeder::class);
        // $this->call(PermissionSeeder::class);
        // $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(MenuSeeder::class);
    }
}
