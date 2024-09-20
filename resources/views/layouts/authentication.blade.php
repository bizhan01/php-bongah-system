<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php $ApplicationName = Config::get('settings.company_name'); ?>

    <title>@yield('title', 'Welcome To | '.$ApplicationName)</title>

    <?php $image = Config::get('settings.company_logo') ?>

    <link rel="icon" href="{{ asset($image ) }}" type="image/x-icon">
    <!-- Google Fonts -->

    <link href="{{ asset('asset/css/font-g/font-1.css') }}" rel="stylesheet"
          type="text/css">

    <link href="{{ asset('asset/css/font-g/icon-1.css') }}" rel="stylesheet" type="text/css">



    <!-- Bootstrap Core Css -->
    <link href="{{ asset('asset/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('asset/plugins/node-waves/waves.css') }}" rel="stylesheet"/>

    <!-- Animation Css -->
    <link href="{{ asset('asset/plugins/animate-css/animate.css') }}" rel="stylesheet"/>

    <!-- Custom Css -->
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">

    {{--Utility Css--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/layout/css/util.css') }}">



</head>

<body class="login-page">
<div class="login-box">
    @yield('auth-body')
</div>

<!-- Jquery Core Js -->
<script src="{{ asset('asset/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('asset/plugins/node-waves/waves.js') }}"></script>

<!-- Validation Plugin Js -->
<script src="{{ asset('asset/plugins/jquery-validation/jquery.validate.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('asset/js/admin.js') }}"></script>
<script src="{{ asset('asset/js/pages/examples/sign-in.js') }}"></script>
</body>

</html>
