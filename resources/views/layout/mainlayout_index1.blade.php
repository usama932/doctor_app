<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.partials.head')
    @stack('styles')
</head>
<body>
@yield('content')
@include('layout.partials.footer_index5')
@include('layout.partials.footer-scripts')
@stack('scripts')
</body>
</html>
