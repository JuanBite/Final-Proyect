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
        <div class="px-8 py-6 flex flex-col gap-6 overflow-y-auto flex-1 min-h-0">

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
                    <div class="col-span-2 flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Correo
                            electrónico <span class="text-[#40C4FF]">*</span></label>
                        <input name="email"
                            class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none"
                            type="email" placeholder="usuario@correo.com" required />
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Contraseña <span
                                class="text-[#40C4FF]">*</span></label>
                        <input name="password"
                            class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none"
                            type="password" placeholder="••••••••" required />
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Confirmar
                            contraseña <span class="text-[#40C4FF]">*</span></label>
                        <input name="password_confirmation"
                            class="bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full outline-none"
                            type="password" placeholder="••••••••" required />
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
                    <div @click="selectedRole = 'INSTRUCTOR'"
                        :class="selectedRole === 'INSTRUCTOR' ? 'border-green-500/30 bg-green-500/10' : 'border-[#00C853]/15 bg-[#182236]'"
                        class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                        <span class="block text-[22px] mb-1.5">🎯</span>
                        <div class="font-syne font-bold text-xs text-[#00C853]">INSTRUCTOR</div>
                        <div class="text-[10px] text-[#8AAABB] mt-1">Gestiona y dirige</div>
                    </div>
                    <div @click="selectedRole = 'STUDENT'"
                        :class="selectedRole === 'STUDENT' ? 'border-blue-500/30 bg-blue-500/10' : 'border-[#00C853]/15 bg-[#182236]'"
                        class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                        <span class="block text-[22px] mb-1.5">👤</span>
                        <div class="font-syne font-bold text-xs text-[#40C4FF]">STUDENT</div>
                        <div class="text-[10px] text-[#8AAABB] mt-1">Participa</div>
                    </div>
                    <div @click="selectedRole = 'ADMIN'"
                        :class="selectedRole === 'ADMIN' ? 'border-yellow-500/30 bg-yellow-500/10' : 'border-[#00C853]/15 bg-[#182236]'"
                        class="rounded-xl p-3.5 cursor-pointer text-center border transition-all">
                        <span class="block text-[22px] mb-1.5">⚙️</span>
                        <div class="font-syne font-bold text-xs text-[#FFD740]">ADMIN</div>
                        <div class="text-[10px] text-[#8AAABB] mt-1">Administra</div>
                    </div>
                </div>
            </div>

            <!-- Proyectos -->
            <div x-data="{ selectedProjects: [] }">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Asignar a proyectos</span>
                    <div class="flex-1 h-px bg-[#00C853]/15"></div>
                </div>
                <div class="flex flex-col gap-1.5">
                    @foreach($projects as $project)
                    <div @click="selectedProjects.includes({{ $project->id }}) 
                ? selectedProjects = selectedProjects.filter(p => p !== {{ $project->id }}) 
                : selectedProjects.push({{ $project->id }})" :class="selectedProjects.includes({{ $project->id }}) 
                ? 'bg-[#00C853]/6 border-[#00C853]/25' 
                : 'bg-[#182236] border-[#00C853]/15'"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl border cursor-pointer transition-all">

                        <input type="checkbox" name="projects[]" value="{{ $project->id }}"
                            :checked="selectedProjects.includes({{ $project->id }})" class="hidden">

                        <div :class="selectedProjects.includes({{ $project->id }}) ? 'bg-[#00C853]' : 'bg-[#8AAABB]'"
                            class="w-2 h-2 rounded-full shrink-0 transition-all"></div>

                        <span class="text-[13px] flex-1">{{ $project->name }}</span>

                        <div :class="selectedProjects.includes({{ $project->id }}) ? 'bg-[#00C853] border-[#00C853]' : 'border-[#8AAABB]/30'"
                            class="w-[18px] h-[18px] rounded-[5px] border flex items-center justify-center shrink-0 transition-all">
                            <svg x-show="selectedProjects.includes({{ $project->id }})" width="10" height="10"
                                fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                    </div>
                    @endforeach
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
</div>