<x-blank>


    <div class="page-form-rent card">

        <div class="card-header">

            <h2 class="title text-center">Aluguel do filme: {{ $movie->name }}</h2>

        </div>

        <form class="form" action="{{ route('movie.rent.save', $movie->id) }}" method="post">
            @csrf
            <div class="card-body">

                <input class="form-control" type="hidden" name="movie_id" value="{{ $movie->id }}" />
                @if (Auth::user()->is_admin)
                    <div class="form-group">
                        <label class="form-label">Insira seu email</label>
                        <select required class="form-control select2" id="select2" name="customer_email"></select>
                    </div>
                @endif

                <div class="form-group">
                    @php
                        $dateNow = date('Y-m-d');
                        $dateTomorrow = now()->addDays(1)->format('Y-m-d');
                    @endphp
                    <label class="form-label">Data para Retirada do Filme</label>
                    <input class="form-control" type="date" required name="pickup_date"
                        value="{{ $dateNow }}" />
                </div>

                <div class="form-group">
                    <label class="form-label">Data para Devolução do Filme</label>
                    <input class="form-control" type="date" min="{{ $dateTomorrow }}" required name="return_date"
                        value="{{ $dateTomorrow }}" />
                </div>

            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">Alugar</button>
            </div>

        </form>

    </div>

</x-blank>
