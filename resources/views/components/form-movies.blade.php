

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

<form class="form" action="{{ route('movie.save') }}" method="post">

    @csrf

    <div class="form-group">
        <label class="form-label">Nome do Filme</label>
        <input class="form-control" type="text" name="name" required minlength="3" value="{{old('name')}}"/>
    </div>

    <div class="form-group">
        <label class="form-label">Categoria</label>
        <select required class="form-control" name="category">
            <option value="">Selecione uma opção</option>
            @foreach ($categories as $key => $category)
                <option value="{{$key}}" {{ old('category') == $key ? 'selected' : '' }} >{{$category}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="form-label">Faixa Etária</label>
        <input class="form-control" type="number" required  min="10" name="age_indication" value="{{old('age_indication')}}">
    </div>

    <div class="form-group">
        <label class="form-label">Duração</label>
        <input class="form-control" type="number" min="60" required name="duration" value="{{old('duration')}}">
    </div>

    <div class="form-group">
        @php
            $dateNow = date('Y-m-d');
        @endphp
        <label class="form-label">Data de Lançamento</label>
        <input class="form-control" type="date"  required max="{{$dateNow}}" name="release_date" value="{{old('release_date')}}">
    </div>

    <div class="form-group">
        <label class="form-label">Descrição</label>
        <textarea class="form-control" type="text" required minlength="100" name="description">{{old('description')}}</textarea>
    </div>

    <div class="form-group-radio">
        <label class="form-label">Sou Fã?</label>
        <div class="radio-row">
            <label class="form-label">Sim</label>
            <input class="form-radio" required type="radio" @checked(old('is_fan') == 1) name="is_fan" value="1"/>
            <label class="form-label">Não</label>
            <input class="form-radio" required type="radio" @checked(old('is_fan') == 0) name="is_fan" value="0"/>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>

</form>
