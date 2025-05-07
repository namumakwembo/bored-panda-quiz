<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800 p-9 max-w-7xl mx-auto">

        <nav >

          <img class="h-32" src="{{ asset('assets/BoredPanda-Logo.png') }}" alt="">
            
        </nav>
      

        {{ $slot }}

        @fluxScripts
    </body>
</html>
