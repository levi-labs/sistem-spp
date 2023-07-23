<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'user_id' => 1,
            'nis'  => $this->faker->numerify(),
            'nama' => $this->faker->name(),
            'email' => $this->faker->email(),
            'jenis_kelas' => 'Full Days',
            'periode' => $this->faker->year(),
            'no_hp' => $this->faker->phoneNumber(),
            'nama_ayah' => $this->faker->name(),
            'nama_ibu' => $this->faker->name(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'alamat' => $this->faker->address(),

        ];
    }
}
