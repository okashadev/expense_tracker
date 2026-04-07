<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
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
                <h2 class="text-md text-gray-600 mt-1">Log in to track your expense</h2>
            </div>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" x-bind:type="show ? 'text' : 'password'" class="block mt-1 w-full pr-10"
                    name="password" required autocomplete="current-password" />

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-[#954C2E] focus:outline-none">
                    <span class="material-symbols-outlined text-lg"
                        x-text="show ? 'visibility_off' : 'visibility'"></span>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex justify-between items-center mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-center  mt-4">


            <x-primary-button class="w-full">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <hr class="my-8 w-full border border-gray-200">
        <div class="flex justify-center items-center">
            <a href="{{ route('register') }}"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __("Don't have an account? ") }} <span class="text-[#954C2E] font-medium">{{ __('Register') }}</span>
            </a>
        </div>
    </form>
</x-guest-layout>
