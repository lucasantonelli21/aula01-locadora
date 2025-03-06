@php
    $categories = [
        "action" => 'Ação',
        "adventure" => 'Aventura',
        "horror" => 'Terror',
        "romance" => 'Romance',
        "mistery" => 'Misterio',
        "comedy" => 'Comedia'
    ];
@endphp

<x-blank>
    <div class="container">

        <div class="card">

            <div class="card-header">

                <h2 class="text-center">Atualizando o filme {{$movie->id}}</h2>

            </div>

            <div class="card-body">

                <form class="form" action="{{ route('movie.update', $movie->id) }}" method="post">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Nome do Filme</label>
                        <input class="form-control" type="text" name="name" minlength="3" value="{{$movie->name}}"/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Categoria</label>
                        <select class="form-control" name="category">
                            <option value="">Selecione uma opção</option>
                            @foreach ($categories as $key => $category)
                                <option value="{{$key}}" {{ $movie->category == $key ? 'selected' : '' }} >{{$category}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Faixa Etária</label>
                        <input class="form-control" type="number"  min="10" name="age_indication" value="{{$movie->age_indication}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Duração</label>
                        <input class="form-control" type="number" min="60" name="duration" value="{{$movie->duration}}">
                    </div>

                    <div class="form-group">
                        @php
                            $dateNow = date('Y-m-d');
                        @endphp
                        <label class="form-label">Data de Lançamento</label>
                        <input class="form-control" type="date"  max="{{$dateNow}}" name="release_date" value="{{$movie->release_date}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Descrição</label>
                        <textarea class="form-control" type="text" minlength="100" name="description">{{$movie->description}}</textarea>
                    </div>

                    <div class="form-group-radio">
                        <label class="form-label">Sou Fã?</label>
                        <div class="radio-row">
                            <label class="form-label">Sim</label>
                            <input class="form-radio" type="radio" @checked($movie->is_fan == 1) name="is_fan" value="1"/>
                            <label class="form-label">Não</label>
                            <input class="form-radio" type="radio" @checked($movie->is_fan == 0) name="is_fan" value="0"/>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>

                </form>

            </div>

        </div>

    </div>
</x-blank>
