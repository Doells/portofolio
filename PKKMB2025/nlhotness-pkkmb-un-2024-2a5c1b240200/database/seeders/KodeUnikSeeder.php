<?php

namespace Database\Seeders;

use App\Models\UniqueCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class KodeUnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Jumlah kode unik yang ingin di-generate
        $jumlahKode = 500;

        for ($i = 0; $i < $jumlahKode; $i++) {
            UniqueCode::create([
                'unique_code' => Str::random(10) // Generate kode unik sepanjang 10 karakter
            ]);
        }
    }
}
