<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold mb-8 text-primary">Meu CineTrack</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">

        <div class="bg-surface p-6 rounded-lg shadow border border-gray-800">
            <h3 class="text-textMuted text-sm uppercase tracking-wider">Assistidos</h3>
            <p class="text-3xl font-bold text-text mt-2">{{ $watchedCount }}</p>
        </div>

        <div class="bg-surface p-6 rounded-lg shadow border border-gray-800">
            <h3 class="text-textMuted text-sm uppercase tracking-wider">Horas Assistidas</h3>
            <p class="text-3xl font-bold text-text mt-2">{{ $hoursWatched }}h</p>
        </div>

        <div class="bg-surface p-6 rounded-lg shadow border border-gray-800">
            <h3 class="text-textMuted text-sm uppercase tracking-wider">Média de Avaliação</h3>
            <p class="text-3xl font-bold text-primary mt-2">⭐ {{ $averageRating }}</p>
        </div>

        <div class="bg-surface p-6 rounded-lg shadow border border-gray-800">
            <h3 class="text-textMuted text-sm uppercase tracking-wider">Na Watchlist</h3>
            <p class="text-3xl font-bold text-text mt-2">{{ $watchlistCount }}</p>
        </div>

    </div>

    <hr class="border-gray-800 mb-8">

    <h2 class="text-2xl font-bold mb-6 text-text">Meus Filmes</h2>

    @if ($movies->isEmpty())
        <div class="bg-surface p-10 rounded-lg text-center border border-gray-800">
            <p class="text-textMuted mb-4">Você ainda não adicionou nenhum filme.</p>
            <a href="{{ route('movies.explore') }}"
                class="inline-block bg-primary hover:bg-primaryHover text-gray-900 font-bold py-2 px-4 rounded transition">
                Explorar Filmes
            </a>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach ($movies as $movie)
                <div
                    class="bg-surface rounded-lg overflow-hidden shadow-lg border border-gray-800 relative hover:scale-105 transition-transform duration-200">

                    <a href="{{ route('movies.show', $movie->tmdb_id) }}">
                        @if ($movie->poster_path)
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}"
                                alt="{{ $movie->title }}" class="w-full h-auto">
                        @else
                            <div class="w-full h-64 bg-gray-800 flex items-center justify-center">
                                <span class="text-textMuted">Sem Imagem</span>
                            </div>
                        @endif
                    </a>

                    <div class="p-3">
                        <h3 class="text-text font-bold text-sm truncate" title="{{ $movie->title }}">{{ $movie->title }}
                        </h3>

                        <div class="flex justify-between items-center mt-2">
                            @if ($movie->status === 'watched')
                                <span class="bg-green-900 text-green-300 text-xs px-2 py-1 rounded">Assistido</span>
                            @else
                                <span class="bg-blue-900 text-blue-300 text-xs px-2 py-1 rounded">Watchlist</span>
                            @endif

                            @if ($movie->is_favorite)
                                <span class="text-primary text-sm">❤️</span>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>
