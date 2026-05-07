<div
    class="w-[620px] max-w-[90vw] max-h-[90vh] bg-[#111D30] border border-[#40C4FF]/15 rounded-3xl overflow-hidden shadow-[0_32px_80px_rgba(0,0,0,0.5),0_0_0_1px_rgba(64,196,255,0.08)] flex flex-col">

    <!-- Header -->
    <div
        class="relative px-8 pt-7 pb-6 border-b border-[#40C4FF]/15 bg-[#40C4FF]/[0.03] flex items-center gap-4 shrink-0 pr-16">
        <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#40C4FF] to-[#00C853]"></div>
        <div
            class="w-12 h-12 rounded-2xl bg-[#40C4FF]/12 border border-[#40C4FF]/25 flex items-center justify-center text-[#40C4FF] shrink-0 font-bold text-lg">
            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
        </div>
        <div>
            <div class="font-syne font-extrabold text-[22px] text-[#E8F4FF]">
                Detalle de <span class="text-[#40C4FF]">Usuario</span>
            </div>
            <div class="text-[13px] text-[#8AAABB] mt-0.5">Información completa del usuario seleccionado</div>
        </div>
        <!-- Badge modo vista -->
        <div
            class="ml-auto flex items-center gap-1.5 bg-[#40C4FF]/08 border border-[#40C4FF]/20 rounded-lg px-3 py-1.5 text-[11px] text-[#40C4FF] shrink-0">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                <circle cx="12" cy="12" r="3" />
            </svg>
            Modo vista
        </div>

        <!-- Botón cerrar -->
        <button type="button" @click="$dispatch('close-show-modal'); document.body.style.overflow='';"
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

            <!-- Sección: Datos personales -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Datos personales</span>
                    <div class="flex-1 h-px bg-[#40C4FF]/15"></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Nombre -->
                    <div class="flex flex-col gap-1.5">
                        <span class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Nombre</span>
                        <div
                            class="bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px]">
                            {{ $user->first_name }}
                        </div>
                    </div>
                    <!-- Apellido -->
                    <div class="flex flex-col gap-1.5">
                        <span class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Apellido</span>
                        <div
                            class="bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px]">
                            {{ $user->last_name }}
                        </div>
                    </div>
                    <!-- Documento -->
                    <div class="flex flex-col gap-1.5">
                        <span class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Documento</span>
                        <div
                            class="bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px]">
                            {{ $user->document }}
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="flex flex-col gap-1.5">
                        <span class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Correo
                            electrónico</span>
                        <div
                            class="bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] truncate">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección: Rol y Estado -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Rol y estado</span>
                    <div class="flex-1 h-px bg-[#40C4FF]/15"></div>
                </div>
                <div class="grid grid-cols-2 gap-4">

                    <!-- Rol -->
                    <div class="flex flex-col gap-1.5">
                        <span class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Rol en el
                            sistema</span>
                        <div
                            class="bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] flex items-center gap-2">
                            @if($user->role === 'INSTRUCTOR')
                            <svg class="w-4 h-4 text-[#00C853] shrink-0" fill="none" stroke="currentColor"
                                stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            <span class="text-[#00C853] font-syne font-bold text-[12px]">INSTRUCTOR</span>

                            @elseif($user->role === 'STUDENT')
                            <svg class="w-4 h-4 text-[#40C4FF] shrink-0" fill="none" stroke="currentColor"
                                stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                            <span class="text-[#40C4FF] font-syne font-bold text-[12px]">APRENDIZ</span>

                            @elseif($user->role === 'ADMIN')
                            <svg class="w-4 h-4 text-[#FFD740] shrink-0" fill="none" stroke="currentColor"
                                stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <span class="text-[#FFD740] font-syne font-bold text-[12px]">ADMIN</span>
                            @endif
                        </div>
                    </div>

                    <!-- Estado -->
                    <div class="flex flex-col gap-1.5">
                        <span class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Estado</span>
                        <div
                            class="bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] flex items-center gap-2">
                            @if($user->status)
                            <svg class="w-4 h-4 text-[#00C853] shrink-0" fill="none" stroke="currentColor"
                                stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="text-[#00C853] font-bold text-[12px]">Activo</span>
                            @else
                            <svg class="w-4 h-4 text-[#FF5252] shrink-0" fill="none" stroke="currentColor"
                                stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="text-[#FF5252] font-bold text-[12px]">Inactivo</span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <!-- Sección: Proyectos asignados -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Proyectos asignados</span>
                    <div class="flex-1 h-px bg-[#40C4FF]/15"></div>
                </div>
                <div class="flex flex-wrap gap-2">
                    @forelse($user->projects as $project)
                    <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#182236] border border-[#40C4FF]/15">
                        <div
                            class="w-[26px] h-[26px] rounded-lg bg-[#40C4FF] flex items-center justify-center text-[9px] text-black font-bold">
                            {{ strtoupper(substr($project->name, 0, 2)) }}
                        </div>
                        <span class="text-[12.5px] text-[#E8F4FF]">{{ $project->name }}</span>

                        <!-- Separador -->
                        <div class="w-px h-4 bg-[#40C4FF]/20 mx-1"></div>

                        <!-- Rol en el proyecto -->
                        @if($project->pivot->project_role === 'LEADER')
                        <span class="flex items-center gap-1 text-[10px] font-bold text-[#FFD740]">
                            <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                            LIDER
                        </span>
                        @else
                        <span class="flex items-center gap-1 text-[10px] font-bold text-[#8AAABB]">
                            <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                            INTEGRANTE
                        </span>
                        @endif
                    </div>
                    @empty
                    <div class="text-[12px] text-[#8AAABB] italic py-2">Sin proyectos asignados</div>
                    @endforelse
                </div>
            </div>

            <!-- Sección: Información del sistema -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Información del sistema</span>
                    <div class="flex-1 h-px bg-[#40C4FF]/15"></div>
                </div>
                <div class="grid grid-cols-2 gap-4">

                    <div class="flex flex-col gap-1.5">
                        <span class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Registrado
                            el</span>
                        <div
                            class="bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px]">
                            {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <span class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Número de
                            Ficha</span>
                        <div
                            class="bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#40C4FF] text-[13.5px] font-mono">
                            {{ $user->cohort?->cohort_number ?? 'Sin Ficha' }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="px-8 py-5 border-t border-[#40C4FF]/15 flex items-center justify-between gap-2.5 shrink-0 bg-[#111D30]">
        <div class="text-[11px] text-[#8AAABB]">
            Última modificación: <span class="text-[#40C4FF] font-semibold">{{ $user->updated_at?->format('d/m/Y, g:i
                A') ?? 'Sin cambios' }}</span>
        </div>
        <button type="button" @click="$dispatch('close-show-modal'); document.body.style.overflow='';"
            class="flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium text-[#8AAABB] bg-[#182236] border border-[#40C4FF]/15 cursor-pointer transition-all hover:text-[#E8F4FF]">
            Cerrar
        </button>
    </div>

</div>