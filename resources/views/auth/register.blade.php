<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="flex flex-col justify-center items-center my-4">
            <div class="bg-[#254D70] rounded-full p-2">
                <svg class="text-white size-9" fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M44 4H30.6666V17.3334H17.3334V30.6666H4V44H44V4Z" fill="currentColor"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl text-[#131D4F] font-bold mt-2">Expense Tracker</h1>
            </div>
            <div>
                <h2 class="text-md text-gray-600 mt-1">Start tracking your expenses today.</h2>
            </div>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" x-bind:type="show ? 'text' : 'password'" class="block mt-1 w-full pr-10"
                    name="password" required autocomplete="new-password" />

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-[#954C2E] focus:outline-none">
                    <span class="material-symbols-outlined text-lg"
                        x-text="show ? 'visibility_off' : 'visibility'"></span>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4" x-data="{ showConfirm: false }">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative">
                <x-text-input id="password_confirmation" x-bind:type="showConfirm ? 'text' : 'password'"
                    class="block mt-1 w-full pr-10" name="password_confirmation" required autocomplete="new-password" />

                <button type="button" @click="showConfirm = !showConfirm"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-[#954C2E] focus:outline-none">
                    <span class="material-symbols-outlined text-lg"
                        x-text="showConfirm ? 'visibility_off' : 'visibility'"></span>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> --}}

            <x-primary-button class="text-center py-3 w-full">
                {{ __('Sign Up') }}
            </x-primary-button>
        </div>
        <hr class="my-8 w-full border border-gray-200">
        <div class="flex justify-center items-center">
            <a href="{{ route('login') }}"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Already have an account? ') }} <span
                    class="text-[#954C2E] font-medium">{{ __('Login') }}</span>
            </a>
        </div>
    </form>
</x-guest-layout>
