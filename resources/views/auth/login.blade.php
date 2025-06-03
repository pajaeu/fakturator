@section('title', __('Log In'))

<x-auth-layout>
    <h1 class="mb-10 text-3xl font-semibold text-center">{{ __('Welcome back') }}</h1>
    <form action="{{ route('login') }}" method="post">
        <div class="mb-4">
            <x-form.input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" @class(['py-4', 'border-red-500' => $errors->has('email')])/>
            <x-form.input-error name="email"/>
        </div>
        <div class="relative mb-5" x-data="{ showPassword: false }">
            <x-form.input x-bind:type="showPassword ? 'text' : 'password'" name="password" placeholder="{{ __('Password') }}" @class(['py-4 pe-10', 'border-red-500' => $errors->has('password')]) autocomplete="off"/>
            <x-form.input-error name="password"/>
            <button type="button" @click="showPassword = !showPassword" class="cursor-pointer text-gray-400 hover:text-gray-700 absolute top-4.5 right-3 transition-colors">
                <x-icons.eye class="size-6" x-show="!showPassword" x-cloak/>
                <x-icons.eye-dashed class="size-6" x-show="showPassword" x-cloak/>
            </button>
        </div>
        <div>
            @csrf
            <button type="submit" class="cursor-pointer w-full py-3 px-4 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Log In') }}</button>
        </div>
        <a href="{{ route('register') }}" class="block mt-3 text-center text-sm text-gray-500 underline hover:text-gray-600 transition-colors">{{ __('No account yet? Register here.') }}</a>
        <div class="mt-6 flex justify-center items-center gap-2">
            @foreach(config('app.available_locales') as $locale)
                <a href="{{ route('locale.switch', ['locale' => $locale]) }}" wire:navigate class="size-6 rounded-full overflow-hidden @if(app()->getLocale() !== $locale) opacity-30 hover:opacity-80 @endif transition-all">
                    <img src="{{ asset("assets/images/locales/{$locale}.png") }}" alt="{{ $locale }}" class="size-full">
                </a>
            @endforeach
        </div>
    </form>
</x-auth-layout>