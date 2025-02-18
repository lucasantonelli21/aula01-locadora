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

<x-blank>

    <div class="container">

        <div class="card">

            <div class="card-header">

                <h2 class="text-center">Crie um novo Cliente</h2>

            </div>



            <div class="card-body">


                <div class="radio-row">
                </div>    <form class="form" action="{{route('customer.save')}}" method="post">

                    @csrf

                    <div class="form-group">
                        <label class="form-label">Nome do Cliente</label>
                        <input class="form-control" type="text" name="name" minlength="3" required value="{{old('name')}}"/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">E-mail</label>
                        <input class="form-control" type="email" name="email" minlength="5" required value="{{old('email')}}"/>
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
                        <input class="form-control" type="date" name="birth_date" max='{{$dateTenYearsAgo}}'  min= '1950-01-01'required value="{{old('birth_date')}}"/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Cpf</label>
                        <input class="form-control" type="text" name="cpf" required pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" placeholder="111.111.111-11" value="{{old('cpf')}}"/>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Telefone</label>
                        <input class="form-control" type="tel" name="phone" required pattern="[0-9]{2}-[9]{1}[0-9]{4}-[0-9]{4}" placeholder="XX-9XXXX-XXXX" value="{{old('phone')}}"/>
                    </div>

                    <div class="form-group-radio">
                        <label class="form-label">Inadimplência</label>
                        <div class="radio-row">
                            <label class="form-label">Sim</label>
                            <input class="form-radio" type="radio" required name="able" value="1"/>
                            <label class="form-label">Não</label>
                            <input class="form-radio" type="radio" required name="able" value="0"/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>

            </div>

        </div>
    </div>

</x-blank>
