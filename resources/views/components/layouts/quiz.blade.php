<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>Interview Test-Bored Panda</title>
        
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        @fluxAppearance
        

    </head>
    <body class="h-screen bg-white dark:bg-zinc-900  ">

        <div class="max-w-7xl px-9 mx-auto  flex flex-col">

        <nav  class="flex items-center  justify-between">

          <a href="/">
            <img class="h-28 dark:invert " src="{{ asset('assets/BoredPanda-Logo.png') }}" alt="">
        </a>

          <h1 class="text-gray-400 ">Interview test</h1>
            
        </nav>
      

        <div class="w-full  mx-auto">

            {{ $slot }}
        </div>


        <footer class="mt-3">
           <a class="text-sm text-gray-300" href="https://github.com/namumakwembo/bored-panda-quiz"> @namumakwembo</a>
        </footer>
    </div>

        @livewireScriptConfig
        @fluxScripts
    </body>
</html>
