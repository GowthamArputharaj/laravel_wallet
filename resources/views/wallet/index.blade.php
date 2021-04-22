<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"> --}}

        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> --}}
         
        <script src="{{ assets('js/jquery.min.js') }}"></script>

        <link rel="stylesheet" href="{{ assets('css/bootstrap.min.css') }}">

        <script src="{{ assets('js/bootstrap.bundle.min.js') }}"></script>


    </head>
    <body class="antialiased">
        <div id="app">
        </div>
    </body>
</html>
