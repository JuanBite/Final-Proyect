<div class="w-[560px] max-w-full bg-[#111D30] border border-[#00C853]/15 rounded-3xl overflow-hidden shadow-[0_32px_80px_rgba(0,0,0,0.5),0_0_0_1px_rgba(0,200,83,0.08)] flex flex-col max-h-[90vh]">

    <!-- Header  -->
    <div class="relative px-8 pt-7 pb-6 border-b border-[#00C853]/15 bg-[#00C853]/[0.03] flex items-center gap-4 shrink-0">
        <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#40C4FF] to-[#00C853]"></div>
        <div class="w-12 h-12 rounded-2xl bg-[#40C4FF]/10 border border-[#40C4FF]/25 flex items-center justify-center text-[#40C4FF] shrink-0">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <line x1="19" y1="8" x2="19" y2="14" />
                <line x1="22" y1="11" x2="16" y2="11" />
            </svg>
        </div>
        <div>
            <div class="font-syne font-extrabold text-[22px] text-[#E8F4FF]">Crear <span class="text-[#40C4FF]">Usuario</span></div>
            <div class="text-[13px] text-[#8AAABB] mt-0.5">Registra un nuevo usuario en el sistema</div>
        </div>
        <button @click="$dispatch('close-create-modal'); document.body.style.overflow='';" class="absolute top-5 right-5 w-9 h-9 bg-[#182236] border border-[#00C853]/15 rounded-xl flex items-center justify-center text-[#8AAABB] hover:text-[#E8F4FF] transition-colors cursor-pointer">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
    </div>

    <!-- Body (scrollable) -->
    <div class="px-8 py-6 flex flex-col gap-6 overflow-y-auto flex-1">
        <!-- Avatar preview -->
        <div class="flex items-center gap-4 bg-[#182236] border border-[#00C853]/15 rounded-2xl px-5 py-4 shrink-0">
            <div id="avCircle" class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#0088CC] to-[#40C4FF] flex items-center justify-center font-syne font-extrabold text-xl text-white shrink-0">
                NU
            </div>
            <div class="flex-1">
                <div id="avName" class="font-syne font-bold text-[15px] text-[#E8F4FF]">Nuevo Usuario</div>
                <div id="avRole" class="text-[11px] text-[#8AAABB] mt-0.5">Sin rol asignado</div>
                <div class="text-[10px] text-[#8AAABB]/50 mt-2">Vista previa del perfil</div>
            </div>
        </div>

        <!-- Datos personales -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Datos personales</span>
                <div class="flex-1 h-px bg-[#00C853]/15"></div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Nombre <span class="text-[#40C4FF]">*</span></label>
                    <input x-model="formData.nombre" class="form-input bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all" type="text" placeholder="Ej: Luis Miguel" />
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Apellido <span class="text-[#40C4FF]">*</span></label>
                    <input x-model="formData.apellido" class="form-input bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all" type="text" placeholder="Ej: Muñoz" />
                </div>
                <div class="col-span-2 flex flex-col gap-1.5">
                    <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Correo electrónico <span class="text-[#40C4FF]">*</span></label>
                    <input x-model="formData.email" class="form-input bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all" type="email" placeholder="usuario@correo.com" />
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Documento</label>
                    <input x-model="formData.documento" class="form-input bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all" type="text" placeholder="N° identificación" />
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Estado</label>
                    <select x-model="formData.estado" class="form-input bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all">
                        <option value="activo" style="background:#111D30">Activo</option>
                        <option value="inactivo" style="background:#111D30">Inactivo</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Rol -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Rol en el sistema</span>
                <div class="flex-1 h-px bg-[#00C853]/15"></div>
            </div>
            <div class="grid grid-cols-3 gap-3">
                <div class="role-card bg-[#182236] border border-[#00C853]/15 rounded-xl p-3.5 cursor-pointer text-center transition-all" onclick="selectRole('Líder de Proyecto', this, 'green')">
                    <span class="block text-[22px] mb-1.5">🎯</span>
                    <div class="font-syne font-bold text-xs text-[#00C853]">Líder</div>
                    <div class="text-[10px] text-[#8AAABB] mt-1 leading-snug">Gestiona y dirige el proyecto</div>
                </div>
                <div id="roleDefault" class="role-card bg-[#40C4FF]/8 border border-[#40C4FF]/35 rounded-xl p-3.5 cursor-pointer text-center transition-all" onclick="selectRole('Miembro', this, 'blue')">
                    <span class="block text-[22px] mb-1.5">👤</span>
                    <div class="font-syne font-bold text-xs text-[#40C4FF]">Miembro</div>
                    <div class="text-[10px] text-[#8AAABB] mt-1 leading-snug">Participa en el proyecto</div>
                </div>
                <div class="role-card bg-[#182236] border border-[#00C853]/15 rounded-xl p-3.5 cursor-pointer text-center transition-all" onclick="selectRole('Administrador', this, 'yellow')">
                    <span class="block text-[22px] mb-1.5">⚙️</span>
                    <div class="font-syne font-bold text-xs text-[#FFD740]">Admin</div>
                    <div class="text-[10px] text-[#8AAABB] mt-1 leading-snug">Administra el sistema</div>
                </div>
            </div>
        </div>

        <!-- Proyectos -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Asignar a proyectos</span>
                <div class="flex-1 h-px bg-[#00C853]/15"></div>
            </div>
            <div class="flex flex-col gap-1.5">
                <div class="proj-item flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-[#00C853]/6 border border-[#00C853]/25 cursor-pointer transition-all" onclick="toggleProj(this)">
                    <div class="w-2 h-2 rounded-full bg-[#00C853] shrink-0"></div>
                    <span class="text-[13px] flex-1">Sigpro Académico</span>
                    <div class="proj-check w-[18px] h-[18px] rounded-[5px] bg-[#00C853] border border-[#00C853] flex items-center justify-center shrink-0">
                        <svg width="10" height="10" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                </div>
                <div class="proj-item flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all" onclick="toggleProj(this)">
                    <div class="proj-dot w-2 h-2 rounded-full bg-[#8AAABB] shrink-0"></div>
                    <span class="text-[13px] flex-1">Parking Sigpro</span>
                    <div class="proj-check w-[18px] h-[18px] rounded-[5px] border border-[#8AAABB]/30 flex items-center justify-center shrink-0">
                    </div>
                </div>
                <div class="proj-item flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all" onclick="toggleProj(this)">
                    <div class="proj-dot w-2 h-2 rounded-full bg-[#8AAABB] shrink-0"></div>
                    <span class="text-[13px] flex-1">Gimnasio</span>
                    <div class="proj-check w-[18px] h-[18px] rounded-[5px] border border-[#8AAABB]/30 flex items-center justify-center shrink-0">
                    </div>
                </div>
                <div class="proj-item flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all" onclick="toggleProj(this)">
                    <div class="proj-dot w-2 h-2 rounded-full bg-[#8AAABB] shrink-0"></div>
                    <span class="text-[13px] flex-1">Emprender</span>
                    <div class="proj-check w-[18px] h-[18px] rounded-[5px] border border-[#8AAABB]/30 flex items-center justify-center shrink-0">
                    </div>
                </div>
                <div class="proj-item flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all" onclick="toggleProj(this)">
                    <div class="proj-dot w-2 h-2 rounded-full bg-[#8AAABB] shrink-0"></div>
                    <span class="text-[13px] flex-1">Portería Sigpro</span>
                    <div class="proj-check w-[18px] h-[18px] rounded-[5px] border border-[#8AAABB]/30 flex items-center justify-center shrink-0">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer (fijo) -->
    <div class="px-8 py-5 border-t border-[#00C853]/15 flex justify-end gap-2.5 shrink-0">
        <button @click="$dispatch('close-create-modal'); document.body.style.overflow='';" class="btn-ghost flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium text-[#8AAABB] bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all hover:bg-[#182236]/80">
            Cancelar
        </button>
        <button @click="submitForm()" class="btn-primary flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium bg-[#40C4FF] text-[#0A1628] cursor-pointer transition-all hover:bg-[#40C4FF]/90">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Crear usuario
        </button>
    </div>

</div>
