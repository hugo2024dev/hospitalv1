<?php

namespace Database\Factories;

use App\Models\TipoDocumento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_documento' => fake()->unique()->randomNumber(8),
            'historia_clinica' => fake()->unique()->randomNumber(5),
            'nombres' => fake()->firstName . ' ' . fake()->firstName,
            'apellido_paterno' => fake()->lastName,
            'apellido_materno' => fake()->lastName,
            'fecha_nacimiento' => fake()->date(),
            'sexo' => fake()->randomElement(['M', 'F']),
            'email' => fake()->unique()->safeEmail,
            'telefono' => fake()->phoneNumber,
            'tipo_documento_id' => TipoDocumento::inRandomOrder()->first()->id,
        ];
    }
}
