<div class="relative w-full max-w-md mx-auto z-50">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-textMuted">
            🔍
        </div>
        
        <input
            type="text"
            wire:model.live.debounce.500ms="query"
            class="block w-full pl-10 pr-3 py-2 border border-gray-700 rounded-full leading-5 bg-surface text-text placeholder-textMuted focus:outline-none focus:bg-background focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out shadow-inner"
            placeholder="Buscar filmes (ex: Matrix, Inception)..."
            autocomplete="off"
        >
    </div>

    @if(strlen($query) >= 2)
        <div class="absolute mt-2 w-full bg-surface shadow-2xl rounded-lg border border-gray-700 overflow-hidden">
            
            @if(count($results) > 0)
                <ul class="max-h-96 overflow-y-auto">
                    @foreach($results as $movie)
                        <li>
                            <a href="{{ route('movies.show', $movie['id']) }}" class="flex items-center px-4 py-3 hover:bg-gray-800 border-b border-gray-800 last:border-0 transition duration-150">
                                
                                @if(!empty($movie['poster_path']))
                                    <img src="https://image.tmdb.org/t/p/w92{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-10 h-14 object-cover rounded shadow mr-4">
                                @else
                                    <div class="w-10 h-14 bg-gray-700 rounded mr-4 flex items-center justify-center text-[10px] text-textMuted text-center">Sem Imagem</div>
                                @endif
                                
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-text truncate">{{ $movie['title'] }}</p>
                                    <p class="text-xs text-textMuted mt-1">
                                        {{ !empty($movie['release_date']) ? date('Y', strtotime($movie['release_date'])) : 'Ano Desconhecido' }}
                                        <span class="ml-2 text-primary font-bold">⭐ {{ number_format($movie['vote_average'], 1) }}</span>
                                    </p>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-4 py-4 text-sm text-textMuted text-center">
                    Nenhum filme encontrado para "<span class="text-text font-bold">{{ $query }}</span>".
                </div>
            @endif

        </div>
    @endif
</div>