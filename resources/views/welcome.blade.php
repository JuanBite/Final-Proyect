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
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center font-bold text-white text-sm">
                        SP
                    </div>
                    <span class="text-lg font-semibold tracking-widest text-gray-200">SIGPRO</span>
                </div>

                <div class="mt-16">
                    <span class="text-xs px-4 py-1 rounded-full border border-green-500 text-green-400 inline-flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span> SISTEMA ACTIVO
                    </span>

                    <h2 class="text-6xl font-extrabold leading-tight mt-6">
                        Sistema de <br>
                        <span class="text-green-400">Gestión</span> de <br>
                        <span class="text-cyan-400">Proyectos</span>
                    </h2>

                    <p class="mt-6 text-gray-400 max-w-md text-sm">
                        Gestiona proyectos de grado, monitorea el avance de tu equipo
                        y visualiza cronogramas Gantt en tiempo real.
                    </p>

                    <!-- Feature list with icons -->
                    <div class="mt-8 space-y-4 text-sm text-gray-300">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-md bg-green-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                                </svg>
                            </div>
                            <p><span class="text-white font-medium">Gestión de proyectos</span> con cronograma Gantt editable</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-md bg-green-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <p><span class="text-white font-medium">Control de equipos</span> con roles de Líder y Miembro</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-md bg-green-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <p><span class="text-white font-medium">Seguimiento en tiempo real</span> del avance de cada fase</p>
                        </div>
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
        <div class="flex flex-col items-center justify-center p-6 bg-[#07121c]">

            <div class="w-full max-w-md">

                <h2 class="text-3xl font-bold">
                    Bienvenido de <span class="text-green-400">nuevo</span>
                </h2>

                <p class="text-sm text-gray-400 mt-2 mb-8">
                    Ingresa tus credenciales para acceder al sistema de seguimiento académico.
                </p>

                @include('auth.login')

                <!-- Footer -->
                <div class="mt-12 text-center text-xs text-gray-600 space-y-1">
                    <p>¿Problemas para ingresar? Contacta al administrador</p>
                    <p>
                        <a href="mailto:soporte@sigpro.edu.co" class="hover:text-gray-400 transition">soporte@sigpro.edu.co</a>
                        <span class="mx-2">·</span>
                        <a href="#" class="hover:text-gray-400 transition">Política de pol</a>
                    </p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
