<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'semestre' => $this->faker->randomDigit,
            'nombre' => $this->faker->word,
            'creditos' => $this->faker->randomDigit,
            'docente' => $this->faker->name,
            'prerrequisito' => $this->faker->name,
            'htrabajoautonomo' => $this->faker->randomDigit,
            'htrabajodirigido' => $this->faker->randomDigit
        ];
    }
}
          