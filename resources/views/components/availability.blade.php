@props(['label', 'status'])

<div class="flex justify-between items-center">
    <span class="font-medium">{{ $label }}:</span>
    <span class="inline-flex items-center px-3 py-1 rounded-md shadow-md text-sm font-medium
                {{ $status ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
        {{ $status ? 'YES' : 'NO' }}
    </span>
</div>