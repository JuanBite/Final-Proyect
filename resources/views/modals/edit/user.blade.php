<div x-data="projectAssignerEdit_{{ $user->id }}()" key="{{ $user->id }}">
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="redirect_to" value="{{ request()->routeIs('users.show') ? 'show' : 'index' }}">
        <div
            class="w-[620px] max-w-[90vw] max-h-[90vh] bg-[#111D30] border border-[#40C4FF]/15 rounded-3xl overflow-hidden shadow-[0_32px_80px_rgba(0,0,0,0.5),0_0_0_1px_rgba(64,196,255,0.08)] flex flex-col">

            <!-- Header - Fijo -->
            <div
                class="relative px-8 pt-7 pb-6 border-b border-[#40C4FF]/15 bg-[#40C4FF]/[0.03] flex items-center gap-4 shrink-0 pr-16">
                <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#40C4FF] to-[#00C853]"></div>
                <div
                    class="w-12 h-12 rounded-2xl bg-[#40C4FF]/12 border border-[#40C4FF]/25 flex items-center justify-center text-[#40C4FF] shrink-0 font-bold text-lg">
                    {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-syne font-extrabold text-[22px] text-[#E8F4FF]">Editar <span
                            class="text-[#40C4FF]">Usuario</span></div>
                    <div class="text-[13px] text-[#8AAABB] mt-0.5">Modifica los datos del usuario seleccionado</div>
                </div>
                <!-- Badge modo edición -->
                <div
                    class="ml-auto flex items-center gap-1.5 bg-[#40C4FF]/08 border border-[#40C4FF]/20 rounded-lg px-3 py-1.5 text-[11px] text-[#40C4FF] shrink-0">
                    <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Modo edición
                </div>
                <!-- Botón cerrar -->
                <button type="button" @click="$dispatch('close-edit-modal'); document.body.style.overflow='';"
                    class="absolute top-5 right-5 w-9 h-9 bg-[#182236] border border-[#40C4FF]/15 rounded-xl flex items-center justify-center text-[#8AAABB] hover:text-[#E8F4FF] transition-colors">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>


            <!-- Body -->
            <div
                class="px-8 py-6 flex flex-col gap-6 overflow-y-auto flex-1 min-h-0 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-[#0d1726] [&::-webkit-scrollbar-thumb]:bg-[#2a3a52] [&::-webkit-scrollbar-thumb]:rounded-full">
                <div class="flex flex-col gap-6">

                    <!-- Datos personales -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Datos personales</span>
                            <div class="flex-1 h-px bg-[#40C4FF]/15"></div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">

                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Nombre
                                    <span class="text-[#40C4FF]">*</span></label>
                                <input
                                    class="form-input bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#40C4FF]/40"
                                    type="text" name="first_name" required placeholder="Ej: Luis Miguel"
                                    value="{{ $user->first_name }}" />
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Apellido
                                    <span class="text-[#40C4FF]">*</span></label>
                                <input
                                    class="form-input bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#40C4FF]/40"
                                    type="text" name="last_name" required placeholder="Ej: Muñoz"
                                    value="{{ $user->last_name }}" />
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Documento
                                    <span class="text-[#40C4FF]">*</span></label>
                                <input
                                    class="form-input bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#40C4FF]/40"
                                    type="text" name="document" required placeholder="Ej: 10025***"
                                    value="{{ $user->document }}" />
                            </div>

                            {{-- REGIÓN — solo ADMIN elige, REGIONAL_ADMIN se arrastra automáticamente --}}
                            @if(auth()->user()->isAdmin())
                            <div class="col-span-2 grid grid-cols-2 gap-4">
                                <div class="flex flex-col gap-1.5">
                                    <label
                                        class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Región</label>
                                    <select name="region_id" id="select-region-{{ $user->id }}"
                                        class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none"
                                        onchange="filterCentersByRegion(this.value, {{ $user->id }})">
                                        <option value="">— Sin región —</option>
                                        @foreach($regions as $region)
                                        <option value="{{ $region->id }}" {{ $user->region_id == $region->id ?
                                            'selected' : '' }}>
                                            {{ $region->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label
                                        class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Centro
                                        de
                                        formación</label>
                                    <select name="center_id" id="select-center-{{ $user->id }}"
                                        class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none"
                                        onchange="filterCohortsByCenter(this.value, {{ $user->id }})">
                                        <option value="0">— Sin centro —</option>
                                        @foreach($centers as $center)
                                        <option value="{{ $center->id }}" data-region="{{ $center->region_id }}" {{
                                            $user->center_id == $center->id ? 'selected' : '' }}>
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
                                <select name="center_id" id="select-center-{{ $user->id }}" required
                                    onchange="filterCohortsByCenter(this.value, {{ $user->id }})"
                                    class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none">
                                    <option value="">— Selecciona un centro —</option>
                                    @foreach($centers as $center)
                                    <option value="{{ $center->id }}">{{ $center->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            {{-- FICHA — multi-select estilo teamSelector --}}
                            @if(!auth()->user()->isRegionalAdmin()||!auth()->user()->isCoordinator())
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">
                                    Ficha @if(!auth()->user()->isAdmin() )<span class="text-[#40C4FF]">*</span>@endif
                                </label>

                                <div x-data="cohortSelector()">

                                    <select name="cohort_id" id="select-cohort-{{ $user->id }}"
                                        @change="addCohort($event)"
                                        class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all">
                                        <option value="">— Seleccionar ficha —</option>
                                        @foreach($cohorts as $cohort)
                                        <option value="{{ $cohort->id }}" data-center="{{ $cohort->center_id }}"
                                            data-name="{{ $cohort->cohort_number }}">
                                            {{ $cohort->cohort_number }}
                                        </option>
                                        @endforeach
                                    </select>


                                    <!-- INPUTS OCULTOS -->
                                    <template x-for="id in selected" :key="id">
                                        <input type="hidden" name="cohort_ids[]" :value="id">
                                    </template>

                                    <!-- FICHAS SELECCIONADAS -->
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        <template x-for="cohort in selectedCohorts" :key="cohort.id">
                                            <div
                                                class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#182236] border border-[#00C853]/15">

                                                <!-- Iniciales -->
                                                <div class="w-[26px] h-[26px] rounded-lg bg-[#00C853] flex items-center justify-center text-[9px] text-black font-bold"
                                                    x-text="cohort.name.substring(0, 2).toUpperCase()">
                                                </div>

                                                <!-- Nombre -->
                                                <span class="text-[12.5px]" x-text="cohort.name"></span>

                                                <!-- Botón eliminar -->
                                                <button type="button" @click="removeCohort(cohort.id)"
                                                    class="ml-2 text-red-400 hover:text-red-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                    </div>

                                </div>
                            </div>
                            @endif

                            {{-- Email --}}
                            <div class="col-span-2 flex flex-col gap-1.5">
                                <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Correo
                                    electrónico <span class="text-[#40C4FF]">*</span></label>
                                <input
                                    class="form-input bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#40C4FF]/40"
                                    type="email" name="email" required placeholder="usuario@correo.com"
                                    value="{{ $user->email }}" />
                            </div>

                            {{-- Contraseña --}}
                            <div class="flex flex-col gap-1.5">
                                <label
                                    class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Contraseña</label>
                                <div class="relative flex items-center">
                                    <input
                                        class="form-input bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#40C4FF]/40 pr-10"
                                        type="password" name="password" id="edit-password" placeholder="••••••••" />
                                    <button type="button"
                                        onclick="togglePassword('edit-password', 'eye-edit-open', 'eye-edit-closed')"
                                        class="absolute right-3 text-[#8AAABB] hover:text-[#40C4FF] transition-colors">
                                        <svg id="eye-edit-open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg id="eye-edit-closed" xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.169-3.716M6.53 6.53A9.97 9.97 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.293 5.411M15 12a3 3 0 11-4.243-4.243M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                                <span class="text-[10px] text-[#8AAABB]">Dejar vacío para mantener la contraseña
                                    actual</span>
                            </div>

                            {{-- Confirmar contraseña --}}
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Confirmar
                                    contraseña</label>
                                <div class="relative flex items-center">
                                    <input
                                        class="form-input bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#40C4FF]/40 pr-10"
                                        type="password" name="password_confirmation" id="edit-password-confirm"
                                        placeholder="••••••••" />
                                    <button type="button"
                                        onclick="togglePassword('edit-password-confirm', 'eye-edit-confirm-open', 'eye-edit-confirm-closed')"
                                        class="absolute right-3 text-[#8AAABB] hover:text-[#40C4FF] transition-colors">
                                        <svg id="eye-edit-confirm-open" xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg id="eye-edit-confirm-closed" xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.169-3.716M6.53 6.53A9.97 9.97 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.293 5.411M15 12a3 3 0 11-4.243-4.243M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Sección: Rol en el sistema -->
                    <div x-data="{ selectedRole: 'STUDENT' }">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Rol en el sistema</span>
                            <div class="flex-1 h-px bg-[#00C853]/15"></div>
                        </div>
                        <input type="hidden" name="role" :value="selectedRole">
                        <div class="grid grid-cols-3 gap-3">
                            {{-- REGIONAL ADMIN — solo ADMIN --}}
                            @if(auth()->user()->isAdmin())


                            {{-- ADMIN — solo ADMIN --}}
                            <div @click="selectedRole = 'ADMIN'"
                                :class="selectedRole === 'ADMIN' ? 'border-yellow-500/30 bg-yellow-500/10' : 'border-[#00C853]/15 bg-[#182236]'"
                                class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                                <div class="flex justify-center mb-1.5">
                                    <svg class="w-6 h-6 text-[#FFD740]" fill="none" stroke="currentColor"
                                        stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </div>
                                <div class="font-syne font-bold text-xs text-[#FFD740]">ADMIN</div>
                                <div class="text-[10px] text-[#8AAABB] mt-1">Administra</div>
                            </div>
                            <div @click="selectedRole = 'REGIONAL_ADMIN'"
                                :class="selectedRole === 'REGIONAL_ADMIN' ? 'border-purple-500/30 bg-purple-500/10' : 'border-[#00C853]/15 bg-[#182236]'"
                                class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                                <div class="flex justify-center mb-1.5">
                                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor"
                                        stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                                    </svg>
                                </div>
                                <div class="font-syne font-bold text-xs text-purple-400">REGIONAL ADMIN</div>
                                <div class="text-[10px] text-[#8AAABB] mt-1">Gestiona regional</div>
                            </div>
                            @endif
                            {{-- COORDINADOR — visible para todos --}}
                            @if(!auth()->user()->isCoordinator())
                            <div @click="selectedRole = 'COORDINATOR'"
                                :class="selectedRole === 'COORDINATOR' ? 'border-blue-500/40 bg-blue-600/15' : 'border-blue-500/15 bg-[#182236]'"
                                class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                                <div class="flex justify-center mb-1.5">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor"
                                        stroke-width="1.8" viewBox="0 0 24 24">
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
                            @if(!auth()->user()->isRegionalAdmin())
                            {{-- INSTRUCTOR — visible para todos --}}
                            <div @click="selectedRole = 'INSTRUCTOR'"
                                :class="selectedRole === 'INSTRUCTOR' ? 'border-green-500/30 bg-green-500/10' : 'border-[#00C853]/15 bg-[#182236]'"
                                class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                                <div class="flex justify-center mb-1.5">
                                    <svg class="w-6 h-6 text-[#00C853]" fill="none" stroke="currentColor"
                                        stroke-width="1.8" viewBox="0 0 24 24">
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
                                    <svg class="w-6 h-6 text-[#40C4FF]" fill="none" stroke="currentColor"
                                        stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                    </svg>
                                </div>
                                <div class="font-syne font-bold text-xs text-[#40C4FF]">APRENDIZ</div>
                                <div class="text-[10px] text-[#8AAABB] mt-1">Participa</div>
                            </div>
                            @endif

                        </div>
                    </div>

                    <!-- Sección: Estado del usuario -->
                    <div x-data="{ status: {{ $user->status ? '1' : '0' }} }">
                        <input type="hidden" name="status" :value="status">
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Estado del
                                    usuario</span>
                                <div class="flex-1 h-px bg-[#40C4FF]/15"></div>
                            </div>
                            <div class="flex gap-2">

                                <!-- ACTIVO -->
                                <div @click="status = '1'"
                                    :class="status === '1' ? 'bg-[#00C853]/20 border-[#00C853] text-[#00C853] shadow-lg scale-[1.02]' : 'text-[#8AAABB] hover:bg-[#00C853]/10'"
                                    class="status-opt flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                    <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Activo
                                </div>

                                <!-- INACTIVO -->
                                <div @click="status = '0'"
                                    :class="status === '0' ? 'bg-[#FF5252]/20 border-[#FF5252] text-[#FF5252] shadow-lg scale-[1.02]' : 'text-[#8AAABB] hover:bg-[#FF5252]/10'"
                                    class="status-opt flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                    <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" stroke-width="1.8"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Inactivo
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer - Fijo -->
            <div
                class="px-8 py-5 border-t border-[#40C4FF]/15 flex items-center justify-between gap-2.5 shrink-0 bg-[#111D30]">
                <div class="text-[11px] text-[#8AAABB]">
                    Última modificación: <span class="text-[#40C4FF] font-semibold">{{
                        $user->updated_at?->format('d/m/Y, g:i A') ?? 'Sin cambios' }}</span>
                </div>
                <div class="flex gap-2.5">
                    <button type="button" @click="$dispatch('close-edit-modal'); document.body.style.overflow='';"
                        class="btn-ghost flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium text-[#8AAABB] bg-[#182236] border border-[#40C4FF]/15 cursor-pointer transition-all">
                        Cancelar
                    </button>
                    <button
                        class="btn-primary flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium bg-[#40C4FF] text-[#0A1628] cursor-pointer transition-all"
                        type="submit">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        Guardar cambios
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {

    const userId = @json($user->id);

    const regionSelect = document.getElementById(`select-region-${userId}`);

    if (regionSelect?.value) {

        filterCentersByRegion(regionSelect.value, userId);

        const centerSelect = document.getElementById(`select-center-${userId}`);

        if (centerSelect?.value) {
            filterCohortsByCenter(centerSelect.value, userId);
        }
    }
});

function filterCentersByRegion(regionId, userId) {

    const centerSelect = document.getElementById(`select-center-${userId}`);

    if (!centerSelect) return;

    const options = centerSelect.querySelectorAll('option');

    options.forEach(opt => {

        if (!opt.value || opt.value === '0') return;

        const belongs = !regionId || opt.dataset.region == regionId;

        opt.disabled = !belongs;
        opt.hidden = !belongs;
    });

    const current = centerSelect.querySelector(`option[value="${centerSelect.value}"]`);

    if (current && current.disabled) {
        centerSelect.value = '';
    }

    filterCohortsByCenter(centerSelect.value, userId);
}
function filterCohortsByCenter(centerId, userId) {

    const cohortSelect = document.getElementById(`select-cohort-${userId}`);

    if (!cohortSelect) return;

    const options = cohortSelect.querySelectorAll('option');

    options.forEach(opt => {

        // ignorar placeholder
        if (!opt.value) return;

        const belongs = opt.dataset.center == centerId;

        opt.hidden = !belongs;
        opt.disabled = !belongs;
    });

    // resetear selección si ya no pertenece
    const current = cohortSelect.querySelector(`option[value="${cohortSelect.value}"]`);

    if (current && current.disabled) {
        cohortSelect.value = '';
    }
}

function cohortSelector() {
    return {
        selected: [],
        selectedCohorts: [],

        addCohort(event) {
            const id   = parseInt(event.target.value);
            const name = event.target.selectedOptions[0]?.dataset.name ?? '';

            if (!id || this.selected.includes(id)) {
                event.target.value = '';
                return;
            }

            this.selected.push(id);
            this.selectedCohorts.push({ id, name });
            event.target.value = '';   // resetea el select para permitir agregar otro
        },

        removeCohort(id) {
            this.selected        = this.selected.filter(s => s !== id);
            this.selectedCohorts = this.selectedCohorts.filter(c => c.id !== id);
        }
    }
}

    function projectAssignerEdit_{{ $user->id }}() {
    return {
        projects: @json($projects),
        selected: @json($user->projects->pluck('id')->toArray()).map(id => parseInt(id)),

        get selectedProjects() {
            return this.projects.filter(p => this.selected.includes(parseInt(p.id)));
        },

        addProject(id) {
            id = parseInt(id);
            if (!id) return;
            if (!this.selected.includes(id)) {
                this.selected.push(id);
            }
        },

        removeProject(id) {
            this.selected = this.selected.filter(p => p !== parseInt(id));
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