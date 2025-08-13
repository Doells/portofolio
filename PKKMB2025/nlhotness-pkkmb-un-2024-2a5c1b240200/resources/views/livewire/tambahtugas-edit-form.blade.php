<div>
    <form wire:submit.prevent="save" method="post" novalidate>
        @csrf
        @include('partials.alerts')
        <div class="w-100">
            <div class="mb-3">
                <x-form-label id="title" label='Nama/Judul Tugas' class="block mb-2 text-sm font-medium text-gray-900"/>
                <x-form-input id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" wire:model.defer="tambahtugas.title">
                </x-form-input>
                <x-form-error key="tambahtugas.title" />
            </div>
            <div class="mb-3">
                <x-form-label id="description" label='Keterangan' class="block mb-2 text-sm font-medium text-gray-900"/>
                <textarea id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    wire:model.defer="tambahtugas.description"></textarea>
                <x-form-error key="tambahtugas.description" />
            </div>
            <div class="mb-3">
                <x-form-label id="start_date" label='Tanggal Mulai' class="block mb-2 text-sm font-medium text-gray-900"/>
                <x-form-input type="date" id="start_date" name="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    wire:model.defer="tambahtugas.start_date"></x-form-input>
                <x-form-error key="tambahtugas.start_date" />
            </div>
            <div class="mb-3">
                <x-form-label id="end_date" label='Tanggal Selesai' class="block mb-2 text-sm font-medium text-gray-900"/>
                <x-form-input type="date" id="end_date" name="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    wire:model.defer="tambahtugas.end_date"></x-form-input>
                <x-form-error key="tambahtugas.end_date" />
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <x-form-label id="start_time" label='Waktu Mulai' class="block mb-2 text-sm font-medium text-gray-900"/>
                        <x-form-input type="time" maxlength="5" id="start_time" name="start_time"
                            wire:model.defer="tambahtugas.start_time" placeholder="07:00" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "/>
                        <x-form-error key="tambahtugas.start_time" />
                    </div>
                    <div class="col-md-6">
                        <x-form-label id="batas_start_time" label='Waktu Selesai' class="block mb-2 text-sm font-medium text-gray-900"/>
                        <x-form-input type="time" maxlength="5" id="batas_start_time" name="batas_start_time"
                            wire:model.defer="tambahtugas.batas_start_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "/>
                        <x-form-error key="tambahtugas.batas_start_time" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="block mb-2 text-sm font-medium text-gray-900">Lampiran (Opsional) Format : jpg,jpeg,png,pdf,doc,docx</div>
                <x-form-input type="file" id="lampiran" name="lampiran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full"
                    wire:model.defer="tambahtugas.lampiran"></x-form-input>
                <x-form-error key="tambahtugas.lampiran"/>
            </div>
            @if($filePath)
            <div class="mb-3">
                <a href="{{ url(Storage::url($filePath)) }}" target="_blank" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 items-end mx-auto justify-end">Lihat</a>
                <a href="{{ url(Storage::url($filePath)) }}" download="{{ $fileName }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 mt-2 items-end mx-auto justify-end">Download</a>
            </div>
            @endif
            <div class="mb-3">
                <x-form-label id="input_type" label='Input Type' class="block mb-2 text-sm font-medium text-gray-900"/>
                <select name="input_type" id="input_type" wire:model.defer="tambahtugas.input_type">
                    <option>-- Pilih Input --</option>
                    <option value="File">File</option>
                    <option value="Text">Text/URL</option>
                </select>
            </div>                        
        </div>

        <div class="flex items-center justify-between">
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Simpan
            </button>
        </div>
    </form>
</div>