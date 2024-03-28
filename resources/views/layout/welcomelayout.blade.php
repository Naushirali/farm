<!doctype html>
<html lang="en">
  <head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','custom login')</title>
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    {{-- @laravelPWA --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    @include('include.welcomeheader')
    @include('include.welcomefooter')



        @yield('content')


    <style>
        .container
        {
            padding-left:0cm;
        }
        </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>


