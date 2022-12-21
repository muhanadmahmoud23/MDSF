@include('layout.head')

<body>
    @include('layout.sidebar')
    @yield('content')
    @include('layout.js')
</body>

</html>