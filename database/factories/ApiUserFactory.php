<?php

namespace Database\Factories;

use App\Models\ApiUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ApiUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApiUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'active' => $this->faker->boolean(50),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'created_at' => $this->faker->dateTime('now'),
            'updated_at' => $this->faker->dateTime('now'),
            'deleted_at' => null,
        ];
    }
}
