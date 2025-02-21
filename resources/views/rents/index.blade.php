<x-blank>
    <div class="card">

        <div class="card-header">

            <h2 class="title text-center">Alugueis de {{$customer->name}}</h2>

        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-responsive table-striped">
                    <tr>
                    <th>Id do Filme</th>
                    <th>Nome do Filme</th>
                    <th>Dia de Retirada do Filme</th>
                    <th>Dia de Devolução do Filme</th>
                    <th>Preço do Aluguel</th>
                    <th class="text-center">Ações</th>
                    </tr>
                </table>
            </div>

        </div>

        <div class="card-footer">

        </div>

    </div>
</x-blank>

{{-- @foreach ($movies as $movie)
    <div class="mb-5">
        <span>Alugou {{$movie->name}}</span> <br>
        <span>No valor de {{$movie->pivot->price}}</span> <br>
        <span>No dia {{$movie->pivot->pickup_date}}</span> <br>
    </div>
@endforeach --}}
