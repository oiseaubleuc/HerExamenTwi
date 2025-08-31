<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-dark-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-dark-green-700 focus:bg-dark-green-700 active:bg-dark-green-800 focus:outline-none focus:ring-2 focus:ring-dark-green-500 focus:ring-offset-2 focus:ring-offset-dark-bg-900 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
