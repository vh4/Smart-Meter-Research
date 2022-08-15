<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public static function total_id($parameter){
        for($i=1; $i<= $parameter; $i++){
            return $i++;
        }
    }

    public function definition()
    {
        return [
            'user_id' => $this->total_id(12),
            'token' => 0, //$this->faker->numerify('####################')
        ];
    }
}
