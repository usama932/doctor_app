
@php
if(!empty(Session::get('locale')))
    {
        app()->setLocale(Session::get('locale'));
        if( Session::has('locale') == 'ar' )

        {
            echo "<!DOCTYPE html>";
            echo ' <html lang="ar" dir="rtl" direction="rtl" style="direction:rtl;" >';
        }

    }

    else{
         app()->setLocale('en');
         echo "<!DOCTYPE html>";
         echo '  <html lang="en">';
    }
@endphp<!-- Main Wrapper -->

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
