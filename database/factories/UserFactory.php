<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // return [
        //     'username' => $this->faker->name(),
        //     'email' => $this->faker->unique()->safeEmail(),
        //     'nomer' => $this->faker->phoneNumber(),
        //     'password' => bcrypt('alan123'), // password
        //     'gambar' => 'user.png',
        //     'rules' => 'engineer',
        // ];

        return [
            'username' => 'Admin Manager',
            'email' => 'adminmanager123@gmail.com',
            'nomer' => '082143725689',
            'password' => bcrypt('admin123'), // password
            'gambar' => 'user.png',
            'rules' => 'admin',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
