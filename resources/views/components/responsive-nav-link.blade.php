@props(['active'])

@php
$classes = ($active ?? false)
            // Classes para quando o link ESTÁ ativo (página atual no celular)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-primary text-start text-base font-medium text-primary bg-gray-100 dark:bg-gray-800/50 focus:outline-none focus:text-primaryHover focus:bg-gray-200 dark:focus:bg-gray-800 focus:border-primaryHover transition duration-150 ease-in-out'
            
            // Classes para quando o link NÃO ESTÁ ativo
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-textMuted hover:text-text hover:bg-gray-200 dark:hover:bg-gray-800 hover:border-gray-600 focus:outline-none focus:text-text focus:bg-gray-200 dark:focus:bg-gray-800 focus:border-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>