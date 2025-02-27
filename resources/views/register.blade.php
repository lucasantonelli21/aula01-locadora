<x-blank>

    <div class="card">
        <div class="card-header">
            <h2 class="text-center">Registre-se</h2>
        </div>
        <form action="{{route('user.save')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Digite seu nome</label>
                    <input class="form-control" type="text" required name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Digite seu email</label>
                    <input class="form-control" type="email" required name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    @php
                        $dateNow = date('Y-m-d');
                        $date = date_create($dateNow);
                        $dateYearsAgo = date_interval_create_from_date_string("10 years");
                        date_sub($date,$dateYearsAgo);
                        $dateTenYearsAgo = date_format($date, "Y-m-d");
                    @endphp

                    <label class="form-label">Data de Nascimento</label>
                    <input class="form-control" type="date" name="birth_date" max='{{$dateTenYearsAgo}}'  min='1950-01-01' required value="{{ old('birth_date') }}"/>
                </div>

                <div class="form-group">
                    <label class="form-label">Cpf</label>
                    <input class="form-control" type="text" name="cpf" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" placeholder="111.111.111-11" required value="{{ old('cpf') }}"/>
                </div>

                <div class="form-group">
                    <label class="form-label">Telefone</label>
                    <input class="form-control" type="tel" name="phone" pattern="[0-9]{2}-[9]{1}[0-9]{4}-[0-9]{4}" placeholder="XX-9XXXX-XXXX" required value="{{ old('phone') }}"/>
                </div>

                <div class="form-group">
                    <label class="form-label">Digite sua senha</label>
                    <input class="form-control" type="password" required name="password" value="">
                </div>
            </div>
            <div class="card-footer">
                <div class='text-end'>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </div>
        </form>
    </div>

</x-blank>
