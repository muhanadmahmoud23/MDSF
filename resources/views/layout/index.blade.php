<!DOCTYPE html>
@include('layout.head')

<body>
    @include('layout.sidebar')
    @include('layout.topbar')
    @yield('content')
    @include('layout.footer')
</body>
@include('layout.js')

</html>
