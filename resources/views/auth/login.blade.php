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
                    <div
                        class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center font-bold text-white text-sm">
                        <img src="{{ asset('images/logo-sena.png') }}" alt="Logo SENA">
                    </div>
                    <span class="text-lg font-semibold tracking-widest text-gray-200">SIGPRO</span>
                </div>

                <div class="mt-16">
                    <span
                        class="text-xs px-4 py-1 rounded-full border border-green-500 text-green-400 inline-flex items-center gap-1">
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
                            <div
                                class="w-8 h-8 rounded-md bg-green-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                                </svg>
                            </div>
                            <p><span class="text-white font-medium">Gestión de proyectos</span> con cronograma Gantt
                                editable</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-md bg-green-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <p><span class="text-white font-medium">Control de equipos</span> con roles de Líder y
                                Miembro</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-md bg-green-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <p><span class="text-white font-medium">Seguimiento en tiempo real</span> del avance de cada
                                fase</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STATS -->
            <div
                class="relative z-10 grid grid-cols-3 gap-4 mt-10 bg-white/5 backdrop-blur-xl p-6 rounded-xl border border-white/10">
                <div class="text-center">
                    <p class="text-2xl font-bold text-green-400">{{ $totalProjects }}</p>
                    <p class="text-xs text-gray-400">PROYECTOS</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-cyan-400">{{ $totalUsers }}</p>
                    <p class="text-xs text-gray-400">USUARIOS</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-green-400">{{ $avgProgress }}%</p>
                    <p class="text-xs text-gray-400">AVANCE</p>
                </div>
            </div>

            <p class="relative z-10 text-xs text-gray-500 mt-6">
                SIGPRO - Sistema de Gestión de Proyectos · 2026
            </p>
        </div>

        <!-- RIGHT LOGIN -->
        <div class="relative flex flex-col items-center justify-center p-6 bg-[#07121c] min-h-screen">

            {{-- Botón Ver Proyectos --}}
            <a href="{{ route('projects.universal-search') }}"
                class="absolute top-6 right-6 flex items-center gap-2 text-xs text-gray-400 hover:text-green-400 border border-white/10 hover:border-green-500/40 px-4 py-2 rounded-lg transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                </svg>
                Ver proyectos
            </a>

            <div class="w-full max-w-md">

                <h2 class="text-3xl font-bold">
                    Bienvenido de <span class="text-green-400">nuevo</span>
                </h2>

                <p class="text-sm text-gray-400 mt-2 mb-8">
                    Ingresa tus credenciales para acceder al sistema de seguimiento académico.
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-5">
                        <label class="text-xs text-gray-500 tracking-widest uppercase block mb-2">
                            Correo Electrónico
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input type="email" name="email" placeholder="usuario@correo.com" value="{{ old('email') }}"
                                class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border border-white/10 focus:border-green-400 outline-none text-sm text-gray-200 placeholder-gray-600 transition">
                        </div>
                        @error('email')
                        <small class="badge badge-outline badge-error w-full mt-2 block">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label class="text-xs text-gray-500 tracking-widest uppercase block mb-2">
                            Contraseña
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input type="password" id="login-password" name="password" placeholder="••••••••"
                                class="w-full pl-10 pr-10 py-3 rounded-lg bg-white/5 border border-white/10 focus:border-green-400 outline-none text-sm text-gray-200 placeholder-gray-600 transition">
                            <button type="button" onclick="toggleLoginPassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition">
                                <svg id="login-eye-open" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="login-eye-closed" class="w-4 h-4 hidden" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.169-3.716M6.53 6.53A9.97 9.97 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.293 5.411M15 12a3 3 0 11-4.243-4.243M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                        <small class="badge badge-outline badge-error w-full mt-2 block">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <!-- Forgot -->
                    <div class="flex justify-between items-center text-sm mb-6">
                        <a href="{{ route('password.request') }}" class="text-green-400 hover:underline text-sm">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full py-3 rounded-lg bg-green-500 hover:bg-green-400 transition font-semibold flex items-center justify-center gap-2 text-[#07121c]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                        Iniciar sesión
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-12 text-center text-xs text-gray-600 space-y-1">
                    <p>¿Problemas para ingresar? Contacta al administrador</p>
                    <p>
                        <a href="mailto:soporte@sigpro.edu.co"
                            class="hover:text-gray-400 transition">soporte@sigpro.edu.co</a>
                        <span class="mx-2">·</span>
                        <a href="#" class="hover:text-gray-400 transition">Política de pol</a>
                    </p>
                </div>
            </div>
        </div>
        {{-- Toast --}}
        <div id="toast" class="fixed top-6 right-6 z-50 hidden" style="min-width: 320px;">
            <div id="toast-inner"
                class="flex items-center gap-3 px-5 py-3 rounded-xl shadow-lg border-l-4 border border-white/5 bg-[#0f1f38]">
                <div id="toast-icon" class="shrink-0"></div>
                <span id="toast-message" class="text-sm flex-1"></span>
                <button onclick="hideToast()" id="toast-close"
                    class="shrink-0 opacity-50 hover:opacity-100 ml-2">✕</button>
            </div>
        </div>
        @php $firstError = $errors->any() ? $errors->first() : null; @endphp


    </div>

    <script>
        function toggleLoginPassword() {
            const input     = document.getElementById('login-password');
            const eyeOpen   = document.getElementById('login-eye-open');
            const eyeClosed = document.getElementById('login-eye-closed');

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }

        const _sessionSuccess = @json(session('success'));
        const _sessionError   = @json(session('error'));
        const _sessionWarning = @json(session('warning'));
        const _sessionInfo    = @json(session('info'));
        const _sessionErrors  = @json($firstError);

        const toastTypes = {
            success: {
                borderColor: '#00C853',
                textColor: '#00C853',
                icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00C853" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>`
            },
            error: {
                borderColor: '#ef4444',
                textColor: '#ef4444',
                icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ef4444" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>`
            },
            warning: {
                borderColor: '#f59e0b',
                textColor: '#f59e0b',
                icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#f59e0b" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>`
            },
            info: {
                borderColor: '#3b82f6',
                textColor: '#3b82f6',
                icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#3b82f6" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>`
            }
        };

        function showToast(message, type) {
            type = type || 'info';
            const cfg = toastTypes[type] || toastTypes.info;
            const toast     = document.getElementById('toast');
            const inner     = document.getElementById('toast-inner');
            const iconEl    = document.getElementById('toast-icon');
            const messageEl = document.getElementById('toast-message');
            const closeBtn  = document.getElementById('toast-close');

            messageEl.textContent = message;
            messageEl.style.color = cfg.textColor;
            iconEl.innerHTML = cfg.icon;
            closeBtn.style.color = cfg.textColor;
            inner.style.borderLeftColor = cfg.borderColor;

            toast.classList.remove('hidden');
            setTimeout(hideToast, 4000);
        }

        function hideToast() {
            document.getElementById('toast').classList.add('hidden');
        }

        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        if (_sessionSuccess) showToast(_sessionSuccess, 'success');
        if (_sessionError)   showToast(_sessionError,   'error');
        if (_sessionErrors)  showToast(_sessionErrors,  'error');
        if (_sessionWarning) showToast(_sessionWarning, 'warning');
        if (_sessionInfo)    showToast(_sessionInfo,    'info');
    </script>
</body>

</html>