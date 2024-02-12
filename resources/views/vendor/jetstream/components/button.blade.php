<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-[#F4841A] border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-900 focus:outline-none focus:border-[#FFF] focus:ring focus:ring-gray-300 disabled:opacity-25 transition hover:scale-105 duration-300 ease-in-out']) }}>
    {{ $slot }}
</button>
