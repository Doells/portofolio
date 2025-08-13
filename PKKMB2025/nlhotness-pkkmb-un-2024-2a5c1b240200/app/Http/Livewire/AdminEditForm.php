<?php

namespace App\Http\Livewire;

use App\Http\Traits\useUniqueValidation;
use App\Models\DetailUser;
use App\Models\Kelompok;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use App\Rules\NimRule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;

class adminEditForm extends Component
{
    use useUniqueValidation;

    public $students;
    public Collection $roles;
    public Collection $kelompoks;
    public Collection $positions;
    public Collection $detailuser;

    public function mount(Collection $students)
    {
        $this->students = []; // reset, karena ada data students sebelumnya

        foreach ($students as $student) {
            $this->students[] = [
                'id' => $student->id,
                'name' => $student->name,
                'nim' => $student->nim,
                'nim' => $student->nim, // untuk cek validasi unique
                'role_id' => $student->role_id,
                'position_id' => $student->position_id,
                'kelompok_id' => $student->kelompok_id,
                'prodi' => $student->Detailuser->prodi,
                'fakultas' => $student->Detailuser->fakultas,
                'no_hp' => $student->Detailuser->no_hp,
                'email' => $student->Detailuser->email,
                'sistem_kuliah' => $student->Detailuser->sistem_kuliah,
                'tahun_angkatan' => $student->Detailuser->tahun_angkatan,
                'jalur_penerimaan' => $student->Detailuser->jalur_penerimaan,
                'jenis_kelamin' => $student->Detailuser->jenis_kelamin,
                'tgl_lahir' => $student->Detailuser->tgl_lahir,
                'tempat_lahir' => $student->Detailuser->tempat_lahir,
                'agama' => $student->Detailuser->agama,
                'alamat' => $student->Detailuser->alamat,

            ];
        }
        $this->roles = Role::all();
        $this->kelompoks = Kelompok::all();
        $this->positions = Position::all();
        $this->detailuser = DetailUser::all();
    }

    public function saveStudents()
    {
        $roleIdRuleIn = join(',', $this->roles->pluck('id')->toArray());
        $positionIdRuleIn = join(',', $this->positions->pluck('id')->toArray());
        $kelompokIdRuleIn = join(',', $this->kelompoks->pluck('id')->toArray());
    
        $this->validate([
            'students.*.name' => 'required',
            'students.*.nim' => ['required', new NimRule],
            'students.*.password' => '',
            'students.*.role_id' => 'required|in:' . $roleIdRuleIn,
            'students.*.position_id' => 'required|in:' . $positionIdRuleIn,
            'students.*.kelompok_id' => 'required|in:' . $kelompokIdRuleIn,
        ]);
    
        if (!$this->isUniqueOnLocal('nim', $this->students)) {
            $this->dispatchBrowserEvent('livewire-scroll', ['top' => 0]);
            return session()->flash('failed', 'Pastikan input NIM tidak mengandung nilai yang sama dengan input lainnya.');
        }
    
        $affected = 0;
        foreach ($this->students as $student) {
            $studentBeforeUpdated = User::find($student['id']);
    
            if (!$this->isUniqueOnDatabase($studentBeforeUpdated, $student, 'nim', User::class)) {
                // Skip validation if NIM is same as original data
                if ($student['nim'] !== $studentBeforeUpdated->nim) {
                    $this->dispatchBrowserEvent('livewire-scroll', ['top' => 0]);
                    return session()->flash('failed', "NIM dari data admin {$student['id']} sudah terdaftar. Silahkan masukkan NIM yang berbeda!");
                }
            }
        
            $affected += $studentBeforeUpdated->update([
                'name' => $student['name'],
                'nim' => $student['nim'],
                'role_id' => $student['role_id'],
                'position_id' => $student['position_id'],
                'kelompok_id' => $student['kelompok_id'],
            ]);
        
            $studentBeforeUpdatedDetail = DetailUser::updateOrCreate(
                ['user_id' => $studentBeforeUpdated->id], // Kriteria untuk mencari entitas
                [
                    'nim' => $student['nim'],
                    'prodi' => $student['prodi'],
                    'fakultas' => $student['fakultas'],
                    'no_hp' => $student['no_hp'],
                    'email' => $student['email'],
                    'sistem_kuliah' => $student['sistem_kuliah'],
                    'tahun_angkatan' => $student['tahun_angkatan'],
                    'jalur_penerimaan' => $student['jalur_penerimaan'],
                    'jenis_kelamin' => $student['jenis_kelamin'],
                    'tgl_lahir' => $student['tgl_lahir'],
                    'tempat_lahir' => $student['tempat_lahir'],
                    'agama' => $student['agama'],
                    'alamat' => $student['alamat'],
                ]
            );            
        }        
    
        $message = $affected === 0 ?
            "Tidak ada data admin yang diubah." :
            "Ada $affected data Admin yang berhasil diedit.";
    
        return redirect()->route('admin.index')->with('success', $message);
    }

    public function render()
    {
        return view('livewire.admin-edit-form');
    }
}
