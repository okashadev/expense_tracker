<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">

    <div class="h-full px-3 py-4 flex flex-col overflow-y-auto" style="background-color: #254D70">
        <div class="flex items-center gap-3 mb-8">
            <div class="bg-white rounded-full p-1">
                <svg class="text-[#254D70] size-8" fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M44 4H30.6666V17.3334H17.3334V30.6666H4V44H44V4Z" fill="currentColor"></path>
                </svg>
            </div>
            <h1 class="text-xl text-white font-bold">Expense Tracker</h1>
        </div>
        <div class=" flex flex-col h-full justify-between">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-2  rounded-lg group {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white shadow-lg' : 'text-white hover:bg-white/10' }}">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('expenses.index') }}"
                        class="flex items-center p-2  rounded-lg group {{ request()->routeIs('expenses.*') ? 'bg-white/20 text-white shadow-lg' : 'text-white hover:bg-white/10' }}">
                        <span class="material-symbols-outlined">receipt_long</span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Expenses</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}"
                        class="flex items-center p-2  rounded-lg group {{ request()->routeIs('categories.*') ? 'bg-white/20 text-white shadow-lg' : 'text-white hover:bg-white/10' }}">
                        <span class="material-symbols-outlined">category</span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports.index') }}"
                        class="flex items-center p-2  rounded-lg group {{ request()->routeIs('reports.*') ? 'bg-white/20 text-white shadow-lg' : 'text-white hover:bg-white/10' }}">
                        <span class="material-symbols-outlined">assessment</span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Reports</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center p-2  rounded-lg group {{ request()->routeIs('profile.*') ? 'bg-white/20 text-white shadow-lg' : 'text-white hover:bg-white/10' }}">
                        <span class="material-symbols-outlined">person</span>

                        <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
                    </a>
                </li>
                <li>

                </li>
            </ul>
            <div>
                <form action="{{ route('logout') }}" method="POST"
                    class="flex items-center justify-center bg-[#954C2E] hover:bg-[#954C2E]/80 shadow-lg text-white rounded-lg group">
                    @csrf
                    <button type="submit" class="flex py-2 items-center justify-center w-full">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="ms-1 whitespace-nowrap">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
