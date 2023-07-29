<!DOCTYPE html>

@php

if(!empty(Session::get('locale')))
    {
        $lang = Session::get('locale');
        app()->setLocale(Session::get('locale'));
    }

    else{
         app()->setLocale('en');
    }
@endphp
<html lang="en"></html>
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
