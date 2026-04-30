<!-- Top Navigation Bar -->
<header id="header" class="flex bg-[#EFE4D2] items-center shadow-lg rounded-b fixed top-0 right-0 sm:left-64 left-0 justify-between px-8 py-4 border-b border-black/10 dark:border-white/10 z-40">
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-white rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>
    <h1 class="text-2xl font-extrabold max-sm:hidden text-[#254D70]">Hello, {{ Auth::user()->name }}!</h2>
    <h1 class="text-2xl font-extrabold sm:hidden text-[#254D70]">Expense Tracker</h2>
    <div class="flex items-center gap-6">
        <a href="{{ route('profile.edit') }}" class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12 border-2 border-[#954C2E]"
            data-alt="User avatar with a gradient background"
            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDA39Dz_genPqdO4AANqVU4J70guqyTAwsvUjwLQm-716Tot3YrSDiguoh5pc-o8Dwl9PnbwxlHeNYaAA5sGZPn2TTKnQFknmkS_NfQgpHj-tQBMrZ-N4nF7WjxrHYVDnI1zT_XP99EtNtC82SxaZaB859MDcmRwX6Q-3FcC57094NNDEOTpvHnRCZTWmNevwqUOlp0HkCQcRnariNtxcRU6tZEolE54kuQK73QLilzLFLuPrqw0Y66LFW-poFkpMJDp3-NdL3A1A');">
        </a>
    </div>
</header>
