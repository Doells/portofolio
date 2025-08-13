@props(['required' => true, 'label', 'id'])

<label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900">{{ $label }} @if($required) <sup class="text-red-500">* (Wajib Diisi)</sup>
    @endif</label>