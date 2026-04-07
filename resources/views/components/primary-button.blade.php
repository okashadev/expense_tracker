<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-center items-center px-4 py-2 bg-[#954C2E] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#954C2E]/70 focus:bg-[#954C2E] active:bg-[#954C2E]/70 focus:outline-none focus:ring-2 focus:ring-[#954C2E]/80 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
