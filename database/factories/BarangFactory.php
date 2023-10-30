<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_barang'=>$this->faker->sentence(2,6),
            'kode_barang'=>$this->faker->unique()->word(),
            // 'slug'=>$this->faker->slug(),
            'kondisi'=>'Bagus',
            'status'=>'Tersedia',
            'deskripsi'=>$this->faker->paragraph(),
            'laboratorium_id'=>mt_rand(1,4),
            'lokasi_penyimpanan_id'=>mt_rand(1,4)
        ];
    }
}
