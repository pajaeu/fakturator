@section('title', __('Settings'))

<x-app-layout>
    <x-card class="mb-5 p-10">
        <div class="flex items-center">
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
            <div class="ms-auto flex items-center gap-3">
                <x-button href="{{ route('settings.user.details') }}" :link="true" variant="outline-gray">
                    <x-icons.pencil class="size-6 text-blue-600"/>
                    <span>{{ __('Edit account') }}</span>
                </x-button>
                <x-button variant="outline-gray">
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
    <x-card class="md:p-10">
        <div class="grid grid-cols-3 gap-5 md:gap-10">
            <a href="{{ route('settings.billing') }}" wire:navigate class="flex justify-center items-center p-5 gap-5 rounded text-gray-600 bg-gray-50 hover:text-gray-800 hover:bg-gray-100 transition-colors">
                <x-icons.user-rounded class="size-10 text-blue-600"/>
                <div class="text-2xl">{{ __('Billing settings') }}</div>
            </a>
            <a href="{{ route('settings.accounts') }}" wire:navigate class="flex justify-center items-center p-5 gap-5 rounded text-gray-600 bg-gray-50 hover:text-gray-800 hover:bg-gray-100 transition-colors">
                <x-icons.bank class="size-10 text-blue-600"/>
                <div class="text-2xl">{{ __('Bank accounts') }}</div>
            </a>
            <div class="opacity-50 flex justify-center items-center p-5 gap-5 rounded text-gray-600 bg-gray-50 hover:text-gray-800 hover:bg-gray-100 transition-colors">
                <x-icons.circle-percentage class="size-10 text-blue-600"/>
                <div class="text-2xl">{{ __('VAT rates') }}</div>
            </div>
        </div>
    </x-card>
</x-app-layout>