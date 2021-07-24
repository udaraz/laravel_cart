<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>

    <link href={{asset('assets/css/back-office/paper-dashboard.css?v=2.0.1')}} rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('custom-css')
</head>

<body class="">
<div class="wrapper ">
    @include('back-office.layout.sidebar')
    <div class="main-panel">
        <!-- Navbar -->
    @include('back-office.layout.header')
    <!-- End Navbar -->
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    @yield('main-content')
                </div>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src={{asset('assets/js/core/jquery.min.js')}}></script>
<script src={{asset('assets/js/core/bootstrap.min.js')}}></script>
<script src={{asset('assets/js/core/popper.min.js')}}></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src={{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}></script>

<script src={{asset('assets/js/back-office/paper-dashboard.js')}} type="text/javascript"></script>

@stack('custom-scripts')
</body>
</html>
