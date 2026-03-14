@props(['active'])

@php
$classes = ($active ?? false)
            // Classes para quando o link ESTÁ ativo (Página atual)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary text-sm font-medium leading-5 text-text focus:outline-none focus:border-primaryHover transition duration-150 ease-in-out'
            
            // Classes para quando o link NÃO ESTÁ ativo
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-textMuted hover:text-text hover:border-gray-700 focus:outline-none focus:text-text focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>