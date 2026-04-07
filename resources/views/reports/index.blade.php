<x-app-layout>
    <div>
        <div class="w-full bg-[#EFE4D2] py-10 px-4 flex justify-center">
            <div class="w-full max-w-5xl bg-white rounded-2xl shadow p-8">

                <!-- Header -->
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-[#131D4F]">
                            Expense Reports
                        </h1>
                        <p class="text-gray-600 mt-1">
                            Generate and view detailed reports of your expenses.
                        </p>
                    </div>
                </div>

                <hr class="my-6 border-gray-300">

                <!-- Report Filters -->
                <div class="mb-6">
                    <form action="{{ route('reports.monthly_report') }}" method="POST" class="flex items-end gap-4">
                        @csrf
                        <div>
                            <label for="month" class="block text-gray-700 mb-2">Select Month:</label>
                            <input type="month" id="month" name="month"
                                class="border border-gray-300 rounded px-3 py-2" required>
                        </div>
                        <button type="submit"
                            class="bg-[#954C2E] text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">
                            Generate Report
                        </button>
                    </form>
                </div>
                <x-toast />
            </div>
        </div>
    </div>
</x-app-layout>
