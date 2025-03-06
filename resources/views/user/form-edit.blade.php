<x-blank>
    <div class="page-profile-edit card">
        <div class="card-header">
            <h2 class="text-center">Perfil de {{ Auth::user()->name }}</h2>
        </div>
        <form action="{{route('user.update')}}" method="POST">
            @csrf
            @method("PUT")
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input class="form-control" type="email" name="email"
                        value="{{ old('email') ? old('email') : Auth::user()->email }}" />
                </div>

                <div class="form-group">
                    <label class="form-label">Cpf</label>
                    <input class="form-control" type="text" name="cpf"
                        pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" placeholder="111.111.111-11" required
                        value="{{ old('cpf') ? old('cpf') : $customer->cpf }}" />
                </div>

                <div class="form-group">
                    <label class="form-label">Telefone</label>
                    <input class="form-control" type="tel" name="phone" pattern="[0-9]{2}-[9]{1}[0-9]{4}-[0-9]{4}"
                        placeholder="XX-9XXXX-XXXX" required
                        value="{{ old('phone') ? old('phone') : $customer->phone }}" />
                </div>

                <div class="form-group">
                    <div class="form-check form-switch">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Deseja Alterar sua Senha?</label>
                        <input class="form-check-input render-password" @checked(old('show_password') ? true : false) type="checkbox" name="show_password"
                            role="switch" id="flexSwitchCheckDefault">
                    </div>
                </div>

                <div class="password-box form-group {{ old('show_password') ? '' : 'd-none'}} ">
                    <div class="d-flex flex-row "">
                        <input class="new-password form-control" placeholder="Digite sua nova senha aqui" type="password"
                            name="new_password" value="{{old('new_password')}}" />

                        <span class="invalid-text d-none">É necessário colocar uma senha válida</span>

                        <input class="password-confirmation form-control" placeholder="Confirme a nova senha" type="password"
                            name="password_confirmation" value="{{old('password_confirmation')}}" />

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class=" img-check bi bi-check2" viewBox="0 0 16 16">
                            <path
                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                        </svg>

                    </div>

                    <input class="password form-control" placeholder="Confirme sua antiga senha" type="password" name="password" value="{{old("password")}}" />
                </div>


            </div>
            <div class="card-footer text-end">
                <button type="submit" class="submit-edit btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

</x-blank>
