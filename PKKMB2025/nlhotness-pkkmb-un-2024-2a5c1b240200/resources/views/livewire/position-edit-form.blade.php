<div>
    <form wire:submit.prevent="savePositions" method="post">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @foreach ($positions as $position)
        <div class="mb-3 position-relative">
            <x-form-label id="name{{ $position['id'] }}"
                label="Nama Jabatan {{ $loop->iteration }} (ID: {{ $position['id'] }})" class="block mb-2 text-sm font-medium text-gray-900"/>
            <div class="d-flex align-items-center">
                <x-form-input id="name{{ $position['id'] }}" name="name{{ $position['id'] }}"
                    wire:model.defer="positions.{{ $loop->index }}.name" value="{{ $position['name'] }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
            </div>
        </div>
        @endforeach

        <div class="flex items-center mb-5">
            <button class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Simpan
                <div wire:loading>
                    ...
                </div>
            </button>
        </div>
    </form>
</div>