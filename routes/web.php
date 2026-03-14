<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // A rota Home, redireciona para /movies  
    Route::redirect('/', '/movies')->name('home');

    // A rota principal com as estatísticas
    Route::get('/movies', App\Livewire\Movies\Index::class)->name('movies.index');

    // Rota de exploração
    Route::get('/movies/explore', App\Livewire\Movies\Explore::class)->name('movies.explore');

    // Detalhes do filme (sempre colocar rotas com parâmetros {id} por último para não dar conflito)
    Route::get('/movies/{id}', App\Livewire\Movies\Show::class)->name('movies.show');
});
