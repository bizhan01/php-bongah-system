<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:image" content="http://demo.eaccount.xyz/asset/layout/images/1.jpg" />
    <meta property="og:description" content="" />
    <meta property="og:url"content="" />
    <meta property="og:title" content="e-Real Estate - Property Management with Complete Accounts" />


    <title>@yield('title', 'خوش آمدید | '.Config::get('settings.company_name'))</title>

    <link rel="icon" href="{{ asset(Config::get('settings.company_logo') ) }}" type="image/x-icon">


    <link rel="stylesheet" type="text/css" href="{{ asset('asset/layout/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/layout/fonts/iconic/css/material-design-iconic-font.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('asset/css/e-bootstrap.min.css') }}">


    {{--Utility Css--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/layout/css/util.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('asset/layout/css/main.css') }}">



</head>
<body>

<div>
    @yield('auth-body')
</div>

<!-- Jquery Core Js -->
<script src="{{ asset('asset/layout/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('asset/layout/js/main.js') }}"></script>

</body>
</html>
