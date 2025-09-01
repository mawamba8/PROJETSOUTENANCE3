<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{--<a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>--}}
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="row align-items-center">
                <div class="col">
                    <x-label for="name" :value="__('Name')" />
                </div>

                <div class="col-9">
                    <x-input id="name" class="block mt-1 w-100 py-1 rounded" type="text" name="name" :value="old('name')" required autofocus />
                </div>
            </div>

            <!-- Email Address -->
            <div class="mt-4 row align-items-center">
                <div class="col">
                    <x-label for="email" :value="__('Email')" />
                </div>

                <div class="col-9">
                    <x-input id="email" class="block mt-1 w-100 py-1 rounded" type="email"
                             name="email" :value="old('email')" required />
                </div>
            </div>

            <!-- Password -->
            <div class="mt-4 row align-items-center">
                <div class="col">
                    <x-label for="password" :value="__('Password')" />
                </div>

                <div class="col-9">
                    <x-input id="password" class="block mt-1 w-100 py-1 rounded"
                             type="password"
                             name="password"
                             required autocomplete="new-password" />
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 row align-items-center">
                <div class="col">
                    <x-label  for="password_confirmation" :value="__('Confirm Password')" />
                </div>
                <div class="col-9">
                    <x-input id="password_confirmation" class="block mt-1 w-100 py-1 rounded"
                             type="password"
                             name="password_confirmation" required />
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end mt-4">
                <x-button class="ml-3 bg-secondary border-0 rounded">
                    {{ __('Register') }}
                </x-button>
            </div>


            <div class="d-flex align-items-center justify-content-center mt-4">
                {{ __('Vous avez déjà un compte ? ') }}
                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                   href="{{ route('login') }}">
                    {{ __(' ') }} se connecter
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
