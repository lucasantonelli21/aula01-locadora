<x-blank>
    <div class="card">

        <div class="card-header">

            <h2 class="title text-center">Adicionar dias de aluguel do filme: {{ $movie->name }}</h2>

        </div>

        <form class="form" action="{{ route('customer.rent.update', [$customer->id, $rent->id]) }}" method="post">
            @method('PUT')
            @csrf
            <div class="card-body">


                <div class="form-group">
                    <label class="form-label">Usuário</label>
                    <input class="form-control" readonly type="text" required name="customer_name" minlength="3"
                        value="{{ $customer->name }}" />
                </div>

                <div class="form-group">
                    @php
                        $returnDate = Carbon\Carbon::parse($rent->return_date);
                        $dateTomorrow = $returnDate->addDays(1)->format('Y-m-d');
                    @endphp
                    <label class="form-label">Data para Retirada do Filme</label>
                    <input class="form-control" readonly type="date" required name="pickup_date"
                        value="{{ $rent->pickup_date }}" />
                </div>

                <div class="form-group">
                    <label class="form-label">Nova data para Devolução do Filme</label>
                    <input class="form-control" type="date" min="{{ $rent->return_date }}" required
                        name="return_date" value="{{ $dateTomorrow }}" />
                </div>

            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-success">Atualizar Data</button>
            </div>
        </form>
    </div>
</x-blank>
