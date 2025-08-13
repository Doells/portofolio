<?php

namespace Database\Seeders;

use App\Models\Kelompok;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = storage_path('datauser/datakelompokpanitia2024.csv');

        if (($handle = fopen($csvFile, "r")) !== false) {
            $header = null;

            DB::beginTransaction();

            try {
                while (($row = fgetcsv($handle, 0, ";")) !== false) {
                    if (!$header) {
                        $header = $row;
                        continue;
                    }

                    $data = array_combine($header, $row);

                    // Cek apakah kode_kelompok sudah ada
                    $existData = Kelompok::where('kode_kelompok', $data['kode_kelompok'])->exists();

                    if ($existData) {
                        continue; // Skip ke baris berikutnya tanpa menghentikan seluruh proses
                    }

                    //dd($data);

                    $dataKelompok = Kelompok::create([
                        'kode_kelompok' => $data['kode_kelompok'],
                        'name' => $data['kelompok'],
                    ]);

                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            } finally {
                fclose($handle);
            }
        }
    }
}
