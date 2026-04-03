<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña - SIGPRO</title>
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
                        SP
                    </div>
                    <span class="text-lg font-semibold tracking-widest text-gray-200">SIGPRO</span>
                </div>

                <div class="mt-16">
                    <span
                        class="text-xs px-4 py-1 rounded-full border border-green-500 text-green-400 inline-flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span> SISTEMA ACTIVO
                    </span>

                    <h2 class="text-6xl font-extrabold leading-tight mt-6">
                        Recupera el <br>
                        <span class="text-green-400">acceso</span> a tu <br>
                        <span class="text-cyan-400">cuenta</span>
                    </h2>

                    <p class="mt-6 text-gray-400 max-w-md text-sm">
                        Ingresa tu correo electrónico y te enviaremos un enlace seguro
                        para restablecer tu contraseña y volver al sistema.
                    </p>

                    <!-- Feature list with icons -->
                    <div class="mt-8 space-y-4 text-sm text-gray-300">

                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-md bg-green-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 11c0-1.657 1.343-3 3-3m0 0c1.657 0 3 1.343 3 3m-3-3v6m0 0H9m3 0v6m-6-6h12" />
                                </svg>
                            </div>
                            <p><span class="text-white font-medium">Recuperación segura</span> mediante enlace enviado a
                                tu correo</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-md bg-green-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <p><span class="text-white font-medium">Protección de datos</span> con validación y cifrado
                                de seguridad</p>
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
                            <p><span class="text-white font-medium">Acceso rápido</span> para continuar con tu gestión
                                académica</p>
                        </div>

                    </div>
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
                    Cambio de <span class="text-green-400">contraseña</span>
                </h2>

                <p class="text-sm text-gray-400 mt-2 mb-8">
                    Ingresa tus credenciales para restablecer tu contraseña.
                </p>
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

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

                            <input type="email" name="email" placeholder="usuario@correo.com"
                                value="{{ request('email') }}"
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

                            <input type="password" id="password" name="password" placeholder="••••••••"
                                class="w-full pl-10 pr-10 py-3 rounded-lg bg-white/5 border border-white/10 focus:border-green-400 outline-none text-sm text-gray-200 placeholder-gray-600 transition">

                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition">
                                <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                        <small class="badge badge-outline badge-error w-full mt-2 block">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label class="text-xs text-gray-500 tracking-widest uppercase block mb-2">
                            Confirmar Contraseña
                        </label>

                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>

                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="••••••••"
                                class="w-full pl-10 pr-10 py-3 rounded-lg bg-white/5 border border-white/10 focus:border-green-400 outline-none text-sm text-gray-200 placeholder-gray-600 transition">

                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition">
                                <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>

                        @error('password_confirmation')
                        <small class="badge badge-outline badge-error w-full mt-2 block">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full py-3 rounded-lg bg-green-500 hover:bg-green-400 transition font-semibold flex items-center justify-center gap-2 text-[#07121c]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                        Restablecer contraseña
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

    </div>
</body>

</html>