<x-app-layout>
    <div class="px-4 py-2 w-full">
        <div class="flex w-full justify-between items-center pb-8">
            <h1 class="text-4xl text-[#254D70] font-extrabold">Add New Category</h1>
        </div>

        <div class="w-full bg-white p-10 rounded-lg shadow-lg">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="category_name" class="block mb-2 text-lg font-medium text-gray-900">
                        Category Name
                    </label>
                    <input type="text" id="category_name" name="name" required placeholder="Enter Category name"
                        class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-[#954C2E] focus:border-[#954C2E] block w-full p-2.5" />
                </div>

                <div class="mb-5" x-data="{ selectedIcon: '' }">
                    <label class="block mb-3 text-lg font-medium text-gray-900">Choose an Icon</label>

                    <div class="flex flex-wrap gap-4">
                        @php
                            $icons = [
                                'restaurant',
                                'shopping_bag',
                                'flight',
                                'home',
                                'fitness_center',
                                'school',
                                'local_hospital',
                                'pets',
                            ];
                        @endphp

                        @foreach ($icons as $icon)
                            <button type="button" @click="selectedIcon = '{{ $icon }}'"
                                :class="selectedIcon === '{{ $icon }}'
                                    ?
                                    'border-2 border-[#954C2E] bg-blue-50' :
                                    'border border-gray-200 bg-gray-100 hover:bg-gray-200'"
                                class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-150">
                                <span class="material-symbols-outlined text-3xl text-[#954C2E]">{{ $icon }}
                                </span>
                            </button>
                        @endforeach
                    </div>

                    <input type="hidden" name="icon" :value="selectedIcon">
                </div>

                <div class="w-full flex justify-end">
                    <button type="submit"
                        class="text-white bg-[#954C2E] hover:bg-[#954C2E]/80 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
