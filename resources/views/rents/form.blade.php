<x-blank>
    <div class="card">

        <div class="card-header">

            <h2 class="title text-center">Aluguel do filme: {{$movie->name}}</h2>

        </div>

        <div class="card-body">

            <form class="form" action="{{route('movie.rent.save',$movie->id)}}" method="post">

                @csrf

                <input class="form-control" type="hidden" name="movie_id" value="{{$movie->id}}"/>

                <div class="form-group">
                    <label class="form-label">Insira seu email</label>
                    <input class="form-control" type="email" required name="customer_email" minlength="3" value="{{old('customer_email')}}"/>
                </div>

                <div class="form-group">
                    @php
                        $dateNow = date('Y-m-d');
                        $dateTomorrow = now()->addDays(1)->format('Y-m-d');
                    @endphp
                    <label class="form-label">Data para Retirada do Filme</label>
                    <input class="form-control" type="date" required name="pickup_date" value="{{$dateNow}}">
                </div>

                <div class="form-group">
                    <label class="form-label">Data para Devolução do Filme</label>
                    <input class="form-control" type="date" min="{{$dateTomorrow}}" required name="return_date" value="{{$dateTomorrow}}">
                </div>



                <button type="submit" class="btn btn-success">Alugar</button>

            </form>

        </div>

        <div class="card-footer">

        </div>

    </div>
</x-blank>
