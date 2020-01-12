<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="base-url" content="{{ env('APP_URL') }}" />

    <title>@yield('title') - KPU {{env('APP_KAB')}}</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/nprogress.css')}}" rel="stylesheet">
    <link href="{{asset('css/select2.css')}}" rel="stylesheet">
    <link href="{{asset('css/select2-bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">
    <style>
        #loading-dimmer {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
            position: fixed;
            background-color: rgba(0, 0, 0, .4);
            z-index: 1055;
            /* transition: all 150ms ease-out; */
            overflow: hidden;
        }

        hr{
            width: 100%;
            border: #CFD8DC 1px solid;
        }
    </style>
</head>

@if (Route::currentRouteName() != 'login')

<body id="page-top">

    <div id="loading-dimmer" style="display: none">
        <div class="spinner-grow text-warning" style="width: 5rem; height: 5rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    @include('lay.navbar')
    <div id="wrapper">
        @include('lay.sidebar')
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">{{ucwords(Route::currentRouteName())}}</a>
                    </li>
                    <li class="breadcrumb-item active">Overview</li>
                </ol>
                @yield('main')
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @else

    <body class="bg-dark d-flex justify-content-center align-items-center" style="height: 100vh">
        @yield('main')
        @endif


        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Page level plugin JavaScript-->
        <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('js/sb-admin.min.js')}}"></script>
        <script src="{{asset('js/sw.js')}}"></script>
        <script src="{{asset('js/nprogress.js')}}"></script>
        <script src="{{asset('js/select2.js')}}"></script>
        <script src="{{asset('js/validate.js')}}"></script>

        <!-- Demo scripts for this page-->
        {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
        <script src="{{asset('js/demo/chart-area-demo.js')}}"></script> --}}

        <script src="{{asset('js/f.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script src="{{asset('js/'.Route::currentRouteName().'/'.Route::currentRouteName().'.js')}}"></script>

    </body>

</html>
