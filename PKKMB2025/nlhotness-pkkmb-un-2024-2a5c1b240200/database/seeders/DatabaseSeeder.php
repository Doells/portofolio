<?php

namespace Database\Seeders;

use App\Models\DetailUser;
use App\Models\Kelompok;
use App\Models\UniqueCode;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(KelompokSeeder::class);
        $this->call(KelompokPesertaSeeder::class);
        $this->call(KodeUnikSeeder::class);
        $this->call(PesertaSeeder::class);

        $csvFile = storage_path('datauser/datapanitia2024.csv');

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

                    $dataKelompok = Kelompok::where('kode_kelompok', $data['kode_kelompok'])->get()->first();

                    $user = User::create([
                        'name' => $data['nama'],
                        'nim' => '0' . $data['nim'],
                        'password' => Hash::make($data['password']),
                        'position_id' => 2,
                        'role_id' => $data['role_id'],
                        'kelompok_id' => $dataKelompok->id ?? '',
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
                        'no_hp' => '0' . $data['no_hp'],
                        'sistem_kuliah' => $data['sistem_kuliah'] ?? '',
                        'tahun_angkatan' => $data['tahun_angkatan'] ?? '',
                        'jalur_penerimaan' => $data['jalur_penerimaan'] ?? '',
                        'jenis_kelamin' => $data['jenis_kelamin'] ?? '',
                        'tgl_lahir' => $data['tgl_lahir'] ?? '',
                        'tempat_lahir' => $data['tempat_lahir'] ?? '',
                        'agama' => $data['agama'] ?? '',
                        'alamat' => $data['alamat'] ?? '',
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

        /* \App\Models\User::factory()->create([
            'name' => 'Bagus Adianto (Admin)',
            'nim' => '04321028',
            'role_id' => Role::where('name', 'superadmin')->first('id'),
            'position_id' => Position::where('name', 'Panitia')->first('id'),
        ]);
        \App\Models\User::factory(1)->create([
            'role_id' => Role::where('name', 'superadmin')->first('id'),
            'position_id' => Position::where('name', 'Panitia')->first('id'),
        ]);
        \App\Models\User::factory(10)->create([
            'role_id' => Role::where('name', 'user')->first('id'), // user === employee
            'position_id' => Position::select('id')->inRandomOrder()->first()->id
        ]); */
    }
}
