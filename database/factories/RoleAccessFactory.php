<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\RoleAccess;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoleAccessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoleAccess::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role_id' => function () {
                return Role::factory()->create()->id;
            },
            'route' => 'App\Http\Controllers\Dashboard\DashboardController@index',
        ];
    }
}


