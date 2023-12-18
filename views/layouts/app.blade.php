<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <title>{{ config('app.name', '') }} @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/app.css" />
    @yield('stylesheets')

    <script type='text/javascript'>
@yield('javascript')
    </script>

    @yield('header')
</head>
<body class="body">
    @yield('content')
</body>
</html>
