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

                <!-- Roles -->
                <p class="text-xs text-gray-500 tracking-widest mb-3 uppercase">Ingresar como</p>
                <div class="flex gap-3 mb-7">
                    <!-- LÍDER -->
                    <button id="btn-lider" class="role-btn flex-1 flex items-center gap-3 py-3 px-4 rounded-xl bg-green-500/10 border border-green-500 text-left transition">

                        <div id="icon-lider-box" class="w-8 h-8 rounded-lg bg-green-500/20 flex items-center justify-center flex-shrink-0">
                            <svg id="icon-lider" class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p id="text-lider" class="text-green-400 font-semibold text-sm">Líder</p>
                            <p class="text-gray-500 text-xs">Gestión completa</p>
                        </div>
                    </button>

                    <!-- MIEMBRO -->
                    <button id="btn-miembro" class="role-btn flex-1 flex items-center gap-3 py-3 px-4 rounded-xl bg-white/5 border border-white/10 text-left transition hover:border-white/20">

                        <div id="icon-miembro-box" class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0">
                            <svg id="icon-miembro" class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p id="text-miembro" class="text-gray-300 font-semibold text-sm">Miembro</p>
                            <p class="text-gray-500 text-xs">Acceso al equipo</p>
                        </div>
                    </button>
                </div>

                <form method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="mb-5">
                        <label class="text-xs text-gray-500 tracking-widest uppercase block mb-2">Correo Electrónico</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input type="email" placeholder="usuario@correo.com" class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border border-white/10 focus:border-green-400 outline-none text-sm text-gray-200 placeholder-gray-600 transition">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label class="text-xs text-gray-500 tracking-widest uppercase block mb-2">Contraseña</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input type="password" id="password" placeholder="••••••••" class="w-full pl-10 pr-10 py-3 rounded-lg bg-white/5 border border-white/10 focus:border-green-400 outline-none text-sm text-gray-200 placeholder-gray-600 transition">
                            <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition">
                                <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="flex justify-between items-center text-sm mb-6">
                        <label class="flex items-center gap-2 text-gray-400 cursor-pointer">
                            <input type="checkbox" class="accent-green-500 w-4 h-4 rounded">
                            Recordarme
                        </label>

                        <a href="#" class="text-green-400 hover:underline text-sm">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <!-- Submit -->
                    <a class="w-full py-3 rounded-lg bg-green-500 hover:bg-green-400 transition font-semibold flex items-center justify-center gap-2 text-[#07121c]" href="{{ url('dashboard') }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                        Iniciar sesión
                    </a>
                </form>

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

    <script>
        const btnLider = document.getElementById('btn-lider');
        const btnMiembro = document.getElementById('btn-miembro');

        const iconLider = document.getElementById('icon-lider');
        const iconMiembro = document.getElementById('icon-miembro');

        const iconBoxLider = document.getElementById('icon-lider-box');
        const iconBoxMiembro = document.getElementById('icon-miembro-box');

        const textLider = document.getElementById('text-lider');
        const textMiembro = document.getElementById('text-miembro');

        function activarLider() {
            // Botón
            btnLider.classList.add('bg-green-500/10', 'border-green-500');
            btnLider.classList.remove('bg-white/5', 'border-white/10');

            btnMiembro.classList.remove('bg-green-500/10', 'border-green-500');
            btnMiembro.classList.add('bg-white/5', 'border-white/10');

            // Icon box
            iconBoxLider.classList.add('bg-green-500/20');
            iconBoxLider.classList.remove('bg-white/10');

            iconBoxMiembro.classList.remove('bg-green-500/20');
            iconBoxMiembro.classList.add('bg-white/10');

            // SVG
            iconLider.classList.add('text-green-400');
            iconLider.classList.remove('text-gray-400');

            iconMiembro.classList.remove('text-green-400');
            iconMiembro.classList.add('text-gray-400');

            // Texto
            textLider.classList.add('text-green-400');
            textLider.classList.remove('text-gray-300');

            textMiembro.classList.remove('text-green-400');
            textMiembro.classList.add('text-gray-300');
        }

        function activarMiembro() {
            // Botón
            btnMiembro.classList.add('bg-green-500/10', 'border-green-500');
            btnMiembro.classList.remove('bg-white/5', 'border-white/10');

            btnLider.classList.remove('bg-green-500/10', 'border-green-500');
            btnLider.classList.add('bg-white/5', 'border-white/10');

            // Icon box
            iconBoxMiembro.classList.add('bg-green-500/20');
            iconBoxMiembro.classList.remove('bg-white/10');

            iconBoxLider.classList.remove('bg-green-500/20');
            iconBoxLider.classList.add('bg-white/10');

            // SVG
            iconMiembro.classList.add('text-green-400');
            iconMiembro.classList.remove('text-gray-400');

            iconLider.classList.remove('text-green-400');
            iconLider.classList.add('text-gray-400');

            // Texto
            textMiembro.classList.add('text-green-400');
            textMiembro.classList.remove('text-gray-300');

            textLider.classList.remove('text-green-400');
            textLider.classList.add('text-gray-300');
        }

        btnLider.addEventListener('click', activarLider);
        btnMiembro.addEventListener('click', activarMiembro);

    </script>

</body>
</html>
