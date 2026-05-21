<x-app-layout>
    <div class="px-4 py-2 w-full ">
        <div class="flex w-full justify-between items-center pb-8">
            <h1 class="text-4xl text-[#131D4F] font-extrabold">Expenses</h1>
            <a href="{{ route('expenses.create') }}">
                <button
                    class="bg-[#954C2E] hover:bg-[#954C2E]/80 text-white px-4 py-2 rounded-lg shadow-lg flex items-center">
                    <span class="material-symbols-outlined me-2">
                        add
                    </span>
                    <span>Add Expense</span>
                </button>
            </a>
        </div>


        <form action="{{ route('expenses.index.filter') }}" method="POST"
            class="bg-white mb-12 mt-4 flex flex-col md:flex-row items-center gap-5 justify-between p-6 shadow-lg rounded-lg">
            @csrf
            @method('POST')
            <div class="flex flex-col items-start gap-3 w-full">
                <label for="start_date" class="font-medium">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="{{ $start_date }}"
                    class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-[#954C2E] focus:border-[#954C2E] block w-full p-2.5"
                    required>
            </div>
            <div class="flex flex-col items-start gap-3 w-full">
                <label for="end_date" class="font-medium">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ $end_date }}"
                    class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-[#954C2E] focus:border-[#954C2E] block w-full p-2.5"
                    required>
            </div>
            <div class="flex flex-col items-start gap-3 w-full">
                <label for="category_id" class="font-medium">Select Category</label>
                <select id="category" name="category_id"
                    class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-[#954C2E] focus:border-[#954C2E] block w-full p-2.5">
                    <option disabled>Select category</option>
                    <option value="" {{ $category_id == null ? 'selected' : '' }}>All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="max-md:w-full w-full">
                <button type="submit"
                    class="text-white mt-8 bg-[#954C2E] hover:bg-[#954C2E]/80 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    Apply
                </button>
                {{-- <a href="{{ route('expenses.index') }}"
                    class="text-white mt-8 bg-[#954C2E] hover:bg-[#954C2E]/80 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    Clear
                </a> --}}
            </div>
        </form>


        {{-- yah table hy  --}}

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-[#131D4F] bg-gray-200">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Amount
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $key => $data)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $expenses->firstItem() + $key }}
                            </td>
                            <th scope="row" class="px-6 py-4 capitalize font-medium text-gray-900 whitespace-nowrap">
                                {{ $data->title }}
                            </th>
                            <td class="px-6 py-4 capitalize">
                                {{ $data->category->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ currency_symbol() }} {{ $data->amount }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('expenses.edit', $data->id) }}"
                                    class="font-medium bg-[#954C2E] rounded-xl px-2 py-1 flex justify-center items-center text-white">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                                <button data-modal-target="popup-modal-{{ $data->id }}"
                                    data-modal-toggle="popup-modal-{{ $data->id }}" type="button"
                                    class="font-medium bg-red-600 rounded-xl px-2 py-1 flex justify-center items-center text-white">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </td>
                        </tr>
                        <div id="popup-modal-{{ $data->id }}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow-sm">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-[#954C2E] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="popup-modal-{{ $data->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <form action="{{ route('expenses.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-red-600 w-12 h-12" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 ">Are you sure you want to
                                                delete this Expense?</h3>
                                            <button data-modal-hide="popup-modal-{{ $data->id }}" type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Yes, I'm sure
                                            </button>
                                            <button data-modal-hide="popup-modal-{{ $data->id }}" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-[#954C2E] focus:outline-none bg-white rounded-lg border border-[#954C2E] hover:bg-gray-100 hover:text-[#954C2E] focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 p-4 bg-transparent">
            {{ $expenses->links() }}
        </div>
        <div id="popup-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-[#954C2E] rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-red-600 w-12 h-12" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 ">Are you sure you want to
                            delete this product?</h3>
                        <button data-modal-hide="popup-modal" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="popup-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-[#954C2E] focus:outline-none bg-white rounded-lg border border-[#954C2E] hover:bg-gray-100 hover:text-[#954C2E] focus:z-10 focus:ring-4 focus:ring-gray-100">
                            cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
