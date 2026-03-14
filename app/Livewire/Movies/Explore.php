<?php

namespace App\Livewire\Movies;

use Livewire\Component;
use App\Services\TmdbService;
use Livewire\Attributes\Layout; // 1. Importe o atributo Layout aqui

#[Layout('layouts.app')] // 2. Adicione esta linha logo acima da classe
class Explore extends Component
{
    // Variáveis que vão guardar as listas de filmes
    public array $trending = [];
    public array $popular = [];
    public array $nowPlaying = [];

    /**
     * O método mount roda uma vez quando a página carrega.
     * Injetamos o TmdbService aqui para podermos usá-lo.
     */
    public function mount(TmdbService $tmdbService)
    {
        // Buscamos os dados da API. A API retorna um array grande, 
        // mas os filmes ficam dentro da chave 'results'.

        $trendingData = $tmdbService->getTrending();
        $this->trending = $trendingData['results'] ?? [];

        $popularData = $tmdbService->getPopular();
        $this->popular = $popularData['results'] ?? [];

        $nowPlayingData = $tmdbService->getNowPlaying();
        $this->nowPlaying = $nowPlayingData['results'] ?? [];
    }

    public function render()
    {
        return view('livewire.movies.explore');
    }
}