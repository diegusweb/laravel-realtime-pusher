<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome CSS -->
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- laravel css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    <!-- BEGIN CSS for this page -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>

    <!-- END CSS for this page -->

</head>

<body class="adminbody">

    <div id="main">

        @auth
            @include('partials.'.auth()->user()->role.'.navigation')
            @include('partials.'.auth()->user()->role.'.sidebar')
        @else
            @include('partials.guest.navigation')
            @include('partials.guest.sidebar')
        @endauth

        <div class="content-page">

            <!-- Start content -->
            <div class="content">

                <div class="container-fluid">

                    @if(session('message'))
                        <div class="pt-4 pb-4">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="alert alert-{{ session('message')[0] }}">
                                        <h4 class="alert-heading">{{ __("Mensaje informativo") }}</h4>
                                        <p>{{ session('message')[1] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @yield('content')

                </div>
                <!-- END container-fluid -->

            </div>
            <!-- END content -->

        </div>
        <!-- END content-page -->

        @include('partials.footer')
    </div>
    <!-- END main -->

    @include('partials.scripts')

</body>
</html>