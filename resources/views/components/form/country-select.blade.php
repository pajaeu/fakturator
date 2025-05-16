@props([
	'property' => 'country'
])

<select wire:model.blue="{{ $property }}" {{ $attributes->merge(['class' => 'w-full py-2 px-4 rounded-lg border border-gray-300 placeholder:text-gray-500 outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-500/30 transition-all']) }}>
    <option>{{ __('Select country') }}</option>
    @foreach(\App\Enums\Country::cases() as $country)
        <option value="{{ $country->value }}">{{ $country->label() }}</option>
    @endforeach
</select>