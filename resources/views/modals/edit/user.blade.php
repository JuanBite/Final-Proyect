<div x-data="projectAssignerEdit_{{ $user->id }}()" key="{{ $user->id }}">
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
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

            <!-- Body - Con scroll -->
            <div class="px-8 py-7 overflow-y-auto flex-1" style="max-height: calc(90vh - 140px);">
                <div class="flex flex-col gap-6">

                    <!-- Sección: Datos personales -->
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
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">
                                    Ficha <span class="text-[#40C4FF]">*</span>
                                </label>
                                <select name="cohort_id"
                                    class="form-input bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#40C4FF]/40"
                                    required>
                                    <option value="" disabled>Selecciona una ficha</option>
                                    @foreach($cohorts as $cohort)
                                    <option value="{{ $cohort->id }}" {{ $user->cohort_id == $cohort->id ? 'selected' :
                                        '' }}>
                                        {{ $cohort->program_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2 flex flex-col gap-1.5">
                                <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Correo
                                    electrónico <span class="text-[#40C4FF]">*</span></label>
                                <input
                                    class="form-input bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#40C4FF]/40"
                                    type="email" name="email" required placeholder="usuario@correo.com"
                                    value="{{ $user->email }}" />
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label
                                    class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Contraseña</label>
                                <input
                                    class="form-input bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#40C4FF]/40"
                                    type="password" name="password"
                                    placeholder="•••••••• (dejar vacío para mantener)" />
                                <span class="text-[10px] text-[#8AAABB]">Dejar vacío para mantener la contraseña
                                    actual</span>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Confirmar
                                    contraseña</label>
                                <input
                                    class="form-input bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#40C4FF]/40"
                                    type="password" name="password_confirmation" placeholder="••••••••" />
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Rol en el sistema -->
                    <div x-data="{ role: '{{ $user->role }}' }">
                        <input type="hidden" name="role" :value="role">
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Rol en el
                                    sistema</span>
                                <div class="flex-1 h-px bg-[#40C4FF]/15"></div>
                            </div>
                            <div class="grid grid-cols-3 gap-3">
                                <!-- INSTRUCTOR -->
                                <div @click="role = 'INSTRUCTOR'"
                                    :class="role === 'INSTRUCTOR' ? 'bg-[#00C853]/20 border-[#00C853] text-[#00C853] shadow-lg scale-[1.02]' : 'text-[#8AAABB] hover:bg-[#00C853]/10'"
                                    class="flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                    <span class="block text-lg mb-1">🎯</span>
                                    <span class="font-syne font-bold text-[11px]">INSTRUCTOR</span>
                                    <span class="text-[9px] mt-0.5 opacity-70">Gestiona y dirige</span>
                                </div>
                                <!-- STUDENT -->
                                <div @click="role = 'STUDENT'"
                                    :class="role === 'STUDENT' ? 'bg-[#40C4FF]/20 border-[#40C4FF] text-[#40C4FF] shadow-lg scale-[1.02]' : 'text-[#8AAABB] hover:bg-[#40C4FF]/10'"
                                    class="flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                    <span class="block text-lg mb-1">👤</span>
                                    <span class="font-syne font-bold text-[11px]">STUDENT</span>
                                    <span class="text-[9px] mt-0.5 opacity-70">Participa</span>
                                </div>
                                <!-- ADMIN -->
                                <div @click="role = 'ADMIN'"
                                    :class="role === 'ADMIN' ? 'bg-[#FFD740]/20 border-[#FFD740] text-[#FFD740] shadow-lg scale-[1.02]' : 'text-[#8AAABB] hover:bg-[#FFD740]/10'"
                                    class="flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                    <span class="block text-lg mb-1">⚙️</span>
                                    <span class="font-syne font-bold text-[11px]">ADMIN</span>
                                    <span class="text-[9px] mt-0.5 opacity-70">Administra</span>
                                </div>
                            </div>
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
                                    <span class="block text-lg mb-1">🟢</span>
                                    Activo
                                </div>
                                <!-- INACTIVO -->
                                <div @click="status = '0'"
                                    :class="status === '0' ? 'bg-[#FF5252]/20 border-[#FF5252] text-[#FF5252] shadow-lg scale-[1.02]' : 'text-[#8AAABB] hover:bg-[#FF5252]/10'"
                                    class="status-opt flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                    <span class="block text-lg mb-1">🔴</span>
                                    Inactivo
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Asignar a proyectos -->
                    <div x-data="projectAssignerEdit()">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Asignar a proyectos</span>
                            <div class="flex-1 h-px bg-[#40C4FF]/15"></div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <select @change="addProject($event)"
                                class="form-input w-full mb-1 bg-[#182236] border border-[#40C4FF]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] transition-all focus:border-[#40C4FF]/40">
                                <option value="">— Seleccionar proyecto para asignar —</option>
                                @foreach ($projects as $project)
                                <option value="{{ $project->id }}" style="background:#111D30; color:white;">
                                    {{ $project->name }}
                                </option>
                                @endforeach
                            </select>

                            <!-- Inputs ocultos -->
                            <template x-for="id in selected" :key="id">
                                <input type="hidden" name="projects[]" :value="id">
                            </template>

                            <!-- Proyectos seleccionados -->
                            <div class="flex flex-wrap gap-2 mt-2">
                                <template x-for="project in selectedProjects" :key="project.id">
                                    <div
                                        class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#182236] border border-[#40C4FF]/15">
                                        <div class="w-[26px] h-[26px] rounded-lg bg-[#40C4FF] flex items-center justify-center text-[9px] text-black font-bold"
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
                                <div x-show="selectedProjects.length === 0"
                                    class="text-[12px] text-[#8AAABB] italic py-2">
                                    No hay proyectos asignados
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
    function projectAssignerEdit_{{ $user->id }}() {
        return {
            projects: @json($projects),
            selected: @json($user->projects->pluck('id')->toArray()).map(id => parseInt(id)),
            

        get selectedProjects() {
            return this.projects.filter(p => this.selected.includes(parseInt(p.id)));
        },

        addProject(event) {
            let id = parseInt(event.target.value);
            if (!id) return;
            if (!this.selected.includes(id)) {
                this.selected.push(id);
            }
            event.target.value = "";
        },

        removeProject(id) {
            this.selected = this.selected.filter(p => p !== parseInt(id));
        },

        getInitials(name) {
            return name.substring(0, 2).toUpperCase();
        }
    }
    // ← closeModals eliminado de aquí
}
</script>