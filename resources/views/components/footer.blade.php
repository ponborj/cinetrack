<footer class="bg-surface border-t border-gray-200 dark:border-gray-800 transition-colors duration-300 mt-auto">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between">

            <div class="flex justify-center md:justify-start mb-4 md:mb-0">
                <a href="{{ route('movies.index') }}"
                    class="text-2xl font-bold text-primary hover:text-primaryHover transition">
                    CineTrack
                </a>
            </div>

            <div class="flex flex-col items-center md:items-end text-sm text-textMuted">
                <p>&copy; {{ date('Y') }} CineTrack. Todos os direitos reservados.</p>

                <div class="flex items-center mt-2">
                    <span>Dados de filmes e imagens fornecidos por</span>
                    <a href="https://www.themoviedb.org/" target="_blank" rel="noopener noreferrer"
                        class="ml-1 text-primary font-bold hover:underline">
                        TMDB
                    </a>.
                </div>
            </div>

        </div>
    </div>
</footer>
