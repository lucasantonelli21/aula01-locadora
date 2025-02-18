<x-blank>

    <div class="card">

        <div class="card-header">

            <h2 class="text-center">Filmes</h2>

        </div>

       @include('components.table-movies',[
        'movies' => $movies
       ])

    </div>

</x-blank>
