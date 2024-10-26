@props(['messages'])

@if ($messages)
    @error('message')
        <span class="text-red-500 text-xs mt-4 block ">{{ $message }}</span>
    @enderror
@endif
