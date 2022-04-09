<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Todo Package</title>

    <!-- Styles -->
    <link href="{{ asset('vendor/todo/css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/todo/css/element.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/todo/css/style.css') }}" rel="stylesheet">
    <!-- Styles -->

    <!-- Scripts -->
    <script src="{{ asset('/vendor/todo/js/vue.js') }}"></script>
    <script src="{{ asset('/vendor/todo/js/element.js') }}"></script>
    <script src="{{ asset('/vendor/todo/js/axios.js') }}"></script>
    <script src="{{ asset('/vendor/todo/js/helpers.js') }}"></script>
    <!-- Scripts -->
</head>
<body id="kt_body" class="bg-body">
<div id="app">
    @yield('content')
</div>

</body>
</html>
