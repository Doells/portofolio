<?php

namespace App\Http\Livewire;

use App\Models\Kelompok;
use App\Models\Position;
use App\Models\Role;
use App\Rules\NimRule;
use App\Models\User;
use App\Models\DetailUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminCreateForm extends Component
{
    public $students;
    public Collection $roles;
    public Collection $positions;
    public Collection $kelompoks;

    public function mount()
    {
        $this->positions = Position::all();
        $this->roles = Role::all();
        $this->kelompoks = Kelompok::all();
        $this->students = [
            [
             'name' => '', 
             'nim' => '', 
             'password' => '', 
             'role_id' => User::USER_ROLE_ID, 
             'position_id' => $this->positions->first()->id, 
             'kelompok_id' => $this->positions->first()->id,
             'prodi' => '',
             'fakultas' => '',
            ]
        ];
    }

    public function addStudentInput(): void
    {
        $this->students[] = ['name' => '', 
                             'nim' => '',
                             'password' => '', 
                             'role_id' => User::USER_ROLE_ID, 
                             'position_id' => $this->positions->first()->id, 
                             'kelompok_id' => $this->kelompoks->first()->id,
                             'prodi' => '',
                             'fakultas' => '',];
    }

    

    public function removeStudentInput(int $index): void
    {
        unset($this->students[$index]);
        $this->students = array_values($this->students);
    }

    public function savestudents()
    {
        // cara lebih cepat, dan kemungkinan data role tidak akan diubah/ditambah
        $roleIdRuleIn = join(',', $this->roles->pluck('id')->toArray());
        $positionIdRuleIn = join(',', $this->positions->pluck('id')->toArray());
        $kelompokIdRuleIn = join(',', $this->positions->pluck('id')->toArray());
    
        // setidaknya input pertama yang hanya required,
        // karena nanti akan difilter apakah input kedua dan input selanjutnya apakah berisi
        $this->validate([
            'students.*.name' => 'required',
            'students.*.nim' => ['required', new NimRule ,'unique:users,nim'],
            'students.*.password' => '',
            'students.*.role_id' => 'required|in:' . $roleIdRuleIn,
            'students.*.position_id' => 'required|in:' . $positionIdRuleIn,
            'students.*.kelompok_id' => 'required|in:' . $kelompokIdRuleIn,
            'students.*.prodi' => '',
            'students.*.fakultas' => '',
        ]);
    
        $affected = 0;
        foreach ($this->students as $studentData) {
            if (trim($studentData['password']) === '') {
                $studentData['password'] = '123';
            }
            
            $studentData['password'] = Hash::make($studentData['password']);
            
            // Create User
            $createdUser = User::create($studentData);
            

            //dd($studentData);
            // Create DetailUser and associate it with the User
            $createdUser->detailuser()->create([
                'nim' => $createdUser->nim,
                'prodi' => $studentData['prodi'],
                'fakultas' => $studentData['fakultas'],
                // Other fields
            ]);
            
            $affected++;
        }
        
    
        return redirect()->route('admin.index')->with('success', "Ada ($affected) data peserta yang berhasil ditambahkan.");
    }
    
    

    public function render()
    {
        return view('livewire.admin-create-form');
    }
}
