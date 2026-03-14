<?php

namespace App\Livewire\Movies;

use Livewire\Component;
use App\Services\TmdbService;

class Search extends Component
{
    // A variável que vai guardar o texto digitado
    public string $query = '';
    
    // A lista de resultados que vamos mostrar na tela
    public array $results = [];

    // O Livewire chama essa função automaticamente sempre que a variável $query muda
    public function updatedQuery()
    {
        // Só vamos buscar na API se o usuário digitou 2 letras ou mais
        if (strlen($this->query) >= 2) {
            // Como não injetamos o serviço no mount, chamamos ele pelo container do Laravel (app())
            $tmdbService = app(TmdbService::class);
            
            $response = $tmdbService->searchMovies($this->query);
            
            // Pegamos apenas os 5 primeiros resultados para o menu não ficar gigante
            $this->results = array_slice($response['results'] ?? [], 0, 5);
        } else {
            // Se apagou o texto, limpamos os resultados
            $this->results = [];
        }
    }

    public function render()
    {
        return view('livewire.movies.search');
    }
}