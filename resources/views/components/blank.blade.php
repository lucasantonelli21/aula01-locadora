<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Locadora Sysout</title>


</head>

<body>

    <div class="container">

        @include('components.nav')

        @include('components.alert')

        {{ $slot }}

    </div>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.min.css') }}" />
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script type="module" src="{{asset('assets/js/scripts.min.js')}}"></script>

</body>

</html>
