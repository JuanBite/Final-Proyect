<form action="{{ route('projects.update', $project->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div
        class="w-[620px] max-w-[90vw] max-h-[90vh] bg-[#111D30] border border-[#FFD740]/15 rounded-3xl overflow-hidden shadow-[0_32px_80px_rgba(0,0,0,0.5),0_0_0_1px_rgba(255,215,64,0.08)] flex flex-col">

        <!-- Header - Fijo -->
        <div
            class="relative px-8 pt-7 pb-6 border-b border-[#FFD740]/15 bg-[#FFD740]/[0.03] flex items-center gap-4 shrink-0 pr-16">
            <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#FFD740] to-[#00C853]"></div>
            <div
                class="w-12 h-12 rounded-2xl bg-[#FFD740]/12 border border-[#FFD740]/25 flex items-center justify-center text-[#FFD740] shrink-0">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
            </div>
            <div>
                <div class="font-syne font-extrabold text-[22px] text-[#E8F4FF]">Editar <span
                        class="text-[#FFD740]">Proyecto</span></div>
                <div class="text-[13px] text-[#8AAABB] mt-0.5">Modifica los datos del proyecto seleccionado</div>
            </div>
            <!-- Badge modo edición -->
            <div
                class="ml-auto flex items-center gap-1.5 bg-[#FFD740]/08 border border-[#FFD740]/20 rounded-lg px-3 py-1.5 text-[11px] text-[#FFD740] shrink-0">
                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                Modo edición
            </div>
            <!-- Botón cerrar -->
            <button type="button" @click="modalEditarAbierto = false; document.body.style.overflow='';"
                class="absolute top-5 right-5 w-9 h-9 bg-[#182236] border border-[#FFD740]/15 rounded-xl flex items-center justify-center text-[#8AAABB] hover:text-[#E8F4FF] transition-colors">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>

        <!-- Body - Con scroll -->
        <div class="px-8 py-6 flex flex-col gap-6 overflow-y-auto flex-1 min-h-0 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-[#0d1726] [&::-webkit-scrollbar-thumb]:bg-[#2a3a52] [&::-webkit-scrollbar-thumb]:rounded-full">
            <div class="flex flex-col gap-6">

                <!-- Sección: Información básica -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Información básica</span>
                        <div class="flex-1 h-px bg-[#FFD740]/15"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 flex flex-col gap-1.5">
                            <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Nombre del
                                proyecto <span class="text-[#00C853]">*</span></label>
                            <input
                                class="form-input bg-[#182236] border border-[#FFD740]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#FFD740]/40"
                                type="text" name="name" required placeholder="Ej: Sigpro Académico"
                                value="{{ $project->name }}" />
                        </div>
                        <div class="col-span-2 flex flex-col gap-1.5">
                            <label
                                class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Descripción</label>
                            <textarea
                                class="form-input bg-[#182236] border border-[#FFD740]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full resize-y min-h-[80px] leading-relaxed transition-all focus:border-[#FFD740]/40"
                                name="description"
                                placeholder="Describe brevemente el objetivo del proyecto...">{{ $project->description }}</textarea>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Fecha inicio
                                <span class="text-[#00C853]">*</span></label>
                            <input
                                class="form-input bg-[#182236] border border-[#FFD740]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#FFD740]/40"
                                readonly type="date" name="start_date" required
                                value="{{ $project->start_date?->format('Y-m-d') }}" />
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Fecha entrega
                                <span class="text-[#00C853]">*</span></label>
                            <input
                                class="form-input bg-[#182236] border border-[#FFD740]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#FFD740]/40"
                                type="date" name="due_date" required
                                value="{{ $project->due_date?->format('Y-m-d') }}" />
                        </div>
                    </div>
                </div>


                <!-- Sección: Líder -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Líder del proyecto</span>
                        <div class="flex-1 h-px bg-[#FFD740]/15"></div>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Seleccionar líder
                            <span class="text-[#00C853]">*</span></label>
                        <select name="leader_id" required
                            class="form-input bg-[#182236] border border-[#FFD740]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all focus:border-[#FFD740]/40">
                            <option value="" style="background:#111D30">— Selecciona un líder —</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $project->leader_id == $user->id ? 'selected' : '' }}
                                style="background:#111D30">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Sección: Equipo -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Equipo participante</span>
                        <div class="flex-1 h-px bg-[#FFD740]/15"></div>
                    </div>
                    <div x-data="teamSelectorEdit()">
                        <select @change="addUser($event)"
                            class="form-input w-full mb-3 bg-[#182236] border border-[#FFD740]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] transition-all focus:border-[#FFD740]/40">
                            <option value="">Buscar usuario</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" style="background:#111D30; color:white;">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </option>
                            @endforeach
                        </select>

                        <!-- Inputs ocultos -->
                        <template x-for="id in selected" :key="id">
                            <input type="hidden" name="team[]" :value="id">
                        </template>

                        <!-- Usuarios seleccionados -->
                        <div class="flex flex-wrap gap-2">
                            <template x-for="user in selectedUsers" :key="user.id">
                                <div
                                    class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#182236] border border-[#FFD740]/15">
                                    <div class="w-[26px] h-[26px] rounded-lg bg-[#FFD740] flex items-center justify-center text-[9px] text-black font-bold"
                                        x-text="getInitials(user.first_name + ' ' + user.last_name)"></div>
                                    <span class="text-[12.5px]" x-text="user.first_name + ' ' + user.last_name"></span>
                                    <button type="button" @click="removeUser(user.id)"
                                        class="ml-2 text-red-400 hover:text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Sección: Estado -->
                <div x-data="{ status: '{{ $project->status ?? 'IN_PROGRESS' }}' }">
                    <input type="hidden" name="status" :value="status">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Estado del proyecto</span>
                            <div class="flex-1 h-px bg-[#FFD740]/15"></div>
                        </div>
                        <div class="flex gap-2">

                            <!-- EN PROGRESO -->
                            <div @click="status = 'IN_PROGRESS'" :class="status === 'IN_PROGRESS'
                                ? 'bg-[#00C853]/20 border-[#00C853] text-[#00C853] shadow-lg scale-[1.02]'
                                : 'text-[#8AAABB] hover:bg-[#00C853]/10'"
                                class="status-opt flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                <span class="block text-lg mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </span>En progreso
                            </div>

                            <!-- COMPLETADO -->
                            <div @click="status = 'COMPLETED'" :class="status === 'COMPLETED'
                                ? 'bg-[#40C4FF]/20 border-[#40C4FF] text-[#40C4FF] shadow-lg scale-[1.02]'
                                : 'text-[#8AAABB] hover:bg-[#40C4FF]/10'"
                                class="status-opt flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                <span class="block text-lg mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </span>Completado
                            </div>

                            <!-- RETRASADO -->
                            <div @click="status = 'DELAYED'" :class="status === 'DELAYED'
                                ? 'bg-[#FFD740]/20 border-[#FFD740] text-[#FFD740] shadow-lg scale-[1.02]'
                                : 'text-[#8AAABB] hover:bg-[#FFD740]/10'"
                                class="status-opt flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                <span class="block text-lg mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                    </svg>
                                </span>Con retraso
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Footer - Fijo -->
        <div
            class="px-8 py-5 border-t border-[#FFD740]/15 flex items-center justify-between gap-2.5 shrink-0 bg-[#111D30]">
            <div class="text-[11px] text-[#8AAABB]">
                Última modificación: <span class="text-[#FFD740] font-semibold">{{ $project->updated_at?->format('d/m/Y,
                    g:i A') ?? 'Sin cambios' }}</span>
            </div>
            <div class="flex gap-2.5">
                <button type="button" @click="modalEditarAbierto = false; document.body.style.overflow='';"
                    class="btn-ghost flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium text-[#8AAABB] bg-[#182236] border border-[#FFD740]/15 cursor-pointer transition-all">
                    Cancelar
                </button>
                <button
                    class="btn-primary flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium bg-[#FFD740] text-[#0A1628] cursor-pointer transition-all"
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

<script>
    function teamSelectorEdit() {
        return {
            users: @json($users),
            selected: @json($project->team->pluck('id') ?? []),

            get selectedUsers() {
                return this.users.filter(user => this.selected.includes(user.id));
            },

            addUser(event) {
                let id = parseInt(event.target.value);
                if (!id) return;
                if (!this.selected.includes(id)) {
                    this.selected.push(id);
                }
                event.target.value = "";
            },

            removeUser(id) {
                this.selected = this.selected.filter(u => u !== id);
            },

            getInitials(name) {
                return name.split(' ')
                    .map(n => n[0])
                    .join('')
                    .substring(0, 2)
                    .toUpperCase();
            }
        }
    }
</script>