<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Currency') }}
        </h2>

        {{-- <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p> --}}
    </header>

    <form method="POST" action="{{ route('update.currency') }}" class="mt-6 space-y-6">
        @csrf
        @method('POST')

        <div>
            <x-input-label for="currency" :value="__('Select Currency')" />

            <select name="currency" id="currency"
                class="p-2 w-full border-gray-300 bg-[#EFE4D2] focus:border-[#954C2E] focus:ring-[#954C2E] rounded-md shadow-sm">
                <option value="USD" {{ auth()->user()->currency == 'USD' ? 'selected' : '' }}>
                    USD ($)
                </option>

                <option value="PKR" {{ auth()->user()->currency == 'PKR' ? 'selected' : '' }}>
                    PKR (₨)
                </option>

                <option value="EUR" {{ auth()->user()->currency == 'EUR' ? 'selected' : '' }}>
                    EUR (€)
                </option>

                <option value="GBP" {{ auth()->user()->currency == 'GBP' ? 'selected' : '' }}>
                    GBP (£)
                </option>
            </select>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'Currency-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Currency Updated.') }}</p>
            @endif
        </div>
    </form>
</section>
