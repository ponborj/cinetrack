<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8 text-primary">Explorar Filmes</h1>

    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 text-text flex items-center">
            <span class="mr-2">🍿</span> Nos Cinemas
        </h2>

        <div class="flex overflow-x-auto space-x-6 pb-4 scrollbar-hide">
            @foreach ($nowPlaying as $movie)
                <div class="flex-none w-36 sm:w-48 relative group">
                    <a href="{{ route('movies.show', $movie['id']) }}"
                        class="block transform transition duration-300 hover:scale-105 hover:z-10">
                        @if (!empty($movie['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                                alt="{{ $movie['title'] }}"
                                class="rounded-lg shadow-lg border border-gray-800 w-full h-auto">
                        @else
                            <div
                                class="w-full h-56 sm:h-72 bg-surface rounded-lg shadow border border-gray-800 flex items-center justify-center">
                                <span class="text-textMuted text-xs">Sem Imagem</span>
                            </div>
                        @endif
                    </a>
                    <h3 class="text-text font-medium text-sm mt-2 truncate">{{ $movie['title'] }}</h3>
                    <p class="text-primary text-xs font-bold">⭐ {{ number_format($movie['vote_average'], 1) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 text-text flex items-center">
            <span class="mr-2">🔥</span> Em Alta Esta Semana
        </h2>

        <div class="flex overflow-x-auto space-x-6 pb-4 scrollbar-hide">
            @foreach ($trending as $movie)
                <div class="flex-none w-36 sm:w-48 relative group">
                    <a href="{{ route('movies.show', $movie['id']) }}"
                        class="block transform transition duration-300 hover:scale-105 hover:z-10">
                        @if (!empty($movie['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                                alt="{{ $movie['title'] }}"
                                class="rounded-lg shadow-lg border border-gray-800 w-full h-auto">
                        @else
                            <div
                                class="w-full h-56 sm:h-72 bg-surface rounded-lg shadow border border-gray-800 flex items-center justify-center">
                                <span class="text-textMuted text-xs">Sem Imagem</span>
                            </div>
                        @endif
                    </a>
                    <h3 class="text-text font-medium text-sm mt-2 truncate">{{ $movie['title'] }}</h3>
                    <p class="text-primary text-xs font-bold">⭐ {{ number_format($movie['vote_average'], 1) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 text-text flex items-center">
            <span class="mr-2">🌟</span> Populares
        </h2>

        <div class="flex overflow-x-auto space-x-6 pb-4 scrollbar-hide">
            @foreach ($popular as $movie)
                <div class="flex-none w-36 sm:w-48 relative group">
                    <a href="{{ route('movies.show', $movie['id']) }}"
                        class="block transform transition duration-300 hover:scale-105 hover:z-10">
                        @if (!empty($movie['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                                alt="{{ $movie['title'] }}"
                                class="rounded-lg shadow-lg border border-gray-800 w-full h-auto">
                        @else
                            <div
                                class="w-full h-56 sm:h-72 bg-surface rounded-lg shadow border border-gray-800 flex items-center justify-center">
                                <span class="text-textMuted text-xs">Sem Imagem</span>
                            </div>
                        @endif
                    </a>
                    <h3 class="text-text font-medium text-sm mt-2 truncate">{{ $movie['title'] }}</h3>
                    <p class="text-primary text-xs font-bold">⭐ {{ number_format($movie['vote_average'], 1) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

</div>
