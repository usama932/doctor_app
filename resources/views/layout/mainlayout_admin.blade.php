
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


<html @if($lang == 'ar') lang="ar" dir="rtl" direction="rtl" style="direction:rtl;" @endif>

  <head>
    @include('layout.partials.head_admin')
  </head>

  <body>
    @include('layout.partials.header_admin')
    @include('layout.partials.nav_admin')

    @yield('content')
    @include('layout.partials.footer_admin-scripts')
  </body>
</html>
