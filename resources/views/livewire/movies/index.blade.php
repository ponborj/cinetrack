<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold mb-8 text-primary">Meu CineTrack</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">

        <div class="bg-surface p-6 rounded-lg shadow border border-gray-800">
            <h3 class="text-textMuted text-sm uppercase tracking-wider">Assistidos</h3>
            <p class="text-3xl font-bold text-text mt-2">{{ $watchedCount }}</p>
        </div>

        <div class="bg-surface p-6 rounded-lg shadow border border-gray-800">
            <h3 class="text-textMuted text-sm uppercase tracking-wider">Horas Assistidas</h3>
            <p class="text-3xl font-bold text-text mt-2">{{ $timeWatched }}</p>
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

    <div
        class="flex flex-col md:flex-row justify-between items-center bg-surface p-2 rounded-lg border border-gray-800 mb-8 gap-4">

        <div class="flex space-x-2 w-full md:w-auto overflow-x-auto custom-scrollbar">
            <button wire:click="setFilter('watched')"
                class="flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors whitespace-nowrap
                {{ $filterStatus === 'watched' ? 'bg-primary text-gray-900' : 'text-textMuted hover:text-text hover:bg-gray-800' }}">
                <span class="mr-2">✅</span> Assistidos
            </button>

            <button wire:click="setFilter('watchlist')"
                class="flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors whitespace-nowrap
                {{ $filterStatus === 'watchlist' ? 'bg-primary text-gray-900' : 'text-textMuted hover:text-text hover:bg-gray-800' }}">
                <span class="mr-2">📋</span> Watchlist
            </button>

            <button wire:click="setFilter('favorites')"
                class="flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors whitespace-nowrap
                {{ $filterStatus === 'favorites' ? 'bg-primary text-gray-900' : 'text-textMuted hover:text-text hover:bg-gray-800' }}">
                <span class="mr-2">❤️</span> Favoritos
            </button>
        </div>

        <div class="relative w-full md:w-64">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-textMuted text-sm">🔍</span>
            </div>
            <input wire:model.live.debounce.300ms="searchQuery" type="text" placeholder="Buscar na lista..."
                class="w-full pl-9 pr-3 py-2 bg-background border border-gray-700 rounded-md text-sm text-text placeholder-textMuted focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
        </div>

        <div class="flex items-center space-x-4 md:w-auto text-sm">
            <span class="text-textMuted hidden md:inline">Ordenar:</span>

            <button wire:click="setSort('created_at')"
                class="transition-colors {{ $sortBy === 'created_at' ? 'text-primary font-bold border border-gray-700 bg-gray-800 px-3 py-1 rounded-md' : 'text-textMuted hover:text-text' }}">
                Data {!! $sortBy === 'created_at' ? ($sortDirection === 'desc' ? '↓' : '↑') : '' !!}
            </button>

            <button wire:click="setSort('title')"
                class="transition-colors {{ $sortBy === 'title' ? 'text-primary font-bold border border-gray-700 bg-gray-800 px-3 py-1 rounded-md' : 'text-textMuted hover:text-text' }}">
                Título {!! $sortBy === 'title' ? ($sortDirection === 'desc' ? '↓' : '↑') : '' !!}
            </button>

            <button wire:click="setSort('rating')"
                class="transition-colors {{ $sortBy === 'rating' ? 'text-primary font-bold border border-gray-700 bg-gray-800 px-3 py-1 rounded-md' : 'text-textMuted hover:text-text' }}">
                Sua Nota {!! $sortBy === 'rating' ? ($sortDirection === 'desc' ? '↓' : '↑') : '' !!}
            </button>
        </div>
    </div>

    @if ($movies->isEmpty())
        <div class="bg-surface p-10 rounded-lg text-center border border-gray-800">
            <p class="text-textMuted mb-4">Nenhum filme encontrado com esses filtros.</p>
            @if (empty($searchQuery))
                <a href="{{ route('movies.explore') }}"
                    class="inline-block bg-primary hover:bg-primaryHover text-gray-900 font-bold py-2 px-4 rounded transition">
                    Explorar Filmes
                </a>
            @else
                <button wire:click="$set('searchQuery', '')"
                    class="inline-block text-primary hover:text-primaryHover transition">
                    Limpar Busca
                </button>
            @endif
        </div>
    @else
        <div class="grid grid-cols-3 gap-4 md:grid-cols-5 md:gap-6 lg:grid-cols-6">
            @foreach ($movies as $movie)
                <x-movie-card :id="$movie->tmdb_id" :title="$movie->title" :poster="$movie->poster_path" :rating="$movie->rating" :date="$movie->created_at->format('d/m/Y')"
                    :is-favorite="$movie->is_favorite" />
            @endforeach
        </div>

        <div class="mt-8">
            {{ $movies->links() }}
        </div>
    @endif

</div>
