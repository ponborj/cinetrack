<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold mb-8 text-primary">Explorar Filmes</h1>

    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 text-text flex items-center">
            <span class="mr-2">🍿</span> Nos Cinemas
        </h2>

        <div class="flex overflow-x-auto space-x-6 py-4 px-2 custom-scrollbar">
            @foreach ($nowPlaying as $movie)
                <x-movie-card class="flex-none w-36 sm:w-48" :id="$movie['id']" :title="$movie['title']" :poster="$movie['poster_path']"
                    :rating="$movie['vote_average']" />
            @endforeach
        </div>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 text-text flex items-center">
            <span class="mr-2">🔥</span> Em Alta Esta Semana
        </h2>

        <div class="flex overflow-x-auto space-x-6 py-4 px-2 custom-scrollbar">
            @foreach ($trending as $movie)
                <x-movie-card class="flex-none w-36 sm:w-48" :id="$movie['id']" :title="$movie['title']" :poster="$movie['poster_path']"
                    :rating="$movie['vote_average']" />
            @endforeach
        </div>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 text-text flex items-center">
            <span class="mr-2">🌟</span> Populares
        </h2>

        <div class="flex overflow-x-auto space-x-6 py-4 px-2 custom-scrollbar">
            @foreach ($popular as $movie)
                <x-movie-card class="flex-none w-36 sm:w-48" :id="$movie['id']" :title="$movie['title']" :poster="$movie['poster_path']"
                    :rating="$movie['vote_average']" />
            @endforeach
        </div>
    </div>



</div>
