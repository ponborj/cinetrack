@props([
    'id', // ID do TMDB para gerar o link
    'title', // Título do filme
    'poster', // Caminho da imagem
    'rating' => null, // Nota (opcional)
    'date' => null, // Data (opcional)
    'isFavorite' => false, // Coração (opcional)
])

<div
    {{ $attributes->merge([
        'class' => 'bg-surface rounded-lg overflow-hidden shadow-lg border border-gray-800 relative 
        group hover:scale-105 hover:z-10 transition-transform duration-200 flex flex-col',
    ]) }}>

    <a href="{{ route('movies.show', $id) }}" class="block w-full flex-grow relative">
        @if ($poster)
            <img src="https://image.tmdb.org/t/p/w500{{ $poster }}" alt="{{ $title }}"
                class="w-full h-full object-cover aspect-[2/3]">
        @else
            <div class="w-full aspect-[2/3] bg-gray-800 flex items-center justify-center">
                <span class="text-textMuted text-xs">Sem Imagem</span>
            </div>
        @endif

        @if ($rating)
            <div
                class="absolute top-2 right-2 bg-primary text-gray-900 text-xs font-bold px-2 py-1 rounded shadow-lg z-10">
                ⭐ {{ is_numeric($rating) ? number_format((float) $rating, 1) : $rating }}
            </div>
        @endif
    </a>

    <div class="p-3 flex justify-between items-start mt-auto">
        <div class="min-w-0 flex-1">
            <h3 class="text-text font-bold text-sm truncate" title="{{ $title }}">{{ $title }}</h3>
            @if ($date)
                <p class="text-textMuted text-xs mt-1">{{ $date }}</p>
            @endif
        </div>

        @if ($isFavorite)
            <span class="text-primary text-sm ml-2 shrink-0" title="Favorito">❤️</span>
        @endif
    </div>

</div>
