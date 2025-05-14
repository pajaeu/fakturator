<header class="py-4 border-b border-gray-300 bg-gray-100">
    <x-container class="flex items-center">
        <a href="{{ route('dashboard') }}" class="block">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-auto h-7">
        </a>
        <div class="ms-6 flex items-center gap-1">
            <a href="" class="py-2 px-4 rounded-full text-sm font-medium border border-transparent hover:border-gray-800 transition-colors">{{ __('Invoices') }}</a>
            <a href="" class="py-2 px-4 rounded-full text-sm font-medium border border-transparent hover:border-gray-800 transition-colors">{{ __('Contacts') }}</a>
            <a href="" class="py-2 px-4 rounded-full text-sm font-medium border border-transparent hover:border-gray-800 transition-colors">{{ __('Settings') }}</a>
        </div>
        <div class="ms-auto flex items-center gap-4">
            <a href="" class="flex items-center gap-2 py-2 px-4 rounded-full text-sm text-blue-600 font-medium border border-blue-600 hover:text-white hover:bg-blue-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="size-4">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 5l0 14"/>
                    <path d="M5 12l14 0"/>
                </svg>
                <span>{{ __('New bill') }}</span>
            </a>
            <div class="size-10 rounded-full border border-gray-200 hover:border-blue-600 transition-colors overflow-hidden">
                <img src="{{ auth()->user()->avatarUrl() }}" alt="Avatar" class="size-full">
            </div>
        </div>
    </x-container>
</header>