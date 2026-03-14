<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TmdbService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.key', env('TMDB_API_KEY'));
        $this->baseUrl = env('TMDB_BASE_URL', 'https://api.themoviedb.org/3');
    }

    // Método genérico para fazer a requisição com cache
    protected function fetch(string $endpoint, array $params = [], int $cacheMinutes = 60)
    {
        $params['api_key'] = $this->apiKey;
        $params['language'] = 'pt-BR'; // Retorna os dados em português

        // Cria uma chave de cache única baseada na URL e parâmetros
        $cacheKey = 'tmdb_' . md5($endpoint . serialize($params));

        return Cache::remember($cacheKey, now()->addMinutes($cacheMinutes), function () use ($endpoint, $params) {
            $response = Http::get($this->baseUrl . $endpoint, $params);

            if ($response->successful()) {
                return $response->json();
            }

            return null; // Retorna nulo se der erro
        });
    }

    public function getTrending()
    {
        return $this->fetch('/trending/movie/week');
    }

    public function getPopular()
    {
        return $this->fetch('/movie/popular');
    }

    public function getNowPlaying()
    {
        return $this->fetch('/movie/now_playing');
    }

    public function getMovieDetails(int $movieId)
    {
        // Traz o filme com os vídeos (para o trailer) e créditos (elenco/diretor)
        return $this->fetch("/movie/{$movieId}", ['append_to_response' => 'videos,credits']);
    }

    public function searchMovies(string $query)
    {
        // Buscas não precisam de muito tempo de cache
        return $this->fetch('/search/movie', ['query' => $query], 10);
    }
}