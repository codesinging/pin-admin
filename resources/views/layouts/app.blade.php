<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', admin_config('name'))</title>
    <link rel="shortcut icon" href="{{ admin_asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ admin_mix('app.css') }}">
    @yield('style')
    <script>
        let baseUrl = '{{ $baseData['baseUrl'] }}'
        let csrfToken = '{{ csrf_token() }}'
    </script>
    @yield('header')
</head>
<body>
<script src="{{ admin_mix('app.js') }}"></script>
@yield('content')
@yield('footer')
</body>
</html>