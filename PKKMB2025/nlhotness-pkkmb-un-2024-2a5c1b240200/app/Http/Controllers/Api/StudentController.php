<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelompok;
use App\Models\Position;
use App\Models\Role;
use App\Rules\NimRule;
use App\Models\User;
use App\Models\DetailUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use PowerComponents\LivewirePowerGrid\Detail;

class StudentController extends Controller
{

    public function index()
    {
        $dataPeserta = User::where('role_id', 3)->get();
        return response([
            'success' => true,
            'message' => 'List Akun Peserta',
            'data' => $dataPeserta
        ], 200);
    }

    public function detailUser(Request $request){
        $idUser = $request->input('user_id');
        $detailUser = DetailUser::where('user_id', $idUser)->get();

        return response([
            'success' => true,
            'message' => 'Detail User',
            'dataDetail' => $detailUser,
        ]);
    }

    public function indexAdmin()
    {
        $dataAdmin = User::whereIn('role_id', [1, 2])->get();
        return response([
            'success' => true,
            'message' => 'List Akun Admin',
            'data' => $dataAdmin
        ], 200);
    }

    public function create(Request $request)
    {
        $positions = Position::all();
        $roles = Role::all();
        $kelompoks = Kelompok::all();

        // cara lebih cepat, dan kemungkinan data role tidak akan diubah/ditambah
        $roleIdRuleIn = join(',', $roles->pluck('id')->toArray());
        $positionIdRuleIn = join(',', $positions->pluck('id')->toArray());
        $kelompokIdRuleIn = join(',', $positions->pluck('id')->toArray());

        //validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nim' => ['required', new NimRule, 'unique:users,nim'],
            'password' => '',
            'role_id' => 'required|in:' . $roleIdRuleIn,
            'position_id' => 'required|in:' . $positionIdRuleIn,
            'kelompok_id' => 'required|in:' . $kelompokIdRuleIn,
            'prodi' => '',
            'fakultas' => '',
        ], [
            'name.required' => 'Nama mahasiswa harus diisi!',
            'nim.required' => 'NIM harus diisi!',
            'nim.unique' => 'NIM sudah terdaftar, gunakan NIM lain!',
            'role_id.required' => 'Role harus dipilih!',
            'role_id.in' => 'Role yang dipilih tidak valid!',
            'position_id.required' => 'Position harus dipilih!',
            'position_id.in' => 'Position yang dipilih tidak valid!',
            'kelompok_id.required' => 'Kelompok harus dipilih!',
            'kelompok_id.in' => 'Kelompok yang dipilih tidak valid!',
        ]);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $user = User::create([
                'name'     => $request->input('name'),
                'nim'   => $request->input('nim'),
                'password'     => Hash::make($request->input('password')),
                'position_id'   => $request->input('position_id'),
                'role_id'     => $request->input('role_id'),
                'kelompok_id'   => $request->input('kelompok_id'),
            ]);

            $user->detailuser()->create([
                'nim' => $user->nim,
                'prodi' => $request->input('prodi'),
                'fakultas' => $request->input('fakultas'),
                // Other fields
            ]);

            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data User Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data User Gagal Disimpan!',
                ], 401);
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $positions = Position::all();
        $roles = Role::all();
        $kelompoks = Kelompok::all();

        // cara lebih cepat, dan kemungkinan data role tidak akan diubah/ditambah
        $roleIdRuleIn = join(',', $roles->pluck('id')->toArray());
        $positionIdRuleIn = join(',', $positions->pluck('id')->toArray());
        $kelompokIdRuleIn = join(',', $positions->pluck('id')->toArray());

        //validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nim' => ['required', new NimRule, 'unique:users,nim'],
            'password' => '',
            'role_id' => 'required|in:' . $roleIdRuleIn,
            'position_id' => 'required|in:' . $positionIdRuleIn,
            'kelompok_id' => 'required|in:' . $kelompokIdRuleIn,
            'prodi' => '',
            'fakultas' => '',
        ], [
            'name.required' => 'Nama mahasiswa harus diisi!',
            'nim.required' => 'NIM harus diisi!',
            'nim.unique' => 'NIM sudah terdaftar, gunakan NIM lain!',
            'role_id.required' => 'Role harus dipilih!',
            'role_id.in' => 'Role yang dipilih tidak valid!',
            'position_id.required' => 'Position harus dipilih!',
            'position_id.in' => 'Position yang dipilih tidak valid!',
            'kelompok_id.required' => 'Kelompok harus dipilih!',
            'kelompok_id.in' => 'Kelompok yang dipilih tidak valid!',
        ]);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],401);

        } else {

            $user = User::whereId($request->input('id'))->update([
                'name'     => $request->input('name'),
                'nim'   => $request->input('nim'),
                'password'     => Hash::make($request->input('password')),
                'position_id'   => $request->input('position_id'),
                'role_id'     => $request->input('role_id'),
                'kelompok_id'   => $request->input('kelompok_id'),
            ]);

            $user->detailuser()->create([
                'nim' => $user->nim,
                'prodi' => $request->input('prodi'),
                'fakultas' => $request->input('fakultas'),
                // Other fields
            ]);
            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data User Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data User Gagal Diupdate!',
                ], 401);
            }

        }

    }

        /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
        public function destroy($id)
        {
            $user = User::findOrFail($id);
            $user->detailuser()->delete();
            $user->delete();

            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data User Berhasil Dihapus!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data User Gagal Dihapus!',
                ], 400);
            }

        }
}
