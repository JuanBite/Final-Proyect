<form action="{{ route('projects.store') }}" method="POST">
    @csrf
    <div class="w-[620px] max-w-[90vw] max-h-[90vh] bg-[#111D30] border border-[#00C853]/15 rounded-3xl overflow-hidden shadow-[0_32px_80px_rgba(0,0,0,0.5),0_0_0_1px_rgba(0,200,83,0.08)] flex flex-col">

        <!-- Header - Fijo -->
        <div class="relative px-8 pt-7 pb-6 border-b border-[#00C853]/15 bg-[#00C853]/[0.03] flex items-center gap-4 shrink-0">
            <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-[#00C853] to-[#40C4FF]"></div>
            <div class="w-12 h-12 rounded-2xl bg-[#00C853]/12 border border-[#00C853]/25 flex items-center justify-center text-[#00C853] shrink-0">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" /></svg>
            </div>
            <div>
                <div class="font-syne font-extrabold text-[22px] text-[#E8F4FF]">Crear <span class="text-[#00C853]">Proyecto</span></div>
                <div class="text-[13px] text-[#8AAABB] mt-0.5">Completa los datos para registrar un nuevo proyecto</div>
            </div>
            <!-- Botón cerrar con onclick directo -->
            <button onclick="if(window.closeProjectModal) window.closeProjectModal()" class="absolute top-5 right-5 w-9 h-9 bg-[#182236] border border-[#00C853]/15 rounded-xl flex items-center justify-center text-[#8AAABB] hover:text-[#E8F4FF] transition-colors">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" /></svg>
            </button>
        </div>

        <!-- Body - Con scroll -->
        <div class="px-8 py-7 overflow-y-auto overflow flex-1 " style="max-height: calc(90vh - 140px) ;">
            <div class="flex flex-col gap-6">
                <!-- Sección: Información básica -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Información básica</span>
                        <div class="flex-1 h-px bg-[#00C853]/15"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 flex flex-col gap-1.5">
                            <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Nombre del proyecto <span class="text-[#00C853]">*</span></label>
                            <input class="form-input bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all" type="text" name="name" required placeholder="Ej: Sigpro Académico" />
                        </div>
                        <div class="col-span-2 flex flex-col gap-1.5">
                            <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Descripción</label>
                            <textarea class="form-input bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full resize-y min-h-[80px] leading-relaxed transition-all" name="description" required placeholder="Describe brevemente el objetivo del proyecto..."></textarea>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Fecha inicio <span class="text-[#00C853]">*</span></label>
                            <input class="form-input bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all" type="date" name="start_date" required value="2026-03-13" />
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Fecha entrega <span class="text-[#00C853]">*</span></label>
                            <input class="form-input bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all" type="date" name="due_date" required />
                        </div>
                    </div>
                </div>

                <!-- Sección: Avance -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Avance inicial</span>
                        <div class="flex-1 h-px bg-[#00C853]/15"></div>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Porcentaje de avance</label>
                        <div class="flex items-center gap-3">
                            <input class="form-input bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] text-center w-20 shrink-0 transition-all" type="number" name="progress" required min="0" max="100" value="0" id="pctInput" oninput="document.getElementById('pbar').style.width=Math.min(100,Math.max(0,this.value))+'%'" />
                            <div class="flex-1 h-2 bg-white/[0.06] rounded-full overflow-hidden">
                                <div class="progress-fill h-full bg-gradient-to-r from-[#00963E] to-[#00C853] rounded-full w-0" id="pbar"></div>
                            </div>
                            <span class="text-[13px] text-[#8AAABB] shrink-0">%</span>
                        </div>
                    </div>
                </div>

                <!-- Sección: Líder -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Líder del proyecto</span>
                        <div class="flex-1 h-px bg-[#00C853]/15"></div>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[11px] uppercase tracking-[1px] text-[#8AAABB] font-medium">Seleccionar líder <span class="text-[#00C853]">*</span></label>
                        <select class="form-input bg-[#182236] border border-[#00C853]/15 rounded-xl px-3.5 py-[11px] text-[#E8F4FF] text-[13.5px] w-full transition-all" name="leader_id" required>
                            <option value="" style="background:#111D30">— Selecciona un líder —</option>
                            <option value="1" style="background:#111D30">Luis Miguel Muñoz</option>
                            <option value="2" style="background:#111D30">Sebastián Grijalva</option>
                            <option value="3" style="background:#111D30">Juan David Quinchia</option>
                            <option value="4" style="background:#111D30">Sara Martínez</option>
                            <option value="5" style="background:#111D30">Camilo Restrepo</option>
                            <option value="6" style="background:#111D30">Daniela Ospina</option>
                        </select>
                    </div>
                </div>

                <!-- Sección: Equipo -->
                {{-- <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Equipo participante</span>
                        <div class="flex-1 h-px bg-[#00C853]/15"></div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <!-- Selected -->
                        <div class="member-chip selected flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all">
                            <div class="w-[26px] h-[26px] rounded-lg bg-gradient-to-br from-[#00963E] to-[#00C853] flex items-center justify-center font-syne font-extrabold text-[9px] text-[#0A1628]">LM</div>
                            <span class="text-[12.5px]">Luis Miguel</span>
                            <div class="mc-check w-4 h-4 rounded border border-[#8AAABB]/30 flex items-center justify-center ml-1">
                                <svg width="10" height="10" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" /></svg>
                            </div>
                        </div>
                        <div class="member-chip selected flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all">
                            <div class="w-[26px] h-[26px] rounded-lg bg-gradient-to-br from-[#0088CC] to-[#40C4FF] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">SG</div>
                            <span class="text-[12.5px]">Sebastián</span>
                            <div class="mc-check w-4 h-4 rounded border border-[#8AAABB]/30 flex items-center justify-center ml-1">
                                <svg width="10" height="10" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" /></svg>
                            </div>
                        </div>
                        <div class="member-chip selected flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all">
                            <div class="w-[26px] h-[26px] rounded-lg bg-gradient-to-br from-[#6C3DBF] to-[#9B59B6] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">JD</div>
                            <span class="text-[12.5px]">Juan David</span>
                            <div class="mc-check w-4 h-4 rounded border border-[#8AAABB]/30 flex items-center justify-center ml-1">
                                <svg width="10" height="10" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" /></svg>
                            </div>
                        </div>
                        <!-- Unselected -->
                        <div class="member-chip flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all">
                            <div class="w-[26px] h-[26px] rounded-lg bg-gradient-to-br from-[#E67E22] to-[#F39C12] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">SM</div>
                            <span class="text-[12.5px]">Sara M.</span>
                            <div class="mc-check w-4 h-4 rounded border border-[#8AAABB]/30 flex items-center justify-center ml-1"></div>
                        </div>
                        <div class="member-chip flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all">
                            <div class="w-[26px] h-[26px] rounded-lg bg-gradient-to-br from-[#16A085] to-[#1ABC9C] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">CR</div>
                            <span class="text-[12.5px]">Camilo R.</span>
                            <div class="mc-check w-4 h-4 rounded border border-[#8AAABB]/30 flex items-center justify-center ml-1"></div>
                        </div>
                    </div>
                </div> --}}

                <!-- Sección: Estado -->
                <div x-data="{ status: 'IN_PROGRESS' }">
                    <input type="hidden" name="status" :value="status">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Estado del proyecto</span>
                            <div class="flex-1 h-px bg-[#00C853]/15"></div>
                        </div>
                        <div class="flex gap-2">

                            <!-- EN PROGRESO -->
                            <div @click="status = 'IN_PROGRESS'" :class="status === 'IN_PROGRESS'
                ? 'bg-[#00C853]/20 border-[#00C853] text-[#00C853] shadow-lg scale-[1.02] flex flex-col items-center'
                : 'text-[#8AAABB] hover:bg-[#00C853]/10'" class="status-opt flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                <span class="block text-lg mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>

                                </span>En progreso
                            </div>

                            <!-- COMPLETADO -->
                            <div @click="status = 'COMPLETED'" :class="status === 'COMPLETED'
                ? 'bg-[#40C4FF]/20 border-[#40C4FF] text-[#40C4FF] shadow-lg scale-[1.02] flex flex-col items-center'
                : 'text-[#8AAABB] hover:bg-[#40C4FF]/10'" class="status-opt flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                <span class="block text-lg mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>

                                </span>Completado
                            </div>

                            <!-- RETRASADO -->
                            <div @click="status = 'DELAYED'" :class="status === 'DELAYED'
                ? 'bg-[#FFD740]/20 border-[#FFD740] text-[#FFD740] shadow-lg scale-[1.02] flex flex-col items-center'
                : 'text-[#8AAABB] hover:bg-[#FFD740]/10'" class="status-opt flex-1 px-3 py-2.5 rounded-xl border bg-[#182236] cursor-pointer text-center text-xs transition-all duration-200 flex flex-col items-center">
                                <span class="block text-lg mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                    </svg>
                                </span>Con retraso
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer - Fijo -->
        <div class="px-8 py-5 border-t border-[#00C853]/15 flex justify-end gap-2.5 shrink-0 bg-[#111D30]">
            <!-- Botón Cancelar con onclick directo -->
            <button onclick="if(window.closeProjectModal) window.closeProjectModal()" class="btn-ghost flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium text-[#8AAABB] bg-[#182236] border border-[#00C853]/15 cursor-pointer transition-all">
                Cancelar
            </button>
            <button class="btn-primary flex items-center gap-2 px-6 py-[11px] rounded-xl text-[13.5px] font-medium bg-[#00C853] text-[#0A1628] cursor-pointer transition-all" type="submit">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" /></svg>
                Crear proyecto
            </button>
        </div>

    </div>
</form>
