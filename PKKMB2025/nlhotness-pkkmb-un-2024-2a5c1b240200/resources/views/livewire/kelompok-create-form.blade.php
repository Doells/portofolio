<div>
    <form wire:submit.prevent="saveKelompok" method="post">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @foreach ($kelompok as $i => $item)
        <div class="mb-3 position-relative">
            <x-form-label id="kode_kelompok{{ $i }}" label='Kode Kelompok {{ $i + 1 }}' class="block mb-2 text-sm font-medium text-gray-900"/>
            <div class="d-flex align-items-center">
                <x-form-input id="kode_kelompok{{ $i }}" name="kode_kelompok{{ $i }}" wire:model.defer="kelompok.{{ $i }}.kode_kelompok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                @if ($i > 0)
                <button class="btn btn-danger ms-2" wire:click="removeKelompokInput({{ $i }})"
                    wire:target="removeKelompokInput({{ $i }})" type="button"
                    wire:loading.attr="disabled">Hapus</button>
                @endif
            </div>
        </div>
        <div class="mb-3 position-relative">
            <x-form-label id="name{{ $i }}" label='Nama Kelompok {{ $i + 1 }}' class="block mb-2 text-sm font-medium text-gray-900"/>
            <div class="d-flex align-items-center">
                <x-form-input id="name{{ $i }}" name="name{{ $i }}" wire:model.defer="kelompok.{{ $i }}.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
                @if ($i > 0)
                <button class="btn btn-danger ms-2" wire:click="removeKelompokInput({{ $i }})"
                    wire:target="removeKelompokInput({{ $i }})" type="button"
                    wire:loading.attr="disabled">Hapus</button>
                @endif
            </div>
        </div>
        @endforeach

        <div class="flex items-center mb-5">
            <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Simpan
            </button>
            <button class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" type="button" wire:click="addKelompokInput" wire:loading.attr="disabled">
                Tambah Input
            </button>
        </div>
    </form>
</div>