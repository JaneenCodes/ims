<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
   

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body class="" style="background-color:#aeb0b879">

        <div class="">
            @if (auth()->check()) 
                @include('layouts.menu')
            @endif
           
            <!-- Page Heading -->
            @isset($header)
                <header class="">
                    <div class="">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            @isset($subtitle)
                <nav class="navbar shadow p-3 mb-5 bg-white border-bottom border-body navbar-expand-lg" data-bs-theme="light">
                    <div class="container">
                        <h2 class="fw-semibold fs-4 text-dark">
                        {!!$subtitle!!}
                        </h2>
                    </div>
                </nav>
            @endisset           

            <!-- Page Content -->
            <main>
               @yield('content')
            </main>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</html>
