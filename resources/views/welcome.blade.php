<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - SIGPRO</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#07121c] min-h-screen text-white font-sans">

<div class="grid grid-cols-1 lg:grid-cols-2 min-h-screen">

    <!-- LEFT -->
    <div class="relative flex flex-col justify-between p-12 overflow-hidden">

        <!-- fondo blur -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#0b1d2a] via-[#0b2a3a] to-[#07121c]"></div>
        <div class="absolute inset-0 backdrop-blur-3xl opacity-60"></div>

        <div class="relative z-10">
            <h1 class="text-xl font-semibold tracking-widest text-gray-300">
                <span class="text-green-400 btn btn-default">SP</span> SIGPRO
            </h1>

            <div class="mt-24">
                <span class="text-xs px-4 py-1 rounded-full border border-green-500 text-green-400">
                    ● SISTEMA ACTIVO
                </span>

                <h2 class="text-6xl font-extrabold leading-tight mt-6">
                    Sistema de <br>
                    <span class="text-green-400">Gestión</span> de <br>
                    <span class="text-cyan-400">Proyectos</span>
                </h2>

                <p class="mt-6 text-gray-400 max-w-md">
                    Gestiona proyectos de grado, monitorea el avance de tu equipo
                    y visualiza cronogramas Gantt en tiempo real.
                </p>

                <div class="mt-8 space-y-3 text-sm text-gray-300">
                    <p>✔ Gestión de proyectos con cronograma Gantt editable</p>
                    <p>✔ Control de equipos con roles de Líder y Miembro</p>
                    <p>✔ Seguimiento en tiempo real del avance</p>
                </div>
            </div>
        </div>

        <!-- STATS -->
        <div class="relative z-10 grid grid-cols-3 gap-4 mt-10 bg-white/5 backdrop-blur-xl p-6 rounded-xl border border-white/10">
            <div class="text-center">
                <p class="text-2xl font-bold text-green-400">5</p>
                <p class="text-xs text-gray-400">PROYECTOS</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-bold text-cyan-400">6</p>
                <p class="text-xs text-gray-400">USUARIOS</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-bold text-green-400">58%</p>
                <p class="text-xs text-gray-400">AVANCE</p>
            </div>
        </div>

        <p class="relative z-10 text-xs text-gray-500 mt-6">
            SIGPRO - Sistema de Gestión de Proyectos · 2026
        </p>
    </div>

    <!-- RIGHT LOGIN -->
    <div class="flex items-center justify-center p-6">

        <div class="w-full max-w-md bg-white/5 backdrop-blur-2xl border border-white/10 p-8 rounded-2xl shadow-2xl">

            <h2 class="text-2xl font-bold">
                Bienvenido de <span class="text-green-400">nuevo</span>
            </h2>

            <p class="text-sm text-gray-400 mt-2 mb-6">
                Ingresa tus credenciales para acceder al sistema.
            </p>

            <!-- Roles -->
            <div class="flex gap-2 mb-6">
                <button class="flex-1 py-2 rounded-lg bg-green-500/20 text-green-400 border border-green-500">
                    Líder
                </button>
                <button class="flex-1 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-300">
                    Miembro
                </button>
            </div>

            <form method="POST">
                @csrf

                <div class="mb-4">
                    <input type="email" placeholder="usuario@correo.com"
                        class="w-full p-3 rounded-lg bg-white/5 border border-white/10 focus:border-green-400 outline-none">
                </div>

                <div class="mb-4">
                    <input type="password"
                        class="w-full p-3 rounded-lg bg-white/5 border border-white/10 focus:border-green-400 outline-none">
                </div>

                <div class="flex justify-between items-center text-sm mb-6">
                    <label class="flex items-center gap-2 text-gray-400">
                        <input type="checkbox" class="accent-green-500">
                        Recordarme
                    </label>

                    <a href="#" class="text-green-400 hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>

                <button class="w-full py-3 rounded-lg bg-green-500 hover:bg-green-400 transition font-semibold">
                    Iniciar sesión
                </button>
            </form>
        </div>
    </div>

</div>

</body>
</html>