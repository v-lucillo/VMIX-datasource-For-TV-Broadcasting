<!DOCTYPE html>
<html lang="en">
  <head>
    @include('include.head')
    @yield('style')
  </head>
  <body>

    @include('include.header')

    @yield("content")

@include('include.footer')


  @include('include.script')

  @yield('script')
  </body>
</html>