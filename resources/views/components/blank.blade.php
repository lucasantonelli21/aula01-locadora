<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Locadora Sysout</title>

    <style>

        .table-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .card-header .card-row{
            display: flex;
            justify-content: space-between;
        }

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

        .form-group-filter{
            display: flex;
            flex-direction: row;
        }


    </style>

</head>

<body>

    <div class="container">

        @include('components.nav')

        @include('components.alert')

        {{ $slot }}

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="{{asset('js/aula1.js')}}"></script>

</body>

</html>
