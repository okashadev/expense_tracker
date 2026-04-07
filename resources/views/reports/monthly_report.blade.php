<x-app-layout>

    <style>
        #default-sidebar {
            display: none;
        }

        #main {
            margin-top: 0px;
        }

        #nav-main {
            margin-left: 0px;
        }

        #header {
            display: none;
        }
    </style>

    <div>
        <div class="min-h-screen w-full bg-[#EFE4D2] py-10 px-4 flex justify-center">
            <div class="w-full max-w-5xl bg-white rounded-2xl shadow p-8">

                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-[#131D4F]">
                            Monthly Expense Report – {{ $formattedMonth }} {{ $year }}
                        </h1>
                        <p class="text-gray-600 mt-1">
                            A summary of your expenses for this month.
                        </p>
                    </div>
                    <a href="{{ route('reports.download_pdf', ['month' => $selectedMonth]) }}"
                        class="bg-[#954C2E] text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">
                        Download PDF
                    </a>

                </div>

                <hr class="my-6 border-gray-300">

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">

                    <div>
                        <p class="text-gray-600">Total Spent</p>
                        <h2 class="text-3xl font-bold text-[#131D4F]">{{ number_format($totalSpent) ?? 0 }}</h2>
                    </div>

                    <div>
                        <p class="text-gray-600">Total Transactions</p>
                        <h2 class="text-3xl font-bold text-[#131D4F]">{{ $totalTransactions ?? 0 }}</h2>
                    </div>

                    <div>
                        <p class="text-gray-600">Top Spending Category</p>
                        <h2 class="text-2xl font-bold capitalize text-[#131D4F]">{{ $topSpendindCategory->name }}</h2>
                    </div>

                </div>

                <h3 class="text-xl font-bold text-[#131D4F] mt-10 mb-4">Category Breakdown</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border rounded-xl overflow-hidden">
                        <thead class="bg-[#131D4F] text-white">
                            <tr>
                                <th class="py-3 px-4">Category</th>
                                <th class="py-3 px-4">Amount</th>
                                <th class="py-3 px-4">% of Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoryBreakdown as $data)
                                <tr class="border-b">
                                    <td class="py-3 px-4 text-center capitalize">{{ $data['category_name']['name'] }}
                                    </td>
                                    <td class="py-3 px-4 text-center">{{ $data['amount'] }}</td>
                                    <td class="py-3 px-4 text-center">{{ $data['percent'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h3 class="text-xl font-bold text-[#131D4F] mt-10 mb-4">Recent Transactions</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border rounded-xl overflow-hidden">
                        <thead class="bg-[#254D70] text-white">
                            <tr>
                                <th class="py-3 px-4">Date</th>
                                <th class="py-3 px-4">Transaction</th>
                                <th class="py-3 px-4">Category</th>
                                <th class="py-3 px-4">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentTransaction as $data)
                                <tr class="border-b">
                                    <td class="py-3 px-4 text-center">{{ $data->created_at->format('M d, Y') }}</td>
                                    <td class="py-3 px-4 text-center capitalize">{{ $data->title }}</td>
                                    <td class="py-3 px-4 text-center capitalize">{{ $data->category->name }}</td>
                                    <td class="py-3 px-4 text-center text-red-600">-{{ $data->amount }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <h3 class="text-xl font-bold text-[#131D4F] mt-10 mb-4">Monthly Insights</h3>

                <div class="bg-[#254D70] text-white p-6 rounded-xl shadow leading-relaxed">
                    <p class="mb-4">
                        {!! nl2br(e($insights)) !!}
                    </p>
                </div>

                <p class="mt-6 text-gray-600 text-sm">
                    Report generated for month {{ $formattedMonth }} {{ $year }} by ExpenseTracker App.
                </p>

            </div>
        </div>

    </div>
</x-app-layout>
