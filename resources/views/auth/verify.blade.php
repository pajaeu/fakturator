@section('title', __('Almost ready'))

<x-auth-layout>
    <h1 class="mb-4 text-3xl font-semibold text-center">{{ __('Almost ready') }}</h1>
    <div class="mb-6 text-sm text-center">
        <p>{{ __('You are almost there! We sent an email to') }}</p>
        <p class="my-2 font-bold">{{ auth()->user()->email }}</p>
        <p>{{ __('Just click on the link in that email to complete your signup.') }}</p>
    </div>
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-center text-sm text-green-600">{{ __('A new email verification link has been emailed to you!') }}</div>
    @endif
    <form action="{{ route('verification.send') }}" method="post">
        <div>
            @csrf
            <button type="submit" class="cursor-pointer w-full py-3 px-4 rounded-full text-white font-medium bg-blue-700 hover:bg-blue-800 transition-colors">{{ __('Resend email') }}</button>
        </div>
        <div class="mt-6 flex justify-center items-center gap-2">
            @foreach(config('app.available_locales') as $locale)
                <a href="{{ route('locale.switch', ['locale' => $locale]) }}" wire:navigate class="size-6 rounded-full overflow-hidden @if(app()->getLocale() !== $locale) opacity-30 hover:opacity-80 @endif transition-all">
                    <img src="{{ asset("assets/images/locales/{$locale}.png") }}" alt="{{ $locale }}" class="size-full">
                </a>
            @endforeach
        </div>
    </form>
</x-auth-layout>