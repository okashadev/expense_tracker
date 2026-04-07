@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 bg-[#EFE4D2] focus:border-[#954C2E] focus:ring-[#954C2E] rounded-md shadow-sm']) }}>


