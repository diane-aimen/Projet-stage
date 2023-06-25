<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
class UserFactory extends Factory {

    public function definition() {
        return [
            'name' => 'prof2',
            'email' => 'prof2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'), // password
            'remember_token' => Str::random(10),
            'id_role'=>3,
        ];
    }


    public function unverified() {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}


