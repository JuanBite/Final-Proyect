<div
    class="w-[560px] max-w-full bg-[#111D30] border border-[#00C853]/15 rounded-3xl overflow-hidden shadow-[0_32px_80px_rgba(0,0,0,0.5)] flex flex-col max-h-[90vh]">

    <!-- FORM -->
    <form action="{{ route('users.store') }}" method="POST" class="flex flex-col flex-1 min-h-0">
        @csrf

        <!-- Header -->
        <div
            class="relative px-8 pt-7 pb-6 border-b border-[#00C853]/15 bg-[#00C853]/[0.03] flex items-center gap-4 shrink-0">
            <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#40C4FF] to-[#00C853]"></div>
            <div
                class="w-12 h-12 rounded-2xl bg-[#40C4FF]/10 border border-[#40C4FF]/25 flex items-center justify-center text-[#40C4FF] shrink-0">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <line x1="19" y1="8" x2="19" y2="14" />
                    <line x1="22" y1="11" x2="16" y2="11" />
                </svg>
            </div>
            <div>
                <div class="font-syne font-extrabold text-[22px] text-[#E8F4FF]">Crear <span
                        class="text-[#40C4FF]">Usuario</span></div>
                <div class="text-[13px] text-[#8AAABB] mt-0.5">Registra un nuevo usuario en el sistema</div>
            </div>
            <button type="button" @click="$dispatch('close-create-modal'); document.body.style.overflow='';"
                class="absolute top-5 right-5 w-9 h-9 bg-[#182236] border border-[#00C853]/15 rounded-xl flex items-center justify-center text-[#8AAABB] hover:text-[#E8F4FF] transition-colors cursor-pointer">
                ✕
            </button>
        </div>

        <!-- Body -->
        <div
            class="px-8 py-6 flex flex-col gap-6 overflow-y-auto flex-1 min-h-0 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-[#0d1726] [&::-webkit-scrollbar-thumb]:bg-[#2a3a52] [&::-webkit-scrollbar-thumb]:rounded-full">
            <!-- Datos personales -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Datos personales</span>
                    <div class="flex-1 h-px bg-[#00C853]/15"></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Nombre <span
                                class="text-[#40C4FF]">*</span></label>
                        <input name="first_name"
                            class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none"
                            type="text" placeholder="Ej: Luis Miguel" required />
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Apellido <span
                                class="text-[#40C4FF]">*</span></label>
                        <input name="last_name"
                            class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none"
                            type="text" placeholder="Ej: Muñoz" required />
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Documento <span
                                class="text-[#40C4FF]">*</span></label>
                        <input name="document"
                            class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none"
                            type="text" placeholder="Ej: 10025***" required />
                    </div>
                    {{-- REGIÓN — solo ADMIN elige, REGIONAL_ADMIN se arrastra automáticamente --}}
                    @if(auth()->user()->isAdmin())
                    <div class="col-span-2 grid grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label
                                class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Región</label>
                            <select name="region_id" id="select-region"
                                class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none"
                                onchange="filterCentersByRegion(this.value)">
                                <option value="">— Sin región —</option>
                                @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Centro de formación</label>
                            <select name="center_id" id="select-center"
                                class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none">
                                <option value="0">— Sin centro —</option>
                                @foreach($centers as $center)
                                <option value="{{ $center->id }}" data-region="{{ $center->region_id }}">
                                    {{ $center->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @elseif(auth()->user()->isRegionalAdmin())
                    {{-- REGIONAL_ADMIN: región fija, elige centro de su regional --}}
                    <input type="hidden" name="region_id" value="{{ auth()->user()->region_id }}">
                    <div class="col-span-2 flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">
                            Centro de formación <span class="text-[#40C4FF]">*</span>
                        </label>
                        <select name="center_id" required
                            class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none">
                            <option value="">— Selecciona un centro —</option>
                            @foreach($centers as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    {{-- FICHA — opcional para ADMIN, oculta para REGIONAL_ADMIN (se asigna después) --}}
                    @if(!auth()->user()->isRegionalAdmin())
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">
                            Ficha @if(!auth()->user()->isAdmin())<span class="text-[#40C4FF]">*</span>@endif
                        </label>
                        <select name="cohort_id"
                            class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none"
                            {{ auth()->user()->isAdmin() ? '' : 'required' }}>
                            <option value="">— Sin ficha —</option>
                            @foreach($cohorts as $cohort)
                            <option value="{{ $cohort->id }}">{{ $cohort->program_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="col-span-2 flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Correo
                            electrónico <span class="text-[#40C4FF]">*</span></label>
                        <input name="email"
                            class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none"
                            type="email" placeholder="usuario@correo.com" required />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">
                            Contraseña <span class="text-[#40C4FF]">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <input name="password" id="password"
                                class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none pr-10"
                                type="password" placeholder="••••••••" required />
                            <button type="button"
                                onclick="togglePassword('password', 'eye-password-open', 'eye-password-closed')"
                                class="absolute right-3 text-[#8AAABB] hover:text-[#40C4FF] transition-colors">
                                {{-- Ojo abierto --}}
                                <svg id="eye-password-open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{-- Ojo cerrado --}}
                                <svg id="eye-password-closed" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.169-3.716M6.53 6.53A9.97 9.97 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.293 5.411M15 12a3 3 0 11-4.243-4.243M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">
                            Confirmar contraseña <span class="text-[#40C4FF]">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <input name="password_confirmation" id="password_confirmation"
                                class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none pr-10"
                                type="password" placeholder="••••••••" required />
                            <button type="button"
                                onclick="togglePassword('password_confirmation', 'eye-confirm-open', 'eye-confirm-closed')"
                                class="absolute right-3 text-[#8AAABB] hover:text-[#40C4FF] transition-colors">
                                {{-- Ojo abierto --}}
                                <svg id="eye-confirm-open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{-- Ojo cerrado --}}
                                <svg id="eye-confirm-closed" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.169-3.716M6.53 6.53A9.97 9.97 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.293 5.411M15 12a3 3 0 11-4.243-4.243M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rol -->
            <div x-data="{ selectedRole: 'STUDENT' }">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Rol en el sistema</span>
                    <div class="flex-1 h-px bg-[#00C853]/15"></div>
                </div>
                <input type="hidden" name="role" :value="selectedRole">
                <div class="grid grid-cols-3 gap-3">

                    {{-- INSTRUCTOR — visible para todos --}}
                    <div @click="selectedRole = 'INSTRUCTOR'"
                        :class="selectedRole === 'INSTRUCTOR' ? 'border-green-500/30 bg-green-500/10' : 'border-[#00C853]/15 bg-[#182236]'"
                        class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                        <div class="flex justify-center mb-1.5">
                            <svg class="w-6 h-6 text-[#00C853]" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <div class="font-syne font-bold text-xs text-[#00C853]">INSTRUCTOR</div>
                        <div class="text-[10px] text-[#8AAABB] mt-1">Gestiona y dirige</div>
                    </div>

                    {{-- APRENDIZ — visible para todos --}}
                    <div @click="selectedRole = 'STUDENT'"
                        :class="selectedRole === 'STUDENT' ? 'border-blue-500/30 bg-blue-500/10' : 'border-[#00C853]/15 bg-[#182236]'"
                        class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                        <div class="flex justify-center mb-1.5">
                            <svg class="w-6 h-6 text-[#40C4FF]" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                        </div>
                        <div class="font-syne font-bold text-xs text-[#40C4FF]">APRENDIZ</div>
                        <div class="text-[10px] text-[#8AAABB] mt-1">Participa</div>
                    </div>

                    {{-- COORDINADOR — visible para todos --}}
                     @if(!auth()->user()->isCoordinator())
                    <div @click="selectedRole = 'COORDINATOR'"
                        :class="selectedRole === 'COORDINATOR' ? 'border-blue-500/40 bg-blue-600/15' : 'border-blue-500/15 bg-[#182236]'"
                        class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                        <div class="flex justify-center mb-1.5">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 5.25h16.5v13.5H3.75V5.25z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.75h16.5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 14.25h3" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 14.25h1.5" />
                            </svg>
                        </div>
                        <div class="font-syne font-bold text-xs text-blue-400">COORDINADOR</div>
                        <div class="text-[10px] text-[#8AAABB] mt-1">Coordina</div>
                    </div>
                    @endif


                    {{-- REGIONAL ADMIN — solo ADMIN --}}
                    @if(auth()->user()->isAdmin())
                    <div @click="selectedRole = 'REGIONAL_ADMIN'"
                        :class="selectedRole === 'REGIONAL_ADMIN' ? 'border-purple-500/30 bg-purple-500/10' : 'border-[#00C853]/15 bg-[#182236]'"
                        class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                        <div class="flex justify-center mb-1.5">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                            </svg>
                        </div>
                        <div class="font-syne font-bold text-xs text-purple-400">REGIONAL ADMIN</div>
                        <div class="text-[10px] text-[#8AAABB] mt-1">Gestiona regional</div>
                    </div>

                    {{-- ADMIN — solo ADMIN --}}
                    <div @click="selectedRole = 'ADMIN'"
                        :class="selectedRole === 'ADMIN' ? 'border-yellow-500/30 bg-yellow-500/10' : 'border-[#00C853]/15 bg-[#182236]'"
                        class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                        <div class="flex justify-center mb-1.5">
                            <svg class="w-6 h-6 text-[#FFD740]" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <div class="font-syne font-bold text-xs text-[#FFD740]">ADMIN</div>
                        <div class="text-[10px] text-[#8AAABB] mt-1">Administra</div>
                    </div>
                    @endif

                </div>
            </div>

            <!-- Proyectos -->
            <div x-data="projectAssignerCreate()">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Asignar a proyectos</span>
                    <div class="flex-1 h-px bg-[#00C853]/15"></div>
                </div>
                <div class="flex flex-col gap-2">

                    <!-- Inputs ocultos -->
                    <template x-for="id in selected" :key="id">
                        <input type="hidden" name="projects[]" :value="id">
                    </template>

                    <!-- Buscador custom -->
                    <div class="relative" x-data="{ open: false, search: '' }" @click.outside="open = false">

                        <!-- Input de búsqueda -->
                        <div @click="open = true"
                            class="w-full bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] flex items-center gap-2 cursor-pointer transition-all"
                            :class="open ? 'border-[#00C853]/40' : ''">
                            <svg class="w-3.5 h-3.5 text-[#8AAABB] shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8" />
                                <path d="M21 21l-4.35-4.35" />
                            </svg>
                            <input type="text" x-model="search" @click.stop="open = true"
                                placeholder="Buscar proyecto..."
                                class="bg-transparent outline-none text-[#E8F4FF] placeholder-[#8AAABB] text-[13.5px] w-full">
                            <svg class="w-3.5 h-3.5 text-[#8AAABB] shrink-0 transition-transform"
                                :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        <!-- Dropdown -->
                        <div x-show="open" x-transition
                            class="absolute z-50 w-full mt-1 bg-[#182236] border border-[#00C853]/20 rounded-xl overflow-hidden shadow-xl">

                            <!-- Lista filtrada -->
                            <div
                                class="max-h-48 overflow-y-auto [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-[#0d1726] [&::-webkit-scrollbar-thumb]:bg-[#2a3a52] [&::-webkit-scrollbar-thumb]:rounded-full">
                                <template
                                    x-for="project in projects.filter(p => p.name.toLowerCase().includes(search.toLowerCase()) && !selected.includes(p.id))"
                                    :key="project.id">
                                    <div @click="addProject(project.id); open = false; search = ''"
                                        class="px-3.5 py-2.5 text-[13px] text-[#E8F4FF] hover:bg-[#00C853]/10 cursor-pointer flex items-center gap-2 transition-all">
                                        <div class="w-6 h-6 rounded-md bg-[#00C853]/20 border border-[#00C853]/30 flex items-center justify-center text-[9px] text-[#00C853] font-bold shrink-0"
                                            x-text="project.name.substring(0, 2).toUpperCase()"></div>
                                        <span x-text="project.name"></span>
                                    </div>
                                </template>

                                <!-- Sin resultados -->
                                <div x-show="projects.filter(p => p.name.toLowerCase().includes(search.toLowerCase()) && !selected.includes(p.id)).length === 0"
                                    class="px-3.5 py-4 text-[12px] text-[#8AAABB] italic text-center">
                                    No se encontraron proyectos
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Proyectos seleccionados -->
                    <div class="flex flex-wrap gap-2 mt-2">
                        <template x-for="project in selectedProjects" :key="project.id">
                            <div
                                class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#182236] border border-[#00C853]/15">
                                <div class="w-[26px] h-[26px] rounded-lg bg-[#00C853] flex items-center justify-center text-[9px] text-black font-bold"
                                    x-text="getInitials(project.name)"></div>
                                <span class="text-[12.5px]" x-text="project.name"></span>
                                <button type="button" @click="removeProject(project.id)"
                                    class="ml-2 text-red-400 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                            </div>
                        </template>
                        <div x-show="selectedProjects.length === 0" class="text-[12px] text-[#8AAABB] italic py-2">
                            No hay proyectos asignados
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="px-8 py-5 border-t border-[#00C853]/15 flex justify-end gap-2.5 shrink-0">
            <button type="button" @click="$dispatch('close-create-modal'); document.body.style.overflow='';"
                class="flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium text-[#8AAABB] bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all hover:bg-[#182236]/80">
                Cancelar
            </button>
            <button type="submit"
                class="flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium bg-[#40C4FF] text-[#0A1628] cursor-pointer transition-all hover:bg-[#40C4FF]/90">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Crear usuario
            </button>
        </div>

    </form>
    <script>
        function filterCentersByRegion(regionId) {
    const centerSelect = document.getElementById('select-center');
    const options = centerSelect.querySelectorAll('option');

    options.forEach(opt => {
        if (!opt.value) return; // opción vacía siempre visible
        opt.style.display = (!regionId || opt.dataset.region == regionId) ? '' : 'none';
    });

    // Reset selección si el centro actual no pertenece a la nueva región
    if (regionId && centerSelect.value) {
        const selected = centerSelect.querySelector(`option[value="${centerSelect.value}"]`);
        if (selected && selected.dataset.region != regionId) {
            centerSelect.value = '';
        }
    }
}
        function projectAssignerCreate() {
    return {
        projects: @json($projects),
        selected: [],

        get selectedProjects() {
            return this.projects.filter(project => this.selected.includes(project.id));
        },

        addProject(id) {
            if (!id) return;
            if (!this.selected.includes(id)) {
                this.selected.push(id);
            }
        },

        removeProject(id) {
            this.selected = this.selected.filter(p => p !== id);
        },

        getInitials(name) {
            return name.substring(0, 2).toUpperCase();
        }
    }
}
function togglePassword(inputId, eyeOpenId, eyeClosedId) {
    const input     = document.getElementById(inputId);
    const eyeOpen   = document.getElementById(eyeOpenId);
    const eyeClosed = document.getElementById(eyeClosedId);

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

    </script>
</div>