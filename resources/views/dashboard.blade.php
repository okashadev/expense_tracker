<x-app-layout>
    <div class="p-4 w-full ">
        <div class="grid grid-cols-2 gap-6 mb-10">
            <div
                class="flex flex-col items-start sm:col-span-1 col-span-2 justify-center px-5 py-6 rounded-xl shadow-lg bg-gray-50">
                <p class="text-gray-700">
                    Total Spent (This Month)
                </p>
                <p class="text-3xl font-bold">
                    {{ currency_symbol() }} {{ number_format($totalSpent, 2) }}
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
        <div class="grid grid-cols-2 gap-6">
            <div class=" bg-white rounded-2xl shadow-md p-6">

                <!-- Header -->
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">
                            Monthly Expense Overview
                        </h2>
                        <p class="text-sm text-gray-500">
                            Visual representation of your spending.
                        </p>
                    </div>

                    {{-- <a href="#" class="text-sm font-medium text-[#954C2E]">
                        View Full Report
                    </a> --}}
                </div>

                <!-- Chart -->
                <div class="w-full">
                    <canvas id="expenseChart" class="w-full"></canvas>
                </div>

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
                            <h1 class="text-end font-semibold">-{{ currency_symbol() }} {{ $data->amount ?? '0.00' }}</h1>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            fetch("{{ route('ajax.chart.monthly_expenses') }}")
                .then(res => res.json())
                .then(data => {

                    const labels = data.map(item => item.month);
                    const amounts = data.map(item => item.total);
                    const colors = data.map(item =>
                        item.is_current ? '#8B4A2F' : '#E8DED9'
                    );

                    const ctx = document.getElementById('expenseChart');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: amounts,
                                backgroundColor: colors,
                                borderRadius: 8,
                                barThickness: 36,
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    border: {
                                        display: false
                                    }
                                },
                                y: {
                                    display: false,
                                    grid: {
                                        display: false
                                    },
                                    border: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                });
        });
    </script>

</x-app-layout>
