<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
</html>

</body>
</html>
<div x-data="{ show: false, message: '', type: 'success' }" x-init="
        @if(session('success'))
            show = true;
            message = '{{ session('success') }}';
            type = 'success';
            setTimeout(() => show = false, 4000);
        @endif
        @if(session('error'))
            show = true;
            message = '{{ session('error') }}';
            type = 'error';
            setTimeout(() => show = false, 4000);
        @endif

        @if($errors->any())
            show = true;
            message = '{{ $errors->first() }}';
            type = 'error';
            setTimeout(() => show = false, 4000);
        @endif
    " x-show="show" x-transition class="fixed top-6 right-6 z-50"  x-cloak>
    <div class="flex items-center gap-3 px-5 py-3 rounded-xl shadow-lg border" :class="type === 'success' 
            ? 'bg-green-500/10 border-green-500 text-green-400' 
            : 'bg-red-500/10 border-red-500 text-red-400'">

        <!-- ICONO -->
        <div>
            <template x-if="type === 'success'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>

            </template>
            <template x-if="type === 'error'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </template>
        </div>

        <!-- MENSAJE -->
        <span x-text="message"></span>

        <!-- CERRAR -->
        <button @click="show = false"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

</body>
</html>
