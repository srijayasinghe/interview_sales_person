<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'email'=>$this->faker->email(),
            'address'=>$this->faker->address(),
            'telephone'=>$this->faker->numberBetween(0,15),
            'join_date'=>$this->faker->date(),
            'current_route'=>$this->faker->name(),
            'comments'=>$this->faker->sentence(),
            'type'=>'sales'
        ];
    }
}
