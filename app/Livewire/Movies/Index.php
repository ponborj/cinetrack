<?php

namespace App\Livewire\Movies;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;// 1. Importe o atributo Layout aqui

#[Layout('layouts.app')] // 2. Adicione esta linha logo acima da classe
class Index extends Component
{
    use WithPagination;

    // Variáveis que vão guardar o estado dos nossos filtros
    public $filterStatus = 'watched'; // Por padrão, mostra os Assistidos (como na imagem)
    public $searchQuery = '';
    public $sortBy = 'created_at'; // Ordenação padrão: Data
    public $sortDirection = 'desc'; // Do mais recente para o mais antigo

    // Livewire chama essa função automaticamente quando a variável $searchQuery é alterada
    public function updatingSearchQuery()
    {
        $this->resetPage(); // Volta pra página 1 ao buscar
    }

    // Função para mudar o status ao clicar no botão
    public function setFilter($status)
    {
        $this->filterStatus = $status;
        $this->resetPage(); // Volta pra página 1 ao trocar de aba
    }

    // Função para mudar a ordenação
    public function setSort($field)
    {
        // Se clicar no mesmo campo, inverte a ordem (Ex: Data ↓ para Data ↑)
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            // Se clicar em um campo novo, define ele como padrão decrescente
            $this->sortBy = $field;
            $this->sortDirection = 'desc';
        }
        $this->resetPage(); // Volta pra página 1 ao reordenar
    }

    public function render()
    {
        // Pegamos o usuário que está logado no momento
        $user = Auth::user();

        // Iniciamos a "pergunta" ao banco de dados, mas sem pegar os dados ainda
        $query = $user->movies();

        // Aplicamos o filtro de Status OU Favoritos
        if ($this->filterStatus === 'favorites') {
            // Se o filtro for favoritos, busca apenas os que têm a estrela/coração marcado
            $query->where('is_favorite', true);
        } elseif ($this->filterStatus) {
            // Se for assistido ou watchlist, busca normalmente pela coluna status
            $query->where('status', $this->filterStatus);
        }

        // Aplicamos o filtro de Busca (Busca pelo título do filme salvo)
        if (!empty($this->searchQuery)) {
            $query->where('title', 'like', '%' . $this->searchQuery . '%');
        }

        // Aplicamos a Ordenação
        $query->orderBy($this->sortBy, $this->sortDirection);

        // Trocamos o get() por paginate(). Aqui escolhemos exibir 10 filmes por página.
        $movies = $query->paginate(12);

        // As estatísticas continuam as mesmas, calculando do total
        $watchedCount = $user->movies()->where('status', 'watched')->count();
        $watchlistCount = $user->movies()->where('status', 'watchlist')->count();

        $totalMinutes = $user->movies()->where('status', 'watched')->sum('runtime');
        $hoursWatched = floor($totalMinutes / 60);
        $minutesWatched = $totalMinutes % 60;
        $timeWatched = "{$hoursWatched}h {$minutesWatched}m";

        $averageRating = $user->movies()->where('status', 'watched')->whereNotNull('rating')->avg('rating') ?? 0;

        return view('livewire.movies.index', [
            'movies' => $movies,
            'watchedCount' => $watchedCount,
            'watchlistCount' => $watchlistCount,
            'timeWatched' => $timeWatched,
            'averageRating' => number_format($averageRating, 1)
        ]);
    }
}