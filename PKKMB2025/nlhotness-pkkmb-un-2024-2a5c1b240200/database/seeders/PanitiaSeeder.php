<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\DetailUser;

class PanitiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = storage_path('datauser/datapanitia.csv');

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

                    //dd($data);

                    $user = User::create([
                        'name' => $data['nama'],
                        'nim' => $data['nim'],
                        'password' => Hash::make($data['password']),
                        'position_id' => $data['position_id'],
                        'role_id' => $data['role_id'],
                        'kelompok_id' => null,
                    ]);

                    /* $kelompok = Kelompok::create([
                        'name' => $data['kelompok'],
                    ]); */

                    $detail = DetailUser::create([
                        'user_id' => $user->id,
                        'photo' => '',
                        'nim' => $data['nim'],
                        'email' => $data['email'],
                        'nama_lengkap' => $data['nama'],
                        'prodi' => $data['prodi'],
                        'fakultas' => $data['fakultas'],
                        'no_hp' => $data['no_hp'],
                        'sistem_kuliah' => $data['sistem_kuliah'],
                        'tahun_angkatan' => $data['tahun_angkatan'],
                        'jalur_penerimaan' => $data['jalur_penerimaan'],
                        'jenis_kelamin' => $data['jenis_kelamin'],
                        'tgl_lahir' => $data['tgl_lahir'],
                        'tempat_lahir' => $data['tempat_lahir'],
                        'agama' => $data['agama'],
                        'alamat' => $data['alamat'],
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
