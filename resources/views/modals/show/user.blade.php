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
    <div class="px-8 py-7 overflow-y-auto flex-1" style="max-height: calc(90vh - 140px);">
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
                            <span class="text-base">🎯</span>
                            <span class="text-[#00C853] font-syne font-bold text-[12px]">INSTRUCTOR</span>
                            @elseif($user->role === 'STUDENT')
                            <span class="text-base">👤</span>
                            <span class="text-[#40C4FF] font-syne font-bold text-[12px]">STUDENT</span>
                            @elseif($user->role === 'ADMIN')
                            <span class="text-base">⚙️</span>
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
                            <span class="text-base">🟢</span>
                            <span class="text-[#00C853] font-bold text-[12px]">Activo</span>
                            @else
                            <span class="text-base">🔴</span>
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
                        <span class="text-[10px] font-bold text-[#FFD740]">👑 LEADER</span>
                        @else
                        <span class="text-[10px] font-bold text-[#8AAABB]">👤 MEMBER</span>
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