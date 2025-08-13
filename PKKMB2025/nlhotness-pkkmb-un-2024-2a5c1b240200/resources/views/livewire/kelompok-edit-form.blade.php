<div>
    <form wire:submit.prevent="editKelompok">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="mb-3 position-relative">
            <x-form-label id="kode_kelompok" label="Kode Kelompok" class="block mb-2 text-sm font-medium text-gray-900"/>
            <div class="d-flex align-items-center">
                <x-form-input id="kode_kelompok" name="kode_kelompok" wire:model="kelompok.kode_kelompok"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
            </div>
        </div>
        <div class="mb-3 position-relative">
            <x-form-label id="name" label="Nama Kelompok" class="block mb-2 text-sm font-medium text-gray-900"/>
            <div class="d-flex align-items-center">
                <x-form-input id="name" name="name" wire:model="kelompok.name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
            </div>
        </div>

        <div class="flex items-center mb-5">
            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Simpan
            </button>
        </div>
    </form>
</div>
