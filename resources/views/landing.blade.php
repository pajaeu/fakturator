@extends('layouts.base')

@section('title', __('Simple online invoicing system'))

@section('body')
    <header class="h-24">
        <x-container class="flex h-full items-center">
            <a href="{{ route('landing') }}" wire:navigate class="block">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-auto h-7">
            </a>
            <div class="ms-auto hidden md:flex items-center gap-3">
                @foreach(config('app.available_locales') as $locale)
                    <a href="{{ route('locale.switch', ['locale' => $locale]) }}" class="size-6 rounded-full overflow-hidden @if(app()->getLocale() !== $locale) opacity-30 hover:opacity-80 @endif transition-all">
                        <img src="{{ asset("assets/images/locales/{$locale}.png") }}" alt="{{ $locale }}" class="size-full">
                    </a>
                @endforeach
            </div>
            <div class="ms-auto md:ms-6 flex items-center gap-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="cursor-pointer group flex py-1 md:py-2 px-2 md:px-4 rounded-full md:border border-gray-100 items-center gap-3 hover:border-gray-200 transition-colors">
                        <div class="hidden md:block size-8 rounded-full transition-colors overflow-hidden">
                            <img src="{{ auth()->user()->avatarUrl() }}" alt="Avatar" class="size-full">
                        </div>
                        <div>
                            <div class="text-sm font-medium group-hover:underline">{{ __('Go to account') }}</div>
                            <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                        </div>
                    </a>
                @else
                    <x-button href="{{ route('login') }}" :link="true" variant="outline" class="hidden md:flex">
                        <span>{{ __('Log In') }}</span>
                    </x-button>
                    <x-button href="{{ route('register') }}" :link="true">
                        <span>{{ __('Get started') }}</span>
                    </x-button>
                @endauth
            </div>
        </x-container>
    </header>
    <main>
        <div class="px-6 lg:px-8 py-16 md:py-32">
            <div class="mx-auto max-w-2xl mb-6 md:mb-12">
                <div class="text-center">
                    <h1 class="text-5xl font-semibold tracking-tight text-gray-800 sm:text-6xl">{{ __('Simple invoice management for self-employed and small businesses') }}</h1>
                    <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">{{ __('Fakturátor is a clear and reliable web application that helps you easily create, manage and track invoices. Without unnecessary complexity, just the way you need it.') }}</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <x-button class="py-3 px-6" href="{{ route('register') }}" :link="true">
                            <span>{{ __('Get started') }}</span>
                        </x-button>
                        <a href="#functions" class="text-sm/6 font-semibold text-gray-800">{{ __('Learn more') }} <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
            <div class="mx-auto max-w-3xl md:max-w-4xl lg:max-w-5xl">
                <div class="h-[240px] sm:h-[360px] md:h-[470px] lg:h-[520px] xl:h-[640px] rounded-lg border border-gray-200 shadow-lg overflow-hidden">
                    <img src="{{ asset('assets/images/screenshot.png') }}" alt="Screenshot">
                </div>
            </div>
        </div>
        <section id="functions" class="py-6 md:py-12">
            <x-container>
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="w-full md:w-1/2">
                        <div class="sticky top-10">
                            <h2 class="text-3xl md:text-4xl font-semibold mb-1">{{ __('Main functions') }}<br/>{{ __('of Fakturátor') }}</h2>
                            <div class="w-48 h-1 bg-blue-600"></div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <div class="pb-6 mb-6 md:pb-10 md:mb-12 border-b border-gray-200">
                            <h3 class="text-xl md:text-2xl mb-2 font-medium">{{ __('Invoice creation in a few clicks') }}</h3>
                            <div class="text-gray-500">{{ __('An intuitive form that allows you to issue a professional invoice in less than a minute.') }}</div>
                        </div>
                        <div class="pb-6 mb-6 md:pb-10 md:mb-12 border-b border-gray-200">
                            <h3 class="text-xl md:text-2xl mb-2 font-medium">{{ __('Export to PDF') }}</h3>
                            <div class="text-gray-500">{{ __('Each invoice can be easily downloaded as a PDF and emailed to the client.') }}</div>
                        </div>
                        <div class="pb-6 mb-6 md:pb-10 md:mb-12 border-b border-gray-200">
                            <h3 class="text-xl md:text-2xl mb-2 font-medium">{{ __('Payment tracking') }}</h3>
                            <div class="text-gray-500">{{ __('Keep track of who paid you - and who needs to be reminded.') }}</div>
                        </div>
                        <div class="pb-6 mb-6 md:pb-10 md:mb-12 border-b border-gray-200">
                            <h3 class="text-xl md:text-2xl mb-2 font-medium">{{ __('Directory of contacts') }}</h3>
                            <div class="text-gray-500">{{ __("Save your customers so you don't have to copy their details again unnecessarily.") }}</div>
                        </div>
                        <div class="pb-6 md:pb-10 border-b border-gray-200">
                            <h3 class="text-xl md:text-2xl mb-2 font-medium">{{ __('Invoice history and management') }}</h3>
                            <div class="text-gray-500">{{ __('All your invoices are in one place, always available when you need them.') }}</div>
                        </div>
                    </div>
                </div>
            </x-container>
        </section>
        <section class="py-12 md:py-16">
            <x-container>
                <div class="relative isolate rounded-xl p-6 md:p-12 text-center bg-blue-50 overflow-hidden">
                    <h2 class="text-2xl md:text-3xl font-semibold mb-4">{{ __('Start invoicing smart') }}</h2>
                    <div class="text-lg">{{ __('Sign up in minutes and issue your first invoice today. No installation required, no obligation.') }}</div>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <x-button class="py-3 px-6" href="{{ route('register') }}" :link="true">
                            <span>{{ __('Get started') }}</span>
                        </x-button>
                    </div>
                    <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
                        <div class="relative left-[calc(50%+3rem)] aspect-1155/678 w-144.5 -translate-x-1/2 bg-linear-to-tr from-[#08369b] to-[#155dfc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-288.75" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                    </div>
                </div>
            </x-container>
        </section>
        <section id="faq" class="py-6 md:py-12">
            <x-container>
                <div class="text-sm text-center font-medium text-blue-600 mb-1">{{ __('What do people ask?') }}</div>
                <h2 class="text-3xl md:text-4xl font-semibold text-center mb-6">{{ __('Frequently Asked Questions') }}</h2>
                <div class="mx-auto max-w-4xl">
                    <div class="pb-4 mb-6 border-b border-gray-200" x-data="{ show: false }">
                        <button @click="show = !show" class="cursor-pointer w-full flex items-center justify-between mb-2">
                            <h3 class="text-xl font-medium">{{ __('Is Fakturátor free?') }}</h3>
                            <x-icons.plus class="size-5" x-show="!show" x-cloak/>
                            <x-icons.minus class="size-5" x-show="show" x-cloak/>
                        </button>
                        <p class="md:text-lg mb-2" x-show="show" x-cloak>{{ __('The basic version is completely free. We are also preparing advanced features in the paid plan.') }}</p>
                    </div>
                    <div class="pb-4 mb-6 border-b border-gray-200" x-data="{ show: false }">
                        <button @click="show = !show" class="cursor-pointer w-full flex items-center justify-between mb-2">
                            <h3 class="text-xl font-medium">{{ __('Is installation necessary?') }}</h3>
                            <x-icons.plus class="size-5" x-show="!show" x-cloak/>
                            <x-icons.minus class="size-5" x-show="show" x-cloak/>
                        </button>
                        <p class="md:text-lg mb-2" x-show="show" x-cloak>{{ __('No. Invoicing is fully online - just use a web browser.') }}</p>
                    </div>
                    <div class="pb-4 mb-6 border-b border-gray-200" x-data="{ show: false }">
                        <button @click="show = !show" class="cursor-pointer w-full flex items-center justify-between mb-2">
                            <h3 class="text-xl font-medium">{{ __('Is the app safe?') }}</h3>
                            <x-icons.plus class="size-5" x-show="!show" x-cloak/>
                            <x-icons.minus class="size-5" x-show="show" x-cloak/>
                        </button>
                        <p class="md:text-lg mb-2" x-show="show" x-cloak>{{ __('Yes. Your account and data are protected by state-of-the-art security.') }}</p>
                    </div>
                </div>
            </x-container>
        </section>
    </main>
    <footer class="pt-6 pb-12 border-t border-gray-100">
        <x-container>
            <div class="flex justify-center items-center gap-3">
                @foreach(config('app.available_locales') as $locale)
                    <a href="{{ route('locale.switch', ['locale' => $locale]) }}" class="size-6 rounded-full overflow-hidden @if(app()->getLocale() !== $locale) opacity-30 hover:opacity-80 @endif transition-all">
                        <img src="{{ asset("assets/images/locales/{$locale}.png") }}" alt="{{ $locale }}" class="size-full">
                    </a>
                @endforeach
            </div>
        </x-container>
    </footer>
@endsection