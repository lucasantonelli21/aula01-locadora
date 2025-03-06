<x-blank>
    <div class="card-header">
        <h1 class="text-center mt-5 fw-bold">Bem-Vindo! Por favor realize o Login!</h1>
    </div>
    <div class="card-body">
        <form action="{{route('user.authenticate')}}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Digite seu e-mail</label>
                <input class="form-control" type="email" required name="email" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label class="form-label">Digite sua senha</label>
                <input class="form-control" type="password" required name="password" value="">
            </div>
            <div class='text-center'>
                <button type="submit" class="btn btn-success">Logar</button>
                <a type="button" href="{{route('user.register')}}" class="btn btn-primary">Registrar</a>
            </div>
        </form>
    </div>
    <div class="card-footer"></div>
</x-blank>
