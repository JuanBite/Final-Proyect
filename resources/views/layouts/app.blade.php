<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
@stack('scripts')

<body class="bg-[#0A1628] text-[#E8F4FF]">

    @include('layouts.sidebar')

    <div class="ml-60 min-h-screen flex flex-col">
        @include('layouts.topbar')

        <main class="p-8 flex flex-col gap-6 flex-1">
            @yield('content')
        </main>
    </div>

</body>
</html>iv>

</body>
</html>iv>

</body>
</html>