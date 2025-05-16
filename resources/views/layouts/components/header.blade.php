<header class="py-4 border-b border-gray-300 bg-gray-100">
    <x-container class="flex items-center">
        <a href="{{ route('dashboard') }}" wire:navigate class="block">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-auto h-7">
        </a>
        <div class="ms-6 flex items-center gap-1">
            <a href="{{ route('invoices.index') }}" wire:navigate class="py-2 px-4 rounded-full text-sm font-medium border border-transparent hover:border-gray-800 transition-colors">{{ __('Invoices') }}</a>
            <a href="{{ route('contacts.index') }}" wire:navigate class="py-2 px-4 rounded-full text-sm font-medium border border-transparent hover:border-gray-800 transition-colors">{{ __('Contacts') }}</a>
            <a href="" class="py-2 px-4 rounded-full text-sm font-medium border border-transparent hover:border-gray-800 transition-colors">{{ __('Settings') }}</a>
        </div>
        <div class="ms-auto flex items-center gap-4">
            <x-button href="{{ route('invoices.create') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.plus class="size-4"/>
                <span>{{ __('New bill') }}</span>
            </x-button>
            <div class="relative flex" x-data="{ show: false }">
                <button @click="show = !show" class="cursor-pointer size-10 rounded-full border transition-colors overflow-hidden" :class="show ? 'border-blue-600 shadow' : 'border-gray-200 hover:border-blue-600'">
                    <img src="{{ auth()->user()->avatarUrl() }}" alt="Avatar" class="size-full">
                </button>
                <div class="absolute top-0 right-0 mt-[57px] z-10 p-3 rounded-b-lg w-max min-w-[200px] shadow-md bg-white" x-show="show" x-cloak @click.outside.window="show = false">
                    <a class="cursor-pointer w-full flex gap-4 items-center py-2 px-3 rounded hover:bg-gray-100 transition-colors">
                        <x-icons.settings class="size-5 text-blue-600"/>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="cursor-pointer w-full flex gap-4 items-center py-2 px-3 rounded hover:bg-gray-100 transition-colors">
                            <x-icons.logout class="size-5 text-blue-600"/>
                            <span>{{ __('Log Out') }}</span>
                        </button>
                    </form>
                    <div class="mt-3 flex items-center gap-3 px-3">
                        @foreach(config('app.available_locales') as $locale)
                            <a href="{{ route('locale.switch', ['locale' => $locale]) }}" class="size-7 rounded-full border-2 overflow-hidden @if(app()->getLocale() === $locale) border-blue-600 @else border-transparent hover:border-gray-200 @endif transition-colors">
                                <img src="{{ asset("assets/images/locales/{$locale}.png") }}" alt="{{ $locale }}" class="size-6">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</header>