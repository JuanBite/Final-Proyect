<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#0A1628] text-[#E8F4FF]">

    @include('layouts.sidebar')

    <div class="ml-60 min-h-screen flex flex-col">
        @include('layouts.topbar')

        <main class="p-8 flex flex-col gap-6 flex-1">
            @yield('content')
        </main>
    </div>

</body>
</html>