<div x-data class="w-[620px] max-w-[90vw] max-h-[90vh] bg-[#111D30] border border-[rgba(0,200,83,0.15)] rounded-3xl overflow-hidden shadow-[0_32px_80px_rgba(0,0,0,0.5),0_0_0_1px_rgba(0,200,83,0.08)] flex flex-col">

    <!-- Header - Fijo -->
    <div class="relative px-8 pt-7 pb-6 border-b border-[rgba(0,200,83,0.15)] bg-[rgba(255,215,64,0.03)] flex items-start gap-4 shrink-0">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#FFD740] to-[#00C853]"></div>
        <div class="w-12 h-12 rounded-xl bg-[rgba(255,215,64,0.1)] border border-[rgba(255,215,64,0.25)] flex items-center justify-center text-[#FFD740] flex-shrink-0">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
            </svg>
        </div>
        <div class="flex-1">
            <h2 class="font-syne font-extrabold text-2xl">Editar <span class="text-[#FFD740]">Proyecto</span></h2>
            <p class="text-sm text-[#8AAABB] mt-0.5">Modifica los datos del proyecto seleccionado</p>
        </div>
        <div class="flex items-center gap-2 bg-[rgba(255,215,64,0.08)] border border-[rgba(255,215,64,0.2)] rounded-lg px-10 py-1.5 text-xs text-[#FFD740] shrink-0">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="12" />
                <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            Modo edición
        </div>
        <button @click="$dispatch('close-modal')" class="absolute top-5 right-5 w-9 h-9 bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-lg flex items-center justify-center text-[#8AAABB] hover:text-[#E8F4FF] transition">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
    </div>

    <!-- Body - Con scroll -->
    <div class="px-8 py-7 overflow-y-auto flex-1" style="max-height: calc(90vh - 140px);">
        <form class="space-y-6">
            <!-- Sección: Información básica -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Información básica</span>
                    <div class="flex-1 h-px bg-[rgba(0,200,83,0.15)]"></div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-[11px] uppercase tracking-wide text-[#8AAABB] font-medium mb-1.5">Nombre del proyecto <span class="text-[#00C853]">*</span></label>
                        <input type="text" name="nombre_proyecto" value="Sigpro Académico" class="w-full bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-4 py-2.5 text-[13.5px] text-[#E8F4FF] placeholder:text-[rgba(138,170,187,0.4)] focus:border-[rgba(255,215,64,0.5)] focus:bg-[rgba(255,215,64,0.02)] outline-none transition">
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wide text-[#8AAABB] font-medium mb-1.5">Descripción</label>
                        <textarea name="descripcion" rows="3" class="w-full bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-4 py-2.5 text-[13.5px] text-[#E8F4FF] placeholder:text-[rgba(138,170,187,0.4)] focus:border-[rgba(255,215,64,0.5)] focus:bg-[rgba(255,215,64,0.02)] outline-none resize-y">Sistema de seguimiento y gestión educativa institucional para el Ministerio de Educación Nacional.</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] uppercase tracking-wide text-[#8AAABB] font-medium mb-1.5">Fecha inicio <span class="text-[#00C853]">*</span></label>
                            <input type="date" name="fecha_inicio" value="2026-02-12" class="w-full bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-4 py-2.5 text-[13.5px] text-[#E8F4FF] focus:border-[rgba(255,215,64,0.5)] outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] uppercase tracking-wide text-[#8AAABB] font-medium mb-1.5">Fecha entrega <span class="text-[#00C853]">*</span></label>
                            <input type="date" name="fecha_entrega" value="2027-02-15" class="w-full bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-4 py-2.5 text-[13.5px] text-[#E8F4FF] focus:border-[rgba(255,215,64,0.5)] outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estado del proyecto - Radio buttons puros -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Estado del proyecto</span>
                    <div class="flex-1 h-px bg-[rgba(0,200,83,0.15)]"></div>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <label class="flex flex-col items-center justify-center gap-1 py-2.5 rounded-xl border-2 cursor-pointer bg-[rgba(0,200,83,0.1)] border-[rgba(0,200,83,0.35)] text-[#00C853]">
                        <input type="radio" name="estado" value="activo" class="hidden" checked>
                        <span class="text-lg">●</span>
                        <span class="text-xs">Activo</span>
                    </label>
                    <label class="flex flex-col items-center justify-center gap-1 py-2.5 rounded-xl border border-[rgba(0,200,83,0.15)] cursor-pointer bg-[#182236] text-[#8AAABB]">
                        <input type="radio" name="estado" value="progreso" class="hidden">
                        <span class="text-lg">◑</span>
                        <span class="text-xs">En progreso</span>
                    </label>
                    <label class="flex flex-col items-center justify-center gap-1 py-2.5 rounded-xl border border-[rgba(0,200,83,0.15)] cursor-pointer bg-[#182236] text-[#8AAABB]">
                        <input type="radio" name="estado" value="retraso" class="hidden">
                        <span class="text-lg">⚠</span>
                        <span class="text-xs">Con retraso</span>
                    </label>
                </div>
            </div>

            <!-- Líder del proyecto -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Líder del proyecto</span>
                    <div class="flex-1 h-px bg-[rgba(0,200,83,0.15)]"></div>
                </div>
                <select name="lider" class="w-full bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-4 py-2.5 text-[13.5px] text-[#E8F4FF] focus:border-[rgba(255,215,64,0.5)] outline-none">
                    <option value="1" selected class="bg-[#111D30]">Luis Miguel Muñoz</option>
                    <option value="2" class="bg-[#111D30]">Sebastián Grijalva</option>
                    <option value="3" class="bg-[#111D30]">Juan David Quinchia</option>
                    <option value="4" class="bg-[#111D30]">Sara Martínez</option>
                    <option value="5" class="bg-[#111D30]">Camilo Restrepo</option>
                    <option value="6" class="bg-[#111D30]">Daniela Ospina</option>
                </select>
            </div>

            <!-- Equipo participante - Checkboxes puros -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Equipo participante</span>
                    <div class="flex-1 h-px bg-[rgba(0,200,83,0.15)]"></div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <!-- LM - Seleccionado -->
                    <label class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl cursor-pointer bg-[rgba(0,200,83,0.1)] border border-[rgba(0,200,83,0.35)]">
                        <input type="checkbox" name="equipo[]" value="LM" class="hidden" checked>
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#00963E] to-[#00C853] flex items-center justify-center font-syne font-extrabold text-[9px] text-[#0A1628]">LM</div>
                        <span class="text-xs text-[#E8F4FF]">Luis Miguel</span>
                        <div class="w-4 h-4 rounded-full bg-[#00C853] flex items-center justify-center">
                            <svg class="w-3 h-3" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                    </label>
                    
                    <!-- SG - Seleccionado -->
                    <label class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl cursor-pointer bg-[rgba(0,200,83,0.1)] border border-[rgba(0,200,83,0.35)]">
                        <input type="checkbox" name="equipo[]" value="SG" class="hidden" checked>
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#0088CC] to-[#40C4FF] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">SG</div>
                        <span class="text-xs text-[#E8F4FF]">Sebastián</span>
                        <div class="w-4 h-4 rounded-full bg-[#00C853] flex items-center justify-center">
                            <svg class="w-3 h-3" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                    </label>
                    
                    <!-- JD - Seleccionado -->
                    <label class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl cursor-pointer bg-[rgba(0,200,83,0.1)] border border-[rgba(0,200,83,0.35)]">
                        <input type="checkbox" name="equipo[]" value="JD" class="hidden" checked>
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#6C3DBF] to-[#9B59B6] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">JD</div>
                        <span class="text-xs text-[#E8F4FF]">Juan David</span>
                        <div class="w-4 h-4 rounded-full bg-[#00C853] flex items-center justify-center">
                            <svg class="w-3 h-3" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                    </label>
                    
                    <!-- SM - No seleccionado -->
                    <label class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl cursor-pointer bg-[#182236] border border-[rgba(0,200,83,0.15)]">
                        <input type="checkbox" name="equipo[]" value="SM" class="hidden">
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#E67E22] to-[#F39C12] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">SM</div>
                        <span class="text-xs text-[#E8F4FF]">Sara M.</span>
                        <div class="w-4 h-4 rounded border-2 border-[rgba(138,170,187,0.3)]"></div>
                    </label>
                    
                    <!-- CR - No seleccionado -->
                    <label class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl cursor-pointer bg-[#182236] border border-[rgba(0,200,83,0.15)]">
                        <input type="checkbox" name="equipo[]" value="CR" class="hidden">
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#16A085] to-[#1ABC9C] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">CR</div>
                        <span class="text-xs text-[#E8F4FF]">Camilo R.</span>
                        <div class="w-4 h-4 rounded border-2 border-[rgba(138,170,187,0.3)]"></div>
                    </label>
                </div>
            </div>

            <!-- Avance del proyecto -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Avance del proyecto</span>
                    <div class="flex-1 h-px bg-[rgba(0,200,83,0.15)]"></div>
                </div>
                <div>
                    <label class="block text-[11px] uppercase tracking-wide text-[#8AAABB] font-medium mb-1.5">Porcentaje de avance</label>
                    <div class="flex items-center gap-3">
                        <input type="number" name="avance" min="0" max="100" value="50" class="w-24 bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-3 py-2 text-center text-[13.5px] text-[#E8F4FF] focus:border-[rgba(255,215,64,0.5)] outline-none">
                        <div class="flex-1 h-2 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-[#00963E] to-[#00C853] rounded-full" style="width: 50%"></div>
                        </div>
                        <span class="text-sm text-[#8AAABB]">%</span>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer - Fijo -->
    <div class="px-8 py-5 border-t border-[rgba(0,200,83,0.15)] flex flex-wrap items-center justify-between gap-4 shrink-0 bg-[#111D30]">
        <div class="text-[11px] text-[#8AAABB]">Última modificación: <b class="text-[#FFD740]">Hoy, 3:42 PM</b></div>
        <div class="flex gap-2">
            <button @click="$dispatch('close-modal')" class="flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium text-[#8AAABB] bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all">
                Cancelar
            </button>
            <button type="submit" form="project-form" class="px-5 py-2.5 rounded-xl bg-[#00C853] text-[#0A1628] text-sm font-semibold hover:bg-[#00E060] shadow-md transition flex items-center gap-2">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
                Guardar cambios
            </button>
        </div>
    </div>
</div>
