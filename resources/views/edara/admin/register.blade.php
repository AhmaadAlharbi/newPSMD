<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <h1 class="text-center">Edara Section</h1>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{route('edara.register')}}">
            @csrf

            <!-- Name -->
            <div>
                <p style="background:#62BEC1;color:white;" class=" my-5 p-3">Please register with MEW email and The
                    password must
                    be
                    at
                    least 8
                    characters. </p>
                <label for="">First Name</label>
                <x-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')" required />
                <label for="">Second Name</label>
                <x-input class="block mt-4 w-full" type="text" name="sname" required autofocus :value="old('sname')" />
                <label for="">Third Name</label>
                <x-input class=" block mt-4 w-full" type="text" name="tname" required autofocus :value="old('tname')" />
                <label for="">Last Name</label>
                <x-input class="block mt-4 w-full" type="text" name="lname" required autofocus :value="old('lname')" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>