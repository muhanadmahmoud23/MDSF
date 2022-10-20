<!DOCTYPE html>
@include('layout.head')

<body>
    @include('layout.sidebar')
    @include('layout.topbar')
    @yield('content')
</body>
@include('layout.js')

</html>
