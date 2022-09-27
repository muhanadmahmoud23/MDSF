@include('layout.head')
@include('layout.topbar')
@include('layout.sidebar')
@include('layout.preloader')
@include('layout.js')
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link href="{{ asset('assets/kendou/examples/content/shared/styles/examples-offline.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/kendou/styles/kendo.common.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/kendou/styles/kendo.rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/kendou/styles/kendo.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/kendou/styles/kendo.default.mobile.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/kendou/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/kendou/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/kendou/js/kendo.all.min.js') }}"></script>
    <script src="{{ asset('assets/kendou/examples/content/shared/js/console.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.4.0/jszip.min.js"></script>
</head>

@yield('content')
@include('layout.footer')
