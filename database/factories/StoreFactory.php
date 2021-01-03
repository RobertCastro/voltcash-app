<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => User::all()->random()->id,
            "legal_name" => $this->faker->company,
            "email" => $this->faker->email,
            "ein_tin" => $this->faker->numberBetween($min = 1111, $max = 9999),
            "years_in_business" => $this->faker->randomDigitNot(0),
            "address" => $this->faker->address,
            "telephone" => $this->faker->tollFreePhoneNumber,
            "email" => $this->faker->email,
            "outside_picture_store" => $this->faker->imageUrl(200, 200, 'cats'),
            "inside_pictures_store" => $this->faker->imageUrl(200, 200, 'cats'),
            "status" => $this->faker->randomElement(['Pending', 'Approved', 'Declined', 'Finished']),


        ];
    }
}
