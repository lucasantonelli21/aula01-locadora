<x-blank>
    <div class="card">

        <div class="card-header">

            <h2 class="title text-center">Alugueis de {{ $customer->name }}</h2>

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
                    @foreach ($customer->movies as $movie )
                        <tr>
                            <td>{{$movie->id}}</td>
                            <td>{{$movie->name}}</td>
                            <td>{{date('d-m-Y', strtotime($movie->pivot->pickup_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($movie->pivot->return_date))}}</td>
                            <td>{{$movie->pivot->price}}</td>
                            <td>
                                <div class="table-buttons">

                                    <form action="{{route('customer.rent.formEdit', [$customer->id, $movie->pivot->id])}}">
                                        <button type="submit" class="btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                              </svg>
                                        </button>
                                    </form>
                                    @if (Auth::user()->is_admin)
                                        <form action="{{ route('customer.rent.delete', [$customer->id, $movie->pivot->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                    <path
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>


                    @endforeach
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
