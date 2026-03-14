<div>
    @if (!empty($movie['backdrop_path']))
        <div class="w-full h-[400px] bg-cover bg-center relative"
            style="background-image: url('https://image.tmdb.org/t/p/original{{ $movie['backdrop_path'] }}');">
            <div class="absolute inset-0 bg-gradient-to-t from-background to-transparent"></div>
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
    @else
        <div class="w-full h-32 bg-surface"></div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-32 relative z-10 pb-12">
        <div class="flex flex-col md:flex-row gap-8">

            <div class="w-full md:w-1/3 lg:w-1/4">
                <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}"
                    class="w-full rounded-lg shadow-2xl border-4 border-surface mb-6">

                <div class="bg-surface p-6 rounded-lg shadow-lg border border-gray-800">
                    <h3 class="text-xl font-bold text-primary mb-4">Seu Registro</h3>

                    <form wire:submit.prevent="saveMovie" class="space-y-4">

                        <div>
                            <label class="block text-sm font-medium text-textMuted mb-1">Status</label>
                            <select wire:model="status"
                                class="w-full bg-background border border-gray-700 rounded-md text-text focus:ring-primary focus:border-primary p-2">
                                <option value="watchlist">Na Watchlist</option>
                                <option value="watched">Assistido</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-textMuted mb-1">Nota (0.1 a 10)</label>
                            <input type="number" wire:model="rating" step="0.1" min="0.1" max="10"
                                placeholder="Ex: 8.5"
                                class="w-full bg-background border border-gray-700 rounded-md text-text focus:ring-primary focus:border-primary p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-textMuted mb-1">Sua Resenha</label>
                            <textarea wire:model="review" rows="4" placeholder="O que achou do filme?"
                                class="w-full bg-background border border-gray-700 rounded-md text-text focus:ring-primary focus:border-primary p-2"></textarea>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit"
                                class="flex-1 bg-primary hover:bg-primaryHover text-gray-900 font-bold py-2 px-4 rounded transition duration-200">
                                Salvar Registro
                            </button>

                            <button type="button" wire:click="toggleFavorite"
                                class="p-2 border border-gray-700 rounded bg-background hover:bg-gray-800 transition">
                                <span class="text-xl">{!! $is_favorite ? '❤️' : '🤍' !!}</span>
                            </button>
                        </div>

                        @if ($savedMessage)
                            <div class="text-green-400 text-sm text-center mt-2 font-medium"
                                wire:poll.3s="$set('savedMessage', false)">
                                Salvo com sucesso!
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <div class="w-full md:w-2/3 lg:w-3/4 pt-4 md:pt-32">
                <h1 class="text-4xl md:text-5xl font-bold text-text mb-2">{{ $movie['title'] }}</h1>

                <div class="flex flex-wrap items-center gap-4 text-textMuted text-sm mb-6">
                    <span>{{ date('Y', strtotime($movie['release_date'])) }}</span>
                    <span>•</span>
                    <span>{{ $movie['runtime'] }} min</span>
                    <span>•</span>
                    <span class="text-primary font-bold">⭐ {{ number_format($movie['vote_average'], 1) }} TMDB</span>
                    <span>•</span>
                    <span>Direção: <span class="text-text">{{ $director }}</span></span>
                </div>

                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-text mb-3">Sinopse</h2>
                    <p class="text-textMuted leading-relaxed">{{ $movie['overview'] ?: 'Sinopse não disponível.' }}</p>
                </div>

                @if ($trailerKey)
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-text mb-4">Trailer</h2>
                        <div
                            class="aspect-w-16 aspect-h-9 relative rounded-lg overflow-hidden shadow-lg border border-gray-800">
                            <iframe src="https://www.youtube.com/embed/{{ $trailerKey }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen class="w-full h-[300px] md:h-[500px]">
                            </iframe>
                        </div>
                    </div>
                @endif

                <div>
                    <h2 class="text-2xl font-semibold text-text mb-4">Elenco Principal</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach (array_slice($movie['credits']['cast'] ?? [], 0, 5) as $actor)
                            <div class="bg-surface rounded-lg p-3 text-center border border-gray-800">
                                @if (!empty($actor['profile_path']))
                                    <img src="https://image.tmdb.org/t/p/w200{{ $actor['profile_path'] }}"
                                        alt="{{ $actor['name'] }}"
                                        class="w-16 h-16 rounded-full mx-auto object-cover mb-2">
                                @else
                                    <div
                                        class="w-16 h-16 rounded-full bg-gray-700 mx-auto mb-2 flex items-center justify-center">
                                        👤</div>
                                @endif
                                <p class="text-text text-sm font-medium leading-tight">{{ $actor['name'] }}</p>
                                <p class="text-textMuted text-xs mt-1">{{ $actor['character'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
