<?php

namespace App\Livewire\Movies;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout; // 1. Importe o atributo Layout aqui

#[Layout('layouts.app')] // 2. Adicione esta linha logo acima da classe
class Index extends Component
{
    public function render()
    {
        // 1. Pegamos o usuário que está logado no momento
        $user = Auth::user();

        // 2. Buscamos todos os filmes dele
        $movies = $user->movies()->latest()->get();

        // 3. Calculamos as estatísticas direto no banco de dados (mais rápido)
        $watchedCount = $user->movies()->where('status', 'watched')->count();
        $watchlistCount = $user->movies()->where('status', 'watchlist')->count();

        // Somamos os minutos de todos os filmes assistidos e dividimos por 60 para ter as horas
        $totalMinutes = $user->movies()->where('status', 'watched')->sum('runtime');
        $hoursWatched = floor($totalMinutes / 60);

        // Calculamos a média das notas (ignorando os que não têm nota)
        $averageRating = $user->movies()->where('status', 'watched')->whereNotNull('rating')->avg('rating') ?? 0;

        // 4. Enviamos tudo isso para a nossa página (view)
        return view('livewire.movies.index', [
            'movies' => $movies,
            'watchedCount' => $watchedCount,
            'watchlistCount' => $watchlistCount,
            'hoursWatched' => $hoursWatched,
            'averageRating' => number_format($averageRating, 1) // Formata para 1 casa decimal (ex: 8.5)
        ]);
    }
}