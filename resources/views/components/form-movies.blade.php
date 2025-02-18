<style>

    .form-group {
        margin-bottom: 15px;
    }
    .form-group-radio {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }

    .radio-row{
        display: flex;
        flex-direction: row;
    }

    .form-label {
        font-weight: 500;
    }
    .form-radio{
        margin: 10px 10px;
    }

</style>

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
            <option value="action">Ação</option>
            <option value="adventure">Aventura</option>
            <option value="horror">Terror</option>
            <option value="romance">Romance</option>
            <option value="mistery">Misterio</option>
            <option value="comedy">Comedia</option>
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
        <input class="form-control" type="date" required max="{{$dateNow}}" name="release_date" value="{{old('release_date')}}">
    </div>

    <div class="form-group">
        <label class="form-label">Descrição</label>
        <textarea class="form-control" type="text" required minlength="100" name="description" value="{{old('description')}}"></textarea>
    </div>

    <div class="form-group-radio">
        <label class="form-label">Sou Fã?</label>
        <div class="radio-row">
            <label class="form-label">Sim</label>
            <input class="form-radio" required type="radio" name="is_fan" value="1"/>
            <label class="form-label">Não</label>
            <input class="form-radio" required type="radio" name="is_fan" value="0"/>
        </div>
    </div>


    <button type="submit" class="btn btn-primary">Salvar</button>

</form>
