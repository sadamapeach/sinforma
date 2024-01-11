<!DOCTYPE html>
<html lang="en"> 
    {{-- means languagenya english --}}
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="assets/logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- menyesuaikan tampilan @device --}}
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SIPRESMA | @yield('title')</title>

        {{-- link untuk akses bootstrap and js --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        <script type="text/javascript" src="{{ asset('assets') }}/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets') }}/js/bootstrap.js"></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        {{-- font --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">

        {{-- Reference Tailwind Flowbite --}}
        @vite(['resources/css/app.css','resources/js/app.js'])  
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    </head>

    <body>   
        <div class="body">
            @include('sidebar.mahasiswa')
            @include('content')
        </div>
    </body>
</html>