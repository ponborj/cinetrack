<?php

namespace App\Livewire\Movies;

use Livewire\Component;
use App\Services\TmdbService;
use App\Models\UserMovie;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] // Usando o layout correto que arrumamos antes!
class Show extends Component
{
    public $movie; // Dados do filme vindos do TMDB
    public $director;
    public $trailerKey;

    // Campos do nosso formulário
    public $status = 'watchlist'; // Padrão
    public $rating = null;
    public $review = '';
    public $is_favorite = false;

    public $savedMessage = false; // Para mostrar uma mensagem de sucesso

    public function mount($id, TmdbService $tmdbService)
    {
        // 1. Busca os detalhes do filme na API
        $this->movie = $tmdbService->getMovieDetails($id);

        if (!$this->movie) {
            abort(404, 'Filme não encontrado.');
        }

        // 2. Extrai o Diretor da lista da equipe (crew)
        $crew = $this->movie['credits']['crew'] ?? [];
        $directorData = collect($crew)->firstWhere('job', 'Director');
        $this->director = $directorData ? $directorData['name'] : 'Não informado';

        // 3. Extrai o Trailer do YouTube (pega o primeiro vídeo do tipo Trailer)
        $videos = $this->movie['videos']['results'] ?? [];
        $trailerData = collect($videos)->firstWhere('type', 'Trailer');
        $this->trailerKey = $trailerData ? $trailerData['key'] : null;

        // 4. Verifica se o usuário já tem esse filme salvo no banco de dados
        $userMovie = UserMovie::where('user_id', Auth::id())
            ->where('tmdb_id', $id)
            ->first();

        // Se já tiver salvo, preenche o formulário com os dados do banco
        if ($userMovie) {
            $this->status = $userMovie->status;
            $this->rating = $userMovie->rating;
            $this->review = $userMovie->review;
            $this->is_favorite = $userMovie->is_favorite;
        }
    }

    // Função que será chamada quando o usuário clicar no botão "Salvar"
    public function saveMovie()
    {
        // Validação básica dos dados
        $this->validate([
            'status' => 'required|in:watched,watchlist',
            'rating' => 'nullable|numeric|min:0.1|max:10',
            'review' => 'nullable|string',
        ]);

        // Cria ou atualiza o filme no banco de dados
        UserMovie::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'tmdb_id' => $this->movie['id'],
            ],
            [
                'title' => $this->movie['title'],
                'poster_path' => $this->movie['poster_path'],
                'runtime' => $this->movie['runtime'] ?? 0,
                'status' => $this->status,
                'rating' => $this->rating,
                'review' => $this->review,
                'is_favorite' => $this->is_favorite,
            ]
        );

        // Mostra a mensagem de sucesso por 3 segundos
        $this->savedMessage = true;
    }

    // Atalho para favoritar/desfavoritar com um clique
    public function toggleFavorite()
    {
        $this->is_favorite = !$this->is_favorite;
        $this->saveMovie(); // Salva automaticamente ao mudar o coração
    }

    public function render()
    {
        return view('livewire.movies.show');
    }
}