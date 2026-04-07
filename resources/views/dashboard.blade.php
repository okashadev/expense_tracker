<x-app-layout>
    <div class="p-4 w-full ">
        <div class="grid grid-cols-2 gap-6 mb-10">
            <div
                class="flex flex-col items-start sm:col-span-1 col-span-2 justify-center px-5 py-6 rounded-xl shadow-lg bg-gray-50">
                <p class="text-gray-700">
                    Total Spent (This Month)
                </p>
                <p class="text-3xl font-bold">
                    ${{ number_format($totalSpent, 2) }}
                </p>
            </div>
            <div
                class="flex flex-col items-start sm:col-span-1 col-span-2 justify-center px-5 py-6 rounded-xl shadow-lg bg-gray-50">
                <p class=" text-gray-700">
                    Top Spending Category
                </p>
                <p class="text-3xl capitalize font-bold">
                    {{ $topSpendindCategory }}
                </p>
            </div>

            @include('monthly_limit.monthly_limit')


        </div>
        <div class="grid grid-cols-3 gap-6">
            <div
                class="flex flex-col items-start justify-center px-5 py-6 rounded-xl shadow-lg bg-white h-80 col-span-2">
                <p class="text-2xl text-gray-400">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>
            <div class="flex flex-col items-start px-5 py-6 rounded-xl shadow-lg bg-white col-span-1">
                <h1 class="text-xl font-bold text-black">
                    Recent Transactions
                </h1>
                @foreach ($recentTransaction as $data)
                    <div class="flex justify-between items-center gap-4 w-full my-3">
                        <div class="flex items-center gap-4">
                            <div
                                class="flex justify-center items-center p-2 bg-[#EFE4D2]/50 border border-[#EFE4D2]/80 text-[#954C2E] rounded-full">
                                <span class="material-symbols-outlined">{{ $data->category->icon }}</span>
                            </div>
                            <div>
                                <h1 class="capitalize font-semibold ">{{ $data->title ?? '' }}</h1>
                                <p class="capitalize text-xs text-gray-500">{{ $data->category->name ?? '' }}</p>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-end font-semibold">-${{ $data->amount ?? '0.00' }}</h1>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
