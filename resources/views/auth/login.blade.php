<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email -->
    <div class="mb-5">
        <label class="text-xs text-gray-500 tracking-widest uppercase block mb-2">Correo Electrónico</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </span>
            <input type="email" name="email" placeholder="usuario@correo.com" value="{{ old('email') }}" "
                class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/5 border border-white/10 focus:border-green-400 outline-none text-sm text-gray-200 placeholder-gray-600 transition">
                @error('email')
                <small class="badge badge-outline badge-error w-full h-full">{{ $message }}</small>
                @enderror
        </div>
    </div>

    <!-- Password -->
    <div class="mb-6">
        <label class="text-xs text-gray-500 tracking-widest uppercase block mb-2">Contraseña</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </span>
            <input type="password" id="password" name="password" placeholder="••••••••"
                class="w-full pl-10 pr-10 py-3 rounded-lg bg-white/5 border border-white/10 focus:border-green-400 outline-none text-sm text-gray-200 placeholder-gray-600 transition">
                @error('password')
                <small class="  badge badge-outline badge-error w-full  h-full">{{ $message }}</small>
                @enderror
            <button type="button" onclick="togglePassword()"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition">
                <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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

        <a href="{{ route('password.request') }}" class="text-green-400 hover:underline text-sm">
            ¿Olvidaste tu contraseña?
        </a>
    </div>

    <!-- Submit -->
    <a class="w-full py-3 rounded-lg bg-green-500 hover:bg-green-400 transition font-semibold flex items-center justify-center gap-2 text-[#07121c]"
        href="">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
        </svg>
        Iniciar sesión
    </a>
</form>