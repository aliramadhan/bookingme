<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="https://cdn.tailwindcss.com"></script>

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <!-- script for livewire alert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts />
        <script type="text/javascript">
          @if(Session::has('success'))
          Swal.fire({
            titleText: "{{ session('success') }}",
            icon: 'success',
            position: 'center', 
            timer: 3000,
            toast: false,
            showConfirmButton: false,
          });
          @endif
          @if(Session::has('failure'))
          Swal.fire({
            titleText: "{{ session('failure') }}",
            icon: 'error',
            position: 'center', 
            timer: 3000,
            toast: false,
            showConfirmButton: false,
          });
          @endif
          @if($errors->any())
          Swal.fire({
            titleText: "{{ implode('', $errors->all(':message')) }}",
            icon: 'error',
            position: 'center', 
            timer: 3000,
            toast: false,
            showConfirmButton: false,
          });
          @endif
        </script>
    </body>
</html>
