<x-app-layout>
    <div class="px-4 py-2 w-full">
        <div class="flex w-full justify-between items-center pb-8">
            <h1 class="text-4xl text-[#254D70] font-extrabold">Add New Expense</h1>
        </div>

        <div class="w-full bg-white p-10 rounded-lg shadow-lg">
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="title" class="block mb-2 text-lg font-medium text-gray-900">Expense Title</label>
                        <input type="text" name="title" id="title"
                            class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-[#954C2E] focus:border-[#954C2E] block w-full p-2.5"
                            placeholder="Enter Expense Title" required>
                    </div>
                    <div class="w-full">
                        <label for="amount" class="block mb-2 text-lg font-medium text-gray-900">Amount</label>
                        <input type="number" name="amount" id="amount"
                            class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-[#954C2E] focus:border-[#954C2E] block w-full p-2.5"
                            placeholder="$2999" required>
                    </div>
                    <div>
                        <label for="category" class="block mb-2 text-lg font-medium text-gray-900">Category</label>
                        <select id="category" name="category_id" required
                            class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-[#954C2E] focus:border-[#954C2E] block w-full p-2.5">
                            <option selected disabled>Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-lg font-medium text-gray-900">Description</label>
                        <textarea id="description" rows="4" name="description"
                            class="block p-2.5 w-full text-sm text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#954C2E] focus:border-[#954C2E]"
                            placeholder="Your description here"></textarea>
                    </div>
                </div>
                <div class="w-full flex justify-end pt-8">
                    <button type="submit"
                        class="text-white bg-[#954C2E] hover:bg-[#954C2E]/80 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
