<x-auth-layout>
    <h1 class="mb-10 text-3xl font-semibold text-center">{{ __('New account') }}</h1>
    <form action="{{ route('register') }}" method="post">
        <div class="mb-4">
            <x-form.input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }} *" @class(['border-red-500' => $errors->has('email')])/>
            <x-form.input-error name="email"/>
        </div>
        <div class="mb-4">
            <x-form.input type="text" name="company_id" value="{{ old('company_id') }}" placeholder="{{ __('Company ID') }}" @class(['border-red-500' => $errors->has('company_id')])/>
            <x-form.input-error name="company_id"/>
        </div>
        <div class="mb-5">
            <x-form.input type="password" name="password" placeholder="{{ __('Password') }} *" @class(['border-red-500' => $errors->has('password')])/>
            <x-form.input-error name="password"/>
        </div>
        <div class="mb-5">
            <x-form.input type="password" name="password_confirmation" placeholder="{{ __('Confirm password') }} *" @class(['border-red-500' => $errors->has('password_confirmation')])/>
            <x-form.input-error name="password_confirmation"/>
        </div>
        <div>
            @csrf
            <button type="submit" class="cursor-pointer w-full py-3 px-4 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Register') }}</button>
        </div>
        <a href="{{ route('login') }}" class="block mt-3 text-center text-sm text-gray-500 underline hover:text-gray-600 transition-colors">{{ __('Have an account? Log In here.') }}</a>
    </form>
</x-auth-layout>