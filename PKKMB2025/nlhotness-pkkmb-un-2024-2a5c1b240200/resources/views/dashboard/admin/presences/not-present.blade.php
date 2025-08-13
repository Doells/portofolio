@extends('layouts.dashboard.app')

@section('buttons')
<div class="btn-toolbar mb-2 mb-md-0">
    <div>
        <a href="{{ route('presences.show', $attendance->id) }}" class="btn btn-sm btn-light">
            <span data-feather="arrow-left-circle" class="align-text-bottom"></span>
            Kembali
        </a>
    </div>
</div>
@endsection

@section('content')
@include('partials.alerts')

<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <h5 class="font-bold text-lg">Judul : {{ $attendance->title }}</h5>
                <h6 class="text-sm">Deskripsi : {{ $attendance->description }}</h6>
                <div class="d-flex align-items-center gap-2">
                    <span href="" class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">Tidak Hadir</span>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <form action="" method="get">
                    <div class="mb-3">
                        <label for="filterDate" class="text-gray-500">Tampilkan Berdasarkan Tanggal</label>
                        <div class="input-group mb-3">
                            <input type="date" class="rounded-md border-gray-500" id="filterDate" name="display-by-date"
                                value="{{ request('display-by-date') }}">
                            <button class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-md" type="submit" id="button-addon1">Tampilkan</button>
                        </div>
                    </div>
                </form>
            </div> --}}
        </div>
    </div>
</div>

@if (count($notPresentData) === 0)
<small class="text-danger fw-bold">Tidak ada data yang bisa ditampilkan</small>
@endif

<div>
    @foreach ($notPresentData as $data)
    @php
        $notPresenceDate = \Carbon\Carbon::parse($data['not_presence_date']);
        $sessionDate = \Carbon\Carbon::parse($attendance->date);
    @endphp

        <div class="p-3 rounded bg-white border border-gray-400 mb-4">
            <div>Hari : <span class="font-bold">{{ \Carbon\Carbon::parse($attendance->date)->isoFormat('dddd') }}</span></div>
            <div>Tanggal : <span class="font-bold">{{ \Carbon\Carbon::parse($attendance->date)->isoFormat('D MMMM Y') }}</span></div>
            <div>Jumlah : <span class="font-bold">{{ count($data['users']) }}</span></div>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NIM
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Posisi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Handle
                        </th>
                    </tr>
                </thead>
                @if ($notPresenceDate->isSameDay($sessionDate))
                <tbody>
                @foreach ($data['users'] as $user)    
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user['name'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user['nim'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user['position']['name'] }}
                        </td>
                        <td class="px-6 py-4 flex">
                            <form action="{{ route('presences.present', $attendance->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                                <input type="hidden" name="presence_date" value="{{ $data['not_presence_date'] }}">
                                <button class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded hover:underline" type="submit">Hadir</button>
                            </form>

                            {{-- Permission Modal Button --}}
                            <button data-modal-target="permissionFormModal{{ $user['id'] }}" data-modal-toggle="permissionFormModal{{ $user['id'] }}"  class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded hover:underline" type="button" >Izin</button>
                            <!-- Main modal -->
                            <div id="permissionFormModal{{ $user['id'] }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                                            <h3 class="text-xl font-semibold text-gray-900">
                                                Formulir Alasan Izin
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="permissionFormModal{{ $user['id'] }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form action="{{ route('presences.acceptPermissionByAdmin', $attendance->id) }}" method="POST" >
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                                            <input type="hidden" name="presence_date" value="{{ $data['not_presence_date'] }}">
                                            <div class="p-6 space-y-6">
                                                <div>
                                                    <label for="permission_reason" class="block mb-2 text-sm font-medium text-gray-900">Alasan Izin Atas Nama {{ $user['name'] }}</label>
                                                    <input type="text" name="permission_reason" id="permission_reason" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Alasan Izin" required>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                                                <button data-modal-hide="permissionFormModal{{ $user['id'] }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @endif
            </table>
        </div>
@endforeach
</div>

@endsection