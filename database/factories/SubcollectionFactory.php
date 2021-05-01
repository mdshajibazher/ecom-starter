<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Subcollection;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcollectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcollection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'slug' => Str::slug($this->faker->name),
            'label_id' => rand(1,4),
        ];
    }
}
