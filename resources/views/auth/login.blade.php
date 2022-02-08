<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
        </x-slot>

        <h1 style="display:flex; justify-content:center;">Panpacific University Helpdesk</h1>
        <h1 style="display:flex; justify-content:center;">Login</h1>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-left mt-4 mb-1">
                <x-button class="ml-5">
                    {{ __('Login') }}
                </x-button>
            </div>

            <div class="flex items-center justify-left mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div class="flex items-center justify-left mt-4">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="underline text-sm text-gray-600 hover:text-gray-900">Register</a>
                @endif
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
