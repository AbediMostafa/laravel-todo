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
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <div id="kt_header" style="" class="header align-items-stretch">
                    <div class="container-fluid d-flex align-items-stretch justify-content-center">
                        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                 id="kt_aside_mobile_toggle">
                            </div>
                        </div>
                        <div class="d-flex align-items-stretch justify-content-center flex-lg-grow-1 custom-nav">
                            <div class="d-flex align-items-stretch">
                                <div class="header-menu align-items-stretch">
                                    <div
                                        class="menu menu-lg-rounded fs-4 menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                                    >
                                        <div class="menu-item menu-lg-down-accordion me-lg-1">
												<span class="menu-link py-3">
                                                    <a class="menu-title" href="/tasks">Tasks</a>
												</span>

                                        </div>
                                        <div class="menu-item  menu-lg-down-accordion me-lg-1">
												<span class="menu-link py-3">
                                                    <a class="menu-title" href="/labels">Labels</a>
												</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-stretch flex-shrink-0">
                                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                    <!--begin::Menu wrapper-->
                                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                                         data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                         data-kt-menu-placement="bottom-end">
                                        <span class="menu-link py-3">
                                            @yield('username')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')
</div>

</body>
</html>
