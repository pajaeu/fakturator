@section('title', __('Settings'))

<x-app-layout>
    <x-card class="mb-5 md:p-10">
        <div class="flex flex-col md:flex-row md:items-center">
            <div class="flex items-center gap-5 lg:gap-10">
                <img src="{{ auth()->user()->avatarUrl() }}" alt="Avatar" class="size-20 lg:size-24 rounded-full">
                <div>
                    <div class="text-2xl font-medium">{{ auth()->user()->billing_company }}</div>
                    <div class="mb-4 text-gray-500">{{ auth()->user()->email }}</div>
                    <div class="flex items-center gap-3">
                        @foreach(config('app.available_locales') as $locale)
                            <a href="{{ route('locale.switch', ['locale' => $locale]) }}" wire:navigate class="size-7 rounded-full overflow-hidden @if(app()->getLocale() !== $locale) opacity-30 hover:opacity-80 @endif transition-all">
                                <img src="{{ asset("assets/images/locales/{$locale}.png") }}" alt="{{ $locale }}" class="size-full">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 md:ms-auto flex flex-col md:flex-row items-start md:items-center gap-3">
                <x-button href="{{ route('settings.user.details') }}" :link="true" variant="outline-gray">
                    <x-icons.pencil class="size-6 text-blue-600"/>
                    <span>{{ __('Edit account') }}</span>
                </x-button>
                <x-button href="{{ route('settings.user.password') }}" :link="true" variant="outline-gray">
                    <x-icons.lock class="size-6 text-blue-600"/>
                    <span>{{ __('Change login credentials') }}</span>
                </x-button>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <x-button type="submit" variant="outline-gray">
                        <x-icons.logout class="size-6 text-blue-600"/>
                        <span>{{ __('Log Out') }}</span>
                    </x-button>
                </form>
            </div>
        </div>
    </x-card>
    <x-card class="mb-5 md:p-10">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold mb-1">{{ __('Your current tier') }}</h2>
                <div class="text-3xl font-semibold text-blue-600">{{ auth()->user()->tier->label() }}</div>
            </div>
            <div class="text-end">
                @if(auth()->user()->tier === \App\Enums\UserTier::PRO)
                @else
                    <x-button class="inline-flex opacity-50">{{ __('Upgrade to Pro') }}</x-button>
                    <p class="mt-2 text-gray-500 text-sm">{{ __('Upgrading to the Pro version is currently not possible.') }}</p>
                @endif
            </div>
        </div>
    </x-card>
    <x-card class="mb-5 md:p-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8">
            <a href="{{ route('settings.billing') }}" wire:navigate class="flex justify-center items-center py-5 md:py-10 px-5 gap-5 rounded text-gray-600 bg-gray-50 hover:text-gray-800 hover:bg-gray-100 transition-colors">
                <x-icons.user-rounded class="size-10 text-blue-600"/>
                <div class="text-2xl">{{ __('Billing settings') }}</div>
            </a>
            <a href="{{ route('settings.accounts') }}" wire:navigate class="flex justify-center items-center py-5 md:py-10 px-5 gap-5 rounded text-gray-600 bg-gray-50 hover:text-gray-800 hover:bg-gray-100 transition-colors">
                <x-icons.bank class="size-10 text-blue-600"/>
                <div class="text-2xl">{{ __('Bank accounts') }}</div>
            </a>
            <div class="opacity-50 flex justify-center items-center py-5 md:py-10 px-5 gap-5 rounded text-gray-600 bg-gray-50 hover:text-gray-800 hover:bg-gray-100 transition-colors">
                <x-icons.circle-percentage class="size-10 text-blue-600"/>
                <div class="text-2xl">{{ __('VAT rates') }}</div>
            </div>
            <div class="opacity-50 flex justify-center items-center py-5 md:py-10 px-5 gap-5 rounded text-gray-600 bg-gray-50 hover:text-gray-800 hover:bg-gray-100 transition-colors">
                <x-icons.api class="size-10 text-blue-600"/>
                <div class="text-2xl">{{ __('API') }}</div>
            </div>
        </div>
    </x-card>
</x-app-layout>