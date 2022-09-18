@include('layout.head')

<body>

    @include('layout.topbar')
    @include('layout.sidebar')

    @yield('content')

    @include('layout.footer')
    @include('layout.preloader')
    @include('layout.js')
    
</body>

</html>
