@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-dark-bg-800 border-dark-bg-700 text-white placeholder-dark-bg-400 focus:border-dark-green-500 focus:ring-dark-green-500 rounded-md shadow-sm transition-colors']) }}>
