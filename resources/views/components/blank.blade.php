<!DOCTYPE html>
<html lang="en">

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

        .card-header {
            position: relative;
        }

        .card-header a.btn {
            position: absolute;
            top: 20%;
            right: 15px;
        }

        .filter{
            display: flex;
            position: absolute;
            top: 20%;
            left: 15px;
            gap: 10px;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</body>

</html>
