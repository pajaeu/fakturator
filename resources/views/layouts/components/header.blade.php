<header class="py-4 border-b border-gray-300 bg-gray-100">
    <x-container class="flex items-center">
        <a href="{{ route('dashboard') }}" class="block">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-auto h-7">
        </a>
        <div class="ms-6 flex items-center gap-1">
            <a href="" class="py-2 px-4 rounded-full text-sm font-medium border border-transparent hover:border-gray-800 transition-colors">{{ __('Invoices') }}</a>
            <a href="{{ route('contacts.index') }}" class="py-2 px-4 rounded-full text-sm font-medium border border-transparent hover:border-gray-800 transition-colors">{{ __('Contacts') }}</a>
            <a href="" class="py-2 px-4 rounded-full text-sm font-medium border border-transparent hover:border-gray-800 transition-colors">{{ __('Settings') }}</a>
        </div>
        <div class="ms-auto flex items-center gap-4">
            <x-button href="" :link="true" variant="outline">
                <x-icons.plus class="size-4"/>
                <span>{{ __('New bill') }}</span>
            </x-button>
            <div class="size-10 rounded-full border border-gray-200 hover:border-blue-600 transition-colors overflow-hidden">
                <img src="{{ auth()->user()->avatarUrl() }}" alt="Avatar" class="size-full">
            </div>
        </div>
    </x-container>
</header>