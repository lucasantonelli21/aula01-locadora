@php
    $route = 'customer.home';
    $needParameter = false;
    $homeRoute = '/dashboard';
    if (Auth::user()) {
        if (!Auth::user()->is_admin) {
            $route = 'customer.rent.home';
            $homeRoute = '/home';
            $needParameter = true;
            $customerId = Auth::user()->customer_id;
        }
    }
@endphp

<div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ Auth::check() ? $homeRoute : '/' }}">Locadora da Sysout</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('movie.home') }}">Filmes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ $needParameter ? route($route, [$customerId]) : route($route) }}">{{ $needParameter ? 'Meus Alugueis' : 'Clientes' }}</a>
                    </li>
                </ul>
            </div>
        </div>
        @if (Auth::check())
            <div class="login-row">
                <a href="{{ route('user.profile') }}" class='login-title'>Bem-Vindo {{ Auth::user()->name }}! Clique
                    aqui para visualizar seu perfil!</a>
                <form action="{{ route('user.logout') }}"><button class='btn btn-dark'>Logout</button></form>
            </div>
        @endif
    </nav>
</div>
