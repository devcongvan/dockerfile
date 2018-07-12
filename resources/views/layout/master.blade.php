<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ERP | @yield('title')</title>
    <base href="{{asset('public')}}">
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css"> -->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">


    <link rel="stylesheet" type="text/css" href="css/main2.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('layout.navbar')

    @include('layout.sidebar')

    @yield('content')

    @include('layout.footer')

</div>
<!-- ./wrapper -->


<!-- jQuery -->





{{--<script src="js/main.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script src="js/main2.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
@yield('script')

</body>
</html>
