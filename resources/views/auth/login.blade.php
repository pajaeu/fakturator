<x-auth-layout>
    <h1 class="mb-10 text-3xl font-semibold text-center">{{ __('Welcome back') }}</h1>
    <form action="{{ route('login') }}" method="post">
        <div class="mb-4">
            <x-form.input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" @class(['border-red-500' => $errors->has('email')])/>
            <x-form.input-error name="email"/>
        </div>
        <div class="mb-5">
            <x-form.input type="password" name="password" placeholder="{{ __('Password') }}" @class(['border-red-500' => $errors->has('password')])/>
            <x-form.input-error name="password"/>
        </div>
        <div>
            @csrf
            <button type="submit" class="cursor-pointer w-full py-3 px-4 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Log In') }}</button>
        </div>
        <a href="{{ route('register') }}" class="block mt-3 text-center text-sm text-gray-500 underline hover:text-gray-600 transition-colors">{{ __('No account yet? Register here.') }}</a>
    </form>
</x-auth-layout>