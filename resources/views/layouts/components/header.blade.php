<header class="py-4 border-b border-gray-300 bg-gray-100">
    <x-container class="flex items-center">
        <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-auto h-7">
            @if(auth()->user()->tier === \App\Enums\UserTier::PRO)
                <span class="hidden md:inline-block -mt-2 py-1 px-2 rounded-full text-xs font-medium text-white bg-amber-500">PRO</span>
            @endif
        </a>
        <div class="ms-6 hidden md:flex items-center gap-1">
            <a href="{{ route('invoices.index') }}" wire:navigate class="py-2 px-4 rounded-full text-sm font-medium border @if(request()->routeIs('invoices.*')) border-blue-600 @else border-transparent hover:border-gray-800 @endif transition-colors">{{ __('Invoices') }}</a>
            <a href="{{ route('contacts.index') }}" wire:navigate class="py-2 px-4 rounded-full text-sm font-medium border @if(request()->routeIs('contacts.*')) border-blue-600 @else border-transparent hover:border-gray-800 @endif transition-colors">{{ __('Contacts') }}</a>
            <a href="{{ route('settings.index') }}" wire:navigate class="py-2 px-4 rounded-full text-sm font-medium border @if(request()->routeIs('settings.*')) border-blue-600 @else border-transparent hover:border-gray-800 @endif transition-colors">{{ __('Settings') }}</a>
        </div>
        <div class="ms-auto flex items-center gap-2 md:gap-4">
            <x-button href="{{ route('invoices.create') }}" :link="true" variant="outline" wire:navigate>
                <x-icons.plus class="size-4"/>
                <span>{{ __('New bill') }}</span>
            </x-button>
            <div class="relative flex" x-data="{ show: false }">
                <button @click="show = !show" class="cursor-pointer size-8 md:size-10 rounded-full border transition-colors overflow-hidden" :class="show ? 'border-blue-600 shadow' : 'border-gray-200 hover:border-blue-600'">
                    <img src="{{ auth()->user()->avatarUrl() }}" alt="Avatar" class="size-full">
                </button>
                <div class="absolute top-0 right-0 mt-[52px] md:mt-[57px] z-10 p-3 rounded-b-lg w-max min-w-[200px] shadow-md bg-white" x-show="show" x-cloak @click.outside.window="show = false">
                    <a href="{{ route('settings.index') }}" wire:navigate class="cursor-pointer w-full flex gap-4 items-center py-2 px-3 rounded hover:bg-gray-100 transition-colors">
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
                            <a href="{{ route('locale.switch', ['locale' => $locale]) }}" wire:navigate class="size-6 rounded-full overflow-hidden @if(app()->getLocale() !== $locale) opacity-30 hover:opacity-80 @endif transition-all">
                                <img src="{{ asset("assets/images/locales/{$locale}.png") }}" alt="{{ $locale }}" class="size-full">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</header>