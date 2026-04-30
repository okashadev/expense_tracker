<x-app-layout>
    <div class="px-4 py-2 w-full ">
        <div class="flex w-full justify-between items-center pb-8">
            <h1 class="text-4xl text-[#254D70] font-extrabold">Categories</h1>
            <a href="{{ route('categories.create') }}">
                <button
                    class="bg-[#954C2E] hover:bg-[#954C2E]/80 text-white px-4 py-2 rounded-lg shadow-lg flex items-center">
                    <span class="material-symbols-outlined me-2">
                        add
                    </span>
                    <span>Add Category</span>
                </button>
            </a>
        </div>


        {{-- yah table hy  --}}

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-[#131D4F] bg-gray-200 uppercase">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Icon
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $data)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                <div
                                    class="border border-[#954C2E]/40 bg-gray-100 hover:bg-gray-200 w-10 h-10 flex items-center justify-center rounded-lg transition-all duration-150 ">
                                    <span class="material-symbols-outlined  text-2xl text-[#954C2E]">
                                        {{ $data->icon }}
                                    </span>
                                </div>
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <span class="text-md font-semibold">
                                    {{ $data->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                @if ($data->user_id !== null)
                                    <a href="#"
                                        class="font-medium bg-[#954C2E] rounded-xl px-2 py-1 flex justify-center items-center text-white">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                    <button data-modal-target="popup-modal-{{ $data->id }}"
                                        data-modal-toggle="popup-modal-{{ $data->id }}" type="button"
                                        class="font-medium bg-red-600 rounded-xl px-2 py-1 flex justify-center items-center text-white">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                @else
                                    <span class="text-sm text-gray-500 italic">Default category
                                    </span>
                                @endif
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
                                    <form action="{{ route('categories.destroy', $data->id) }}" method="POST">
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
                                                delete this Category?</h3>
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
    </div>
</x-app-layout>
