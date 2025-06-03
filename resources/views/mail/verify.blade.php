<x-mail-layout>
    <p style="color: #1E2939;">{{ __('Hello,') }}</p>

    <p style="color: #1E2939;">{{ __('to make the most of your new account, you need to take the final step - activate it.') }}</p>

    <p style="margin: 25px 0; text-align: center">
        <a href="{{ $url }}" style="display: inline-block; padding: 10px 20px; font-size: 16px; border-radius: 25px; color: white; background-color: #155DFC; text-decoration: none;">{{ __('Activate account') }}</a>
    </p>

    <p style="color: #1E2939;">{{ __('Thank you for your registration, your Fakturátor team.') }}</p>
</x-mail-layout>