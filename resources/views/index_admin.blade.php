<!DOCTYPE html>
<html> 
    {{-- means languagenya english --}}
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo_ver2.png') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- menyesuaikan tampilan @device --}}
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SINFORMA | @yield('title')</title>

        {{-- link untuk akses bootstrap and js --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        <script type="text/javascript" src="{{ asset('assets') }}/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets') }}/js/bootstrap.js"></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        {{-- font --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">

        {{-- <style>
            body {
                background-color: #3498db; /* Ganti dengan kode warna yang diinginkan */
                color: #fff; /* Ganti dengan warna teks yang kontras */
            }
        </style> --}}
    </head>

    <body>
        <div class="body" style="background-color: #fff">
            @include('sidebar.admin')
            @include('content')
        </div>
    </body>
</html>