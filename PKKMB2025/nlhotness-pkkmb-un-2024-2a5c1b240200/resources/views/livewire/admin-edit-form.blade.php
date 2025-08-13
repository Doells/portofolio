<div>
    <form wire:submit.prevent="saveStudents" method="post" novalidate>
        @include('partials.alerts')
        @foreach ($students as $student)

        <div class="mb-3">
            <div class="w-100">
                <div class="mb-3">
                    <x-form-label id="name{{ $student['id'] }}"
                        label="Nama Peserta (ID: {{ $student['id'] }})" class="block mb-2 text-sm font-medium text-gray-900"/>
                    <x-form-input id="name{{ $student['id'] }}" name="name{{ $student['id'] }}"
                        wire:model.defer="students.{{ $loop->index }}.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                    <x-form-error key="students.{{ $loop->index }}.name" />
                </div>
                <div class="mb-3">
                    <x-form-label id="nim{{ $student['id'] }}" label='NIM Peserta' class="block mb-2 text-sm font-medium text-gray-900"/>
                    <x-form-input id="nim{{ $student['id'] }}" name="nim{{ $student['id'] }}" type="nim"
                        wire:model.defer="students.{{ $loop->index }}.nim" placeholder="NIM Peserta" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                    <x-form-error key="students.{{ $loop->index }}.nim" />
                </div>
                <div class="mb-3">
                    <x-form-label id="password{{ $student['id'] }}" label='Password' class="block mb-2 text-sm font-medium text-gray-900"/>
                    <x-form-input id="password{{ $student['id'] }}" name="password{{ $student['id'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                </div>
                <div class="mb-3">
                    <x-form-label id="position_id{{ $student['id'] }}"
                        label='Posisi' class="block mb-2 text-sm font-medium text-gray-900"/>
                    <select aria-label="Default select example" name="position_id"
                        wire:model.defer="students.{{ $loop->index }}.position_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        @if (auth()->user()->role->id == 2)
                            disabled
                        @endif>
                        <option selected disabled>-- Pilih Posisi --</option>
                        @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ ucfirst($position->name) }}</option>
                        @endforeach
                    </select>
                    @if (auth()->user()->role->id == 2)
                        <small class="text-red-500">Anda tidak memiliki akses untuk mengubah Posisi!</small>
                    @endif
                    <x-form-error key="students.{{ $loop->index }}.position_id" />
                </div>
                <div class="mb-3">
                    <x-form-label id="role_id{{ $student['id'] }}" label='Role' class="block mb-2 text-sm font-medium text-gray-900"/>
                    <select aria-label="Default select example" name="role_id"
                        wire:model.defer="students.{{ $loop->index }}.role_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        @if (auth()->user()->role->id == 2)
                            disabled
                        @endif>
                        <option selected disabled>-- Pilih Role --</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    @if (auth()->user()->role->id == 2)
                        <small class="text-red-500">Anda tidak memiliki akses untuk mengubah Role!</small>
                    @endif
                    <x-form-error key="students.{{ $loop->index }}.role_id" />
                </div>
                <div class="mb-3">
                    <x-form-label id="kelompok_id{{ $student['id'] }}"
                        label='Kelompok' class="block mb-2 text-sm font-medium text-gray-900"/>
                    <select aria-label="Kelompok" name="kelompok_id"
                        wire:model.defer="students.{{ $loop->index }}.kelompok_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>-- Pilih Kelompok --</option>
                        @foreach ($kelompoks as $kelompok)
                        <option value="{{ $kelompok->id }}">{{ ucfirst($kelompok->name) }}</option>
                        @endforeach
                    </select>
                    <x-form-error key="students.{{ $loop->index }}.kelompok_id" />
                </div>
                {{-- <div class="mb-3">
                    <x-form-label id="nama_lengkap{{ $student['id'] }}" label='Kelompok' class="block mb-2 text-sm font-medium text-gray-900"/>
                    <x-form-input id="kelompok{{ $student['id'] }}" name="kelompok{{ $student['id'] }}" wire:model.defer="students.{{ $loop->index }}.kelompok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                </div> --}}
                <div class="mb-3">
                    <x-form-label id="prodi{{ $student['id'] }}" label='Program Studi' class="block mb-2 text-sm font-medium text-gray-900"/>
                    <select aria-label="Program Studi" name="prodi"
                        wire:model.defer="students.{{ $loop->index }}.prodi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>-- Pilih Program Studi --</option>
                        <option value="Akuntansi">Akuntansi</option>
                        <option value="Manajemen">Manajemen</option>
                        <option value="Ilmu Hukum">Ilmu Hukum</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Sistem Komputer">Sistem Komputer</option>
                        <option value="PG Paud">PG Paud</option>
                    </select>
                    <x-form-error key="students.{{ $loop->index }}.role_id" />
                </div>
                <div class="mb-3">
                    <x-form-label id="fakultas{{ $student['id'] }}" label='Fakultas' class="block mb-2 text-sm font-medium text-gray-900"/>
                    <select aria-label="Fakultas" name="fakultas"
                        wire:model.defer="students.{{ $loop->index }}.fakultas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>-- Pilih Fakultas --</option>
                        <option value="Ekonomi dan Bisnis">Ekonomi dan Bisnis</option>
                        <option value="Hukum">Hukum</option>
                        <option value="Teknik">Teknik</option>
                        <option value="Ilmu Komputer">Ilmu Komputer</option>
                        <option value="Ilmu Pendidikan">Ilmu Pendidikan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="block mb-2 text-sm font-medium text-gray-900">No Telepon</div>
                    <x-form-input id="no_hp{{ $student['id'] }}" name="no_hp{{ $student['id'] }}" wire:model.defer="students.{{ $loop->index }}.no_hp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                </div>
                <div class="mb-3">
                    <div class="block mb-2 text-sm font-medium text-gray-900">Email</div>
                    <x-form-input id="email{{ $student['id'] }}" name="email{{ $student['id'] }}" wire:model.defer="students.{{ $loop->index }}.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                </div>
                <div class="mb-3">
                    <div class="block mb-2 text-sm font-medium text-gray-900">Sistem Kuliah</div>
                    <select aria-label="Sistem Kuliah" name="sistem_kuliah" wire:model="students.{{ $loop->index }}.sistem_kuliah"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>-- Pilih Sistem Kuliah --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="block mb-2 text-sm font-medium text-gray-900">Tahun Angkatan</div>
                    <x-form-input id="tahun_angkatan{{ $student['id'] }}" name="tahun_angkatan{{ $student['id'] }}" wire:model.defer="students.{{ $loop->index }}.tahun_angkatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                </div>
                <div class="mb-3">
                    <div class="block mb-2 text-sm font-medium text-gray-900">Jalur Penerimaan</div>
                    <x-form-input id="jalur_penerimaan{{ $student['id'] }}" name="jalur_penerimaan{{ $student['id'] }}" wire:model.defer="students.{{ $loop->index }}.jalur_penerimaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                </div>
                <div class="mb-3">
                    <div class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</div>
                    <select aria-label="Sistem Kuliah" name="jenis_kelamin" wire:model="students.{{ $loop->index }}.jenis_kelamin"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>-- Pilih Jenis Kelamin --</option>
                        <option value="Laki - laki">Laki - laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</div>
                    <x-form-input-date id="tgl_lahir{{ $student['id'] }}" name="tgl_lahir{{ $student['id'] }}" wire:model.defer="students.{{ $loop->index }}.tgl_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                </div>
                <div class="mb-3">
                    <div class="block mb-2 text-sm font-medium text-gray-900">Tempat Lahir</div>
                    <x-form-input id="tempat_lahir{{ $student['id'] }}" name="tempat_lahir{{ $student['id'] }}" wire:model.defer="students.{{ $loop->index }}.tempat_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                </div>
                <div class="mb-3">
                    <div class="block mb-2 text-sm font-medium text-gray-900">Agama</div>
                    <x-form-input id="agama{{ $student['id'] }}" name="agama{{ $student['id'] }}" wire:model.defer="students.{{ $loop->index }}.agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                </div>
                <div class="mb-3">
                    <div class="block mb-2 text-sm font-medium text-gray-900">Alamat</div>
                    <x-form-input id="alamat{{ $student['id'] }}" name="alamat{{ $student['id'] }}" wire:model.defer="students.{{ $loop->index }}.alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                </div>
            </div>
        </div>
        <hr>
        @endforeach

        <div class="flex items-center mb-5">
            <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Simpan
            </button>
        </div>
    </form>
</div>