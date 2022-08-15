<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DatalistrikFactory extends Factory
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
            'sisa_pulsa' => null, //$this->faker->randomFloat(2, 30.0, 30.9),
            'sisa_pulsa_n-1' => null //$this->faker->randomFloat(2, 31.0, 31.9),
        ];
    }
}
