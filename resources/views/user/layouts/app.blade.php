<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponorogo Dreamland - @yield('title', 'Kuliner, Tradisi, Rekreasi')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@400;700&display=swap"
        rel="stylesheet">

    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo-nobg.png') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('style')
    @stack('style')
</head>

<body class="font-sans text-gray-700 antialiased bg-light selection:bg-primary selection:text-white">

    @include('user.layouts.header')

    @yield('content')

    @include('user.layouts.footer')


    @include('user.layouts.scripts.app')
    @yield('script')
    @stack('script')
</body>

</html>
