<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <title>Test Pasante PHP Jr</title>
</head>
<body>
    <script src="{{ asset('js/all.js') }}"></script>
    {{$slot}}

</body>
</html>
