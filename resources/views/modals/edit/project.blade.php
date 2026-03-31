<!-- Modal Card - fully Tailwind, no custom CSS variables -->
<div class="w-full max-w-[620px] bg-[#111D30] border border-[rgba(0,200,83,0.15)] rounded-2xl overflow-hidden shadow-2xl relative">

    <!-- Header with gradient top bar -->
    <div class="relative pt-0.5">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#FFD740] to-[#00C853]"></div>
        <div class="px-8 pt-7 pb-6 border-b border-[rgba(0,200,83,0.15)] bg-[rgba(255,215,64,0.03)] flex items-start gap-4">
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
            <!-- Edit badge -->
            <div class="flex items-center gap-2 bg-[rgba(255,215,64,0.08)] border border-[rgba(255,215,64,0.2)] rounded-lg px-3 py-1.5 text-xs text-[#FFD740]">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                Modo edición
            </div>
            <!-- Close button -->
            <button class="absolute top-5 right-5 w-9 h-9 bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-lg flex items-center justify-center text-[#8AAABB] hover:text-[#E8F4FF] transition">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Modal Body -->
    <div class="px-8 py-7 space-y-6">

        <!-- Section: Información básica -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Información básica</span>
                <div class="flex-1 h-px bg-[rgba(0,200,83,0.15)]"></div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-[11px] uppercase tracking-wide text-[#8AAABB] font-medium mb-1.5">Nombre del
                        proyecto <span class="text-[#00C853]">*</span></label>
                    <input type="text" value="Sigpro Académico" class="w-full bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-4 py-2.5 text-[13.5px] text-[#E8F4FF] placeholder:text-[rgba(138,170,187,0.4)] focus:border-[rgba(255,215,64,0.5)] focus:bg-[rgba(255,215,64,0.02)] outline-none transition">
                </div>
                <div>
                    <label class="block text-[11px] uppercase tracking-wide text-[#8AAABB] font-medium mb-1.5">Descripción</label>
                    <textarea rows="3" class="w-full bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-4 py-2.5 text-[13.5px] text-[#E8F4FF] placeholder:text-[rgba(138,170,187,0.4)] focus:border-[rgba(255,215,64,0.5)] focus:bg-[rgba(255,215,64,0.02)] outline-none resize-y">Sistema de seguimiento y gestión educativa institucional para el Ministerio de Educación Nacional.</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] uppercase tracking-wide text-[#8AAABB] font-medium mb-1.5">Fecha inicio
                            <span class="text-[#00C853]">*</span></label>
                        <input type="date" value="2026-02-12" class="w-full bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-4 py-2.5 text-[13.5px] text-[#E8F4FF] focus:border-[rgba(255,215,64,0.5)] outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wide text-[#8AAABB] font-medium mb-1.5">Fecha entrega
                            <span class="text-[#00C853]">*</span></label>
                        <input type="date" value="2027-02-15" class="w-full bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-4 py-2.5 text-[13.5px] text-[#E8F4FF] focus:border-[rgba(255,215,64,0.5)] outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Estado del proyecto (status selector) -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Estado del proyecto</span>
                <div class="flex-1 h-px bg-[rgba(0,200,83,0.15)]"></div>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <button data-status="active" class="status-option flex flex-col items-center justify-center gap-1 py-2.5 rounded-xl border border-[rgba(0,200,83,0.15)] bg-[#182236] text-[#8AAABB] text-xs transition-all active-opt:bg-[rgba(0,200,83,0.1)] active-opt:border-[rgba(0,200,83,0.35)] active-opt:text-[#00C853]"><span class="text-lg">●</span>Activo</button>
                <button data-status="progress" class="status-option flex flex-col items-center justify-center gap-1 py-2.5 rounded-xl border border-[rgba(0,200,83,0.15)] bg-[#182236] text-[#8AAABB] text-xs transition-all active-opt:bg-[rgba(255,215,64,0.1)] active-opt:border-[rgba(255,215,64,0.35)] active-opt:text-[#FFD740]"><span class="text-lg">◑</span>En progreso</button>
                <button data-status="delay" class="status-option flex flex-col items-center justify-center gap-1 py-2.5 rounded-xl border border-[rgba(0,200,83,0.15)] bg-[#182236] text-[#8AAABB] text-xs transition-all active-opt:bg-[rgba(255,82,82,0.1)] active-opt:border-[rgba(255,82,82,0.35)] active-opt:text-[#FF5252]"><span class="text-lg">⚠</span>Con retraso</button>
            </div>
        </div>

        <!-- Líder del proyecto -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Líder del proyecto</span>
                <div class="flex-1 h-px bg-[rgba(0,200,83,0.15)]"></div>
            </div>
            <select class="w-full bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-4 py-2.5 text-[13.5px] text-[#E8F4FF] focus:border-[rgba(255,215,64,0.5)] outline-none">
                <option value="1" selected class="bg-[#111D30]">Luis Miguel Muñoz</option>
                <option value="2" class="bg-[#111D30]">Sebastián Grijalva</option>
                <option value="3" class="bg-[#111D30]">Juan David Quinchia</option>
                <option value="4" class="bg-[#111D30]">Sara Martínez</option>
                <option value="5" class="bg-[#111D30]">Camilo Restrepo</option>
                <option value="6" class="bg-[#111D30]">Daniela Ospina</option>
            </select>
        </div>

        <!-- Equipo participante (members) -->

        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Equipo participante</span>
                <div class="flex-1 h-px bg-[rgba(0,200,83,0.15)]"></div>
            </div>
            <div class="flex flex-wrap gap-2" id="membersContainer">
                <!-- member chips dynamically togglable -->
                <div data-member="LM" class="member-chip flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl bg-[#182236] border border-[rgba(0,200,83,0.15)] cursor-pointer transition-all selected:bg-[rgba(0,200,83,0.1)] selected:border-[rgba(0,200,83,0.35)]">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#00963E] to-[#00C853] flex items-center justify-center font-syne font-extrabold text-[9px] text-[#0A1628]">
                        LM</div>
                    <span class="text-xs text-[#E8F4FF]">Luis Miguel</span>
                    <div class="w-4 h-4 rounded border-2 border-[rgba(138,170,187,0.3)] flex items-center justify-center ml-1">
                        <svg class="check-svg w-3 h-3 hidden" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg></div>
                </div>
                <div data-member="SG" class="member-chip flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl bg-[#182236] border border-[rgba(0,200,83,0.15)] cursor-pointer transition-all selected:bg-[rgba(0,200,83,0.1)] selected:border-[rgba(0,200,83,0.35)]">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#0088CC] to-[#40C4FF] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">
                        SG</div>
                    <span class="text-xs text-[#E8F4FF]">Sebastián</span>
                    <div class="w-4 h-4 rounded border-2 border-[rgba(138,170,187,0.3)] flex items-center justify-center ml-1">
                        <svg class="check-svg w-3 h-3 hidden" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg></div>
                </div>
                <div data-member="JD" class="member-chip flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl bg-[#182236] border border-[rgba(0,200,83,0.15)] cursor-pointer transition-all selected:bg-[rgba(0,200,83,0.1)] selected:border-[rgba(0,200,83,0.35)]">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#6C3DBF] to-[#9B59B6] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">
                        JD</div>
                    <span class="text-xs text-[#E8F4FF]">Juan David</span>
                    <div class="w-4 h-4 rounded border-2 border-[rgba(138,170,187,0.3)] flex items-center justify-center ml-1">
                        <svg class="check-svg w-3 h-3 hidden" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg></div>
                </div>
                <div data-member="SM" class="member-chip flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl bg-[#182236] border border-[rgba(0,200,83,0.15)] cursor-pointer transition-all selected:bg-[rgba(0,200,83,0.1)] selected:border-[rgba(0,200,83,0.35)]">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#E67E22] to-[#F39C12] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">
                        SM</div>
                    <span class="text-xs text-[#E8F4FF]">Sara M.</span>
                    <div class="w-4 h-4 rounded border-2 border-[rgba(138,170,187,0.3)] flex items-center justify-center ml-1">
                        <svg class="check-svg w-3 h-3 hidden" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg></div>
                </div>
                <div data-member="CR" class="member-chip flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl bg-[#182236] border border-[rgba(0,200,83,0.15)] cursor-pointer transition-all selected:bg-[rgba(0,200,83,0.1)] selected:border-[rgba(0,200,83,0.35)]">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#16A085] to-[#1ABC9C] flex items-center justify-center font-syne font-extrabold text-[9px] text-white">
                        CR</div>
                    <span class="text-xs text-[#E8F4FF]">Camilo R.</span>
                    <div class="w-4 h-4 rounded border-2 border-[rgba(138,170,187,0.3)] flex items-center justify-center ml-1">
                        <svg class="check-svg w-3 h-3 hidden" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg></div>
                </div>
            </div>
        </div>

        <!-- Avance del proyecto -->

        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB]">Avance del proyecto</span>
                <div class="flex-1 h-px bg-[rgba(0,200,83,0.15)]"></div>
            </div>
            <div>
                <label class="block text-[11px] uppercase tracking-wide text-[#8AAABB] font-medium mb-1.5">Porcentaje de
                    avance</label>
                <div class="flex items-center gap-3">
                    <input type="number" id="progressInput" min="0" max="100" value="50" class="w-24 bg-[#182236] border border-[rgba(0,200,83,0.15)] rounded-xl px-3 py-2 text-center text-[13.5px] text-[#E8F4FF] focus:border-[rgba(255,215,64,0.5)] outline-none">
                    <div class="flex-1 h-2 bg-white/5 rounded-full overflow-hidden">
                        <div id="progressFill" class="h-full bg-gradient-to-r from-[#00963E] to-[#00C853] rounded-full progress-transition" style="width: 50%"></div>
                    </div>
                    <span class="text-sm text-[#8AAABB]">%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Footer -->

    <div class="px-8 py-5 border-t border-[rgba(0,200,83,0.15)] flex flex-wrap items-center justify-between gap-4">
        <div class="text-[11px] text-[#8AAABB]">Última modificación: <b class="text-[#FFD740]">Hoy, 3:42 PM</b></div>
        <div class="flex gap-2">
            <button id="cancelBtn" class="px-5 py-2.5 rounded-xl bg-[#182236] text-[#8AAABB] border border-[rgba(0,200,83,0.15)] text-sm font-medium hover:text-[#E8F4FF] transition">Cancelar</button>
            <button id="deleteBtn" class="px-5 py-2.5 rounded-xl bg-[rgba(255,82,82,0.08)] text-[#FF5252] border border-[rgba(255,82,82,0.2)] text-sm font-medium hover:bg-[rgba(255,82,82,0.15)] flex items-center gap-2 transition">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                </svg>
                Eliminar
            </button>
            <button id="saveBtn" class="px-5 py-2.5 rounded-xl bg-[#00C853] text-[#0A1628] text-sm font-semibold hover:bg-[#00E060] shadow-md transition flex items-center gap-2">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
                Guardar cambios
            </button>
        </div>
    </div>
</div>

<!-- Toast notification (simple) -->
<div id="toast" class="fixed bottom-6 right-6 bg-[#1C2A40] border border-[rgba(0,200,83,0.3)] rounded-xl px-4 py-3 text-sm text-[#E8F4FF] flex items-center gap-2 shadow-xl translate-y-24 opacity-0 toast-transition z-50 pointer-events-none">
    <div class="w-2 h-2 bg-[#00C853] rounded-full"></div>
    <span id="toastMsg">Guardado correctamente</span>
</div>

<script>
    // Initialize: set first status as active (default)
    const statusBtns = document.querySelectorAll('.status-option');
    const members = document.querySelectorAll('.member-chip');
    const progressInput = document.getElementById('progressInput');
    const progressFill = document.getElementById('progressFill');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const deleteBtn = document.getElementById('deleteBtn');
    const toast = document.getElementById('toast');
    const toastMsg = document.getElementById('toastMsg');

    // ---- Helper: show toast message ----
    function showToast(message) {
        toastMsg.innerText = message;
        toast.classList.remove('translate-y-24', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');
        setTimeout(() => {
            toast.classList.add('translate-y-24', 'opacity-0');
            toast.classList.remove('translate-y-0', 'opacity-100');
        }, 2500);
    }

    // ---- Status selection logic ----
    // By default, mark "Activo" as active (matching original)
    statusBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active styles from all
            statusBtns.forEach(b => {
                b.classList.remove('bg-[rgba(0,200,83,0.1)]', 'border-[rgba(0,200,83,0.35)]', 'text-[#00C853]'
                    , 'bg-[rgba(255,215,64,0.1)]', 'border-[rgba(255,215,64,0.35)]', 'text-[#FFD740]'
                    , 'bg-[rgba(255,82,82,0.1)]', 'border-[rgba(255,82,82,0.35)]', 'text-[#FF5252]');
                b.classList.add('bg-[#182236]', 'border-[rgba(0,200,83,0.15)]', 'text-[#8AAABB]');
            });
            // apply specific class based on status type
            if (btn.getAttribute('data-status') === 'active') {
                btn.classList.add('bg-[rgba(0,200,83,0.1)]', 'border-[rgba(0,200,83,0.35)]', 'text-[#00C853]');
            } else if (btn.getAttribute('data-status') === 'progress') {
                btn.classList.add('bg-[rgba(255,215,64,0.1)]', 'border-[rgba(255,215,64,0.35)]', 'text-[#FFD740]');
            } else if (btn.getAttribute('data-status') === 'delay') {
                btn.classList.add('bg-[rgba(255,82,82,0.1)]', 'border-[rgba(255,82,82,0.35)]', 'text-[#FF5252]');
            }
        });
    });
    // set active default (Activo)
    const defaultActive = document.querySelector('[data-status="active"]');
    if (defaultActive) defaultActive.click();

    // ---- Member chips toggling ----
    function updateMemberUI(chip) {
        const isSelected = chip.classList.contains('selected');
        const checkSvg = chip.querySelector('.check-svg');
        if (isSelected) {
            chip.classList.remove('selected');
            chip.classList.remove('bg-[rgba(0,200,83,0.1)]', 'border-[rgba(0,200,83,0.35)]');
            chip.classList.add('bg-[#182236]', 'border-[rgba(0,200,83,0.15)]');
            if (checkSvg) checkSvg.classList.add('hidden');
        } else {
            chip.classList.add('selected');
            chip.classList.add('bg-[rgba(0,200,83,0.1)]', 'border-[rgba(0,200,83,0.35)]');
            chip.classList.remove('bg-[#182236]', 'border-[rgba(0,200,83,0.15)]');
            if (checkSvg) checkSvg.classList.remove('hidden');
        }
    }

    // Initialize all members: first three are selected (LM, SG, JD)
    members.forEach((chip, idx) => {
        const memberId = chip.getAttribute('data-member');
        if (memberId === 'LM' || memberId === 'SG' || memberId === 'JD') {
            chip.classList.add('selected');
            chip.classList.add('bg-[rgba(0,200,83,0.1)]', 'border-[rgba(0,200,83,0.35)]');
            chip.classList.remove('bg-[#182236]', 'border-[rgba(0,200,83,0.15)]');
            const checkSvg = chip.querySelector('.check-svg');
            if (checkSvg) checkSvg.classList.remove('hidden');
        } else {
            chip.classList.remove('selected');
            chip.classList.add('bg-[#182236]', 'border-[rgba(0,200,83,0.15)]');
            const checkSvg = chip.querySelector('.check-svg');
            if (checkSvg) checkSvg.classList.add('hidden');
        }
        chip.addEventListener('click', (e) => {
            e.stopPropagation();
            updateMemberUI(chip);
        });
    });

    // ---- Progress slider & input sync ----
    function updateProgress(value) {
        let v = Math.min(100, Math.max(0, parseInt(value) || 0));
        progressFill.style.width = v + '%';
        progressInput.value = v;
    }
    progressInput.addEventListener('input', (e) => updateProgress(e.target.value));
    updateProgress(50);

    // ---- Save action (with simulated save + toast) ----
    saveBtn.addEventListener('click', () => {
        // Gather data for simulation
        const projectName = document.querySelector('input[type="text"]').value;
        const description = document.querySelector('textarea').value;
        const startDate = document.querySelector('input[type="date"]:first-of-type').value;
        const endDate = document.querySelectorAll('input[type="date"]')[1].value;
        const leader = document.querySelector('select').value;
        const selectedMembers = Array.from(document.querySelectorAll('.member-chip.selected')).map(c => c.getAttribute('data-member'));
        const progressVal = progressInput.value;
        let activeStatus = "Activo";
        statusBtns.forEach(btn => {
            if (btn.classList.contains('bg-[rgba(0,200,83,0.1)]') || btn.classList.contains('bg-[rgba(255,215,64,0.1)]') || btn.classList.contains('bg-[rgba(255,82,82,0.1)]')) {
                if (btn.innerText.includes('Activo')) activeStatus = "Activo";
                else if (btn.innerText.includes('En progreso')) activeStatus = "En progreso";
                else if (btn.innerText.includes('Con retraso')) activeStatus = "Con retraso";
            }
        });
        console.log("Guardado:", {
            projectName
            , description
            , startDate
            , endDate
            , leader
            , selectedMembers
            , progress: progressVal
            , status: activeStatus
        });
        showToast("✓ Cambios guardados correctamente");
    });

    // ---- Cancel action ----
    cancelBtn.addEventListener('click', () => {
        showToast("Edición cancelada");
        // optional: reset form simulation
    });

    // ---- Delete action ----
    deleteBtn.addEventListener('click', () => {
        if (confirm("¿Eliminar este proyecto permanentemente?")) {
            showToast("🗑 Proyecto eliminado (simulación)");
        }
    });

    // Close button (X) behaviour
    const closeBtn = document.querySelector('.close-btn');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => showToast("Ventana cerrada (demo)"));
    }

</script>

