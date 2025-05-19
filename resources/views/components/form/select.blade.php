<select {{ $attributes->merge(['class' => 'w-full py-2 px-4 rounded-lg border border-gray-300 placeholder:text-gray-500 outline-none focus:border-blue-500 focus:ring-3 focus:ring-blue-500/30 transition-all']) }}>
    {{ $slot }}
</select>