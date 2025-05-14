@props(['name'])

@error($name)
    <div class="py-1 text-sm text-red-500">{{ $message }}</div>
@enderror