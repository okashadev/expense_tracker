<div class="flex flex-col relative items-start col-span-2 justify-center px-5 py-6 rounded-xl shadow-lg bg-white">
    @if ($monthlyLimit)
        <div class="absolute top-1 right-4">
            <button data-modal-target="edit-limit" data-modal-toggle="edit-limit" type="button" title="Edit Limit"
                class="text-[#954C2E] text-xl material-symbols-outlined">
                edit
            </button>
        </div>
        @php
            // Avoid divide-by-zero
            $limit = $monthlyLimit->limit_amount ?? 0;
            $spent = $totalSpent ?? 0;

            // Calculate percentage
            $percentage = $limit > 0 ? ($spent / $limit) * 100 : 0;

            // Never exceed 100%
            $percentage = min($percentage, 100);
        @endphp
        <div class="flex items-start justify-between my-3 w-full">
            <p class=" text-gray-700">
                Monthly Limit
            </p>
            <p class="class=" text-gray-700"">
                {{ currency_symbol() }}{{ number_format($spent) }} of {{ currency_symbol() }} {{ number_format($limit) }}
            </p>
        </div>

        <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
            <div class="bg-[#954C2E] h-3 rounded-full transition-all duration-500" style="width: {{ $percentage }}%">
            </div>
        </div>

        <div id="edit-limit" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-[#f8f1e4] rounded-lg shadow-sm">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h3 class="text-lg font-semibold text-[#254D70]">
                            Edit Monthly Limit
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-toggle="edit-limit">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="{{ route('monthly_limit.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="amount_edit"
                                    class="block mb-2 text-sm font-medium text-gray-900">Limit</label>
                                <input type="text" step="0.01" name="limit" id="amount_edit"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg bg-[#EFE4D2] focus:border-[#954C2E] focus:ring-[#954C2E] block w-full p-2.5"
                                    placeholder="Enter your limit (e.g. $2000)" required
                                    value="{{ number_format($monthlyLimit->limit_amount) }}"
                                    onchange="this.value = this.value.replace(/[^0-9.]/g, '');">
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-[#954C2E] border border-transparent uppercase tracking-widest hover:bg-[#954C2E]/70 focus:bg-[#954C2E] active:bg-[#954C2E]/70 focus:outline-none focus:ring-2 focus:ring-[#954C2E]/80 focus:ring-offset-2 transition ease-in-out duration-150 font-semibold rounded-lg text-xs px-5 py-2.5 text-center">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="flex flex-col items-center justify-center w-full">
            <p class=" text-gray-700 mb-4">
                You haven’t set your monthly limit yet.
            </p>
            <button data-modal-target="set-limit" data-modal-toggle="set-limit" type="button"
                class="bg-[#954C2E] text-white px-4 py-2 rounded-lg hover:bg-[#7A3A23] transition-colors duration-300">
                Set Monthly Limit
            </button>
        </div>

        <div id="set-limit" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-[#f8f1e4] rounded-lg shadow-sm">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h3 class="text-lg font-semibold text-[#254D70]">
                            Set Monthly Limit
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-toggle="set-limit">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="{{ route('monthly_limit.store') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="amount_set"
                                    class="block mb-2 text-sm font-medium text-gray-900">Limit</label>
                                <input type="text" step="0.01" name="limit" id="amount_set"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg bg-[#EFE4D2] focus:border-[#954C2E] focus:ring-[#954C2E] block w-full p-2.5"
                                    placeholder="Enter your limit (e.g. $2000)" required
                                    onchange="this.value = this.value.replace(/[^0-9.]/g, '');">
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-[#954C2E] border border-transparent uppercase tracking-widest hover:bg-[#954C2E]/70 focus:bg-[#954C2E] active:bg-[#954C2E]/70 focus:outline-none focus:ring-2 focus:ring-[#954C2E]/80 focus:ring-offset-2 transition ease-in-out duration-150 font-semibold rounded-lg text-xs px-5 py-2.5 text-center">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
