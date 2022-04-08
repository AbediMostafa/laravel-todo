<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todo Package</title>

    <!-- Styles -->
    <link href="{{ asset('vendor/todo/css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/todo/css/element.css') }}" rel="stylesheet">
{{--    <link href="vendor/todo/css/fonts.css" rel="stylesheet">--}}
{{--    <link href="vendor/todo/css/element.css" rel="stylesheet">--}}
    <!-- Styles -->

    <!-- Scripts -->
    <script src="{{ asset('/vendor/todo/js/vue.js') }}"></script>
    <script src="{{ asset('/vendor/todo/js/element.js') }}"></script>
{{--    <script src="/vendor/todo/js/vue.js"></script>--}}
{{--    <script src="/vendor/todo/js/element.js"></script>--}}
    <!-- Scripts -->
</head>
<body>
<div>
    @yield('content')
</div>

</body>
</html>
