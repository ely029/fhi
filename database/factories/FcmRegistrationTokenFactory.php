<?php

namespace Database\Factories;

use App\Models\FcmRegistrationToken;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FcmRegistrationTokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FcmRegistrationToken::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'registration_id' => $this->faker->uuid,
            'created_at' => date('Y-m-d H:i:s'),
        ];
    }
}


