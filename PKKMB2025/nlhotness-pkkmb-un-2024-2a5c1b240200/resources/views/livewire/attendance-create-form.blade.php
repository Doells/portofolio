<div>
    <form wire:submit.prevent="save" method="post" novalidate>
        @include('partials.alerts')
        <div class="w-100">
            <div class="mb-3">
                <x-form-label id="title" label='Nama/Judul Presensi' class="block mb-2 text-sm font-medium text-gray-900"/>
                <x-form-input id="title" name="title" wire:model.defer="attendance.title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "/>
                <x-form-error key="attendance.title" />
            </div>
            <div class="mb-3">
                <x-form-label id="description" label='Keterangan' class="block mb-2 text-sm font-medium text-gray-900"/>
                <textarea id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    wire:model.defer="attendance.description"></textarea>
                <x-form-error key="attendance.description" />
            </div>
            <div class="mb-3">
                <x-form-label id="date" label='Tanggal' class="block mb-2 text-sm font-medium text-gray-900"/>
                <x-form-input type="date" id="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    wire:model.defer="attendance.date"></x-form-input>
                <x-form-error key="attendance.date" />
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <x-form-label id="start_time" label='Waktu Absen Masuk' class="block mb-2 text-sm font-medium text-gray-900"/>
                        <x-form-input type="time" maxlength="5" id="start_time" name="start_time"
                            wire:model.defer="attendance.start_time" placeholder="07:00" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "/>
                        <x-form-error key="attendance.start_time" />
                    </div>
                    <div class="col-md-6">
                        <x-form-label id="batas_start_time" label='Batas Waktu Absen Masuk' class="block mb-2 text-sm font-medium text-gray-900"/>
                        <x-form-input type="time" maxlength="5" id="batas_start_time" name="batas_start_time"
                            wire:model.defer="attendance.batas_start_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "/>
                        <x-form-error key="attendance.batas_start_time" />
                    </div>
                </div>
                <small class="text-muted d-block mt-1">Masukan dengan format 12:00 AM/PM.</small>
            </div>
            {{-- <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <x-form-label id="end_time" label='Waktu Presensi Keluar' class="block mb-2 text-sm font-medium text-gray-900"/>
                        <x-form-input type="time" maxlength="5" id="end_time" name="end_time"
                            wire:model.defer="attendance.end_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "/>
                        <x-form-error key="attendance.end_time" />
                    </div>
                    <div class="col-md-6">
                        <x-form-label id="batas_end_time" label='Batas Waktu Presensi Keluar' class="block mb-2 text-sm font-medium text-gray-900"/>
                        <x-form-input type="time" maxlength="5" id="batas_end_time" name="batas_end_time"
                            wire:model.defer="attendance.batas_end_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "/>
                        <x-form-error key="attendance.batas_end_time" />
                    </div>
                </div>
                <small class="text-muted d-block mt-1">Masukan dengan format 12:00 AM/PM.</small>
            </div> --}}

            <div class="mb-3">
                <x-form-label id="positions" label='Posisi' class="block mb-2 text-sm font-medium text-gray-900"/>
                <div class="row ms-1">
                    @foreach ($positions as $position)
                    <div class="form-check col-sm-4">
                        <input class="form-check-input" type="checkbox" value="{{ $position->id }}"
                            wire:model.defer="position_ids.{{ $position->id }}"
                            id="flexCheckPosition{{ $loop->index }}">
                        <label class="form-check-label" for="flexCheckPosition{{ $loop->index }}">
                            {{ $position->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <small class="text-muted d-block mt-1">Pilih posisi peserta/panitia yang akan menggunakan absensi ini.</small>
                <x-form-error key="position_ids" />
                {{-- tom-select init script ada di create.blade.php attendances --}}
            </div>


            <div class="mb-3">
                <x-form-label id="flexCheckCode" label='Sistem Presensi' class="block mb-2 text-sm font-medium text-gray-900"/>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" checked wire:model.defer="attendance.code"
                        id="flexCheckCode">
                    <label class="form-check-label" for="flexCheckCode">
                        Menggunakan QRCode
                    </label>
                    <x-form-error key="attendance.code" />
                </div>
            </div>

        </div>

        <div class="flex items-center justify-between">
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Simpan
            </button>
        </div>
    </form>
</div>