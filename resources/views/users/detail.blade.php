@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- HERO CARD -->
<div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 transition-all relative">
    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-500 to-sky-400 rounded-t-2xl"></div>

    <!-- Banner -->
    <div class="h-28 relative overflow-hidden" style="background:linear-gradient(135deg,#0e1a2d 0%,#111d30 50%,#0e1a2d 100%)">
        <div class="absolute inset-0" style="background:radial-gradient(ellipse at 20% 50%,rgba(0,200,83,0.12) 0%,transparent 60%),radial-gradient(ellipse at 80% 30%,rgba(56,189,248,0.08) 0%,transparent 50%)"></div>
        <div class="absolute inset-0" style="background-image:linear-gradient(rgba(0,200,83,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(0,200,83,0.04) 1px,transparent 1px);background-size:32px 32px"></div>
        <div class="absolute right-8 top-1/2 -translate-y-1/2 font-black text-6xl tracking-widest pointer-events-none select-none" style="font-family:'Syne',sans-serif;color:rgba(255,255,255,0.025)">SIGPRO</div>
    </div>

    <!-- Body -->
    <div class="px-8 pb-7 flex items-end gap-6 -mt-9 relative z-10">
        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-700 to-emerald-400 border-4 border-[#1C2A40] flex items-center justify-center font-black text-3xl text-slate-900 shrink-0 shadow-xl shadow-emerald-500/20" style="font-family:'Syne',sans-serif">LM</div>
        <div class="flex-1 pt-11">
            <h1 class="font-black text-3xl leading-tight" style="font-family:'Syne',sans-serif">Luis Miguel Muñoz</h1>
            <p class="text-sm text-slate-400 mt-1">luis.munoz@sigpro.edu.co</p>
            <div class="flex gap-2 mt-2.5 flex-wrap items-center">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/12 text-emerald-400 border border-emerald-500/25">
                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="20 6 9 17 4 12" /></svg>
                    Activo
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-yellow-400/12 text-yellow-400 border border-yellow-400/25">
                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5z" />
                        <path d="M2 17l10 5 10-5M2 12l10 5 10-5" /></svg>
                    Líder de Proyecto
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-sky-400/12 text-sky-400 border border-sky-400/25">
                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" /></svg>
                    Desde 12/02/2026
                </span>
            </div>
        </div>
        <div class="flex gap-2 pt-12 shrink-0">
            <button class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-[#182236] text-slate-400 border border-[#00C853]/20 hover:text-slate-100 hover:border-[#00C853]/40 cursor-pointer transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
                Editar perfil
            </button>
            <button class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-red-500/8 text-red-400 border border-red-500/20 hover:bg-red-500/15 cursor-pointer transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" /></svg>
                Eliminar
            </button>
        </div>
    </div>
</div>

<!-- STATS -->
<div class="grid grid-cols-4 gap-4">

    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-5 py-4 relative overflow-hidden hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-lg hover:shadow-black/30 transition-all">
        <div class="absolute top-0 left-0 right-0 h-0.5 bg-emerald-500 rounded-t-2xl"></div>
        <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" /></svg>
        </div>
        <div class="font-black text-3xl leading-none" style="font-family:'Syne',sans-serif">3</div>
        <div class="text-xs text-slate-400 mt-1 uppercase tracking-wider">Proyectos asignados</div>
    </div>

    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-5 py-4 relative overflow-hidden hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-lg hover:shadow-black/30 transition-all">
        <div class="absolute top-0 left-0 right-0 h-0.5 bg-yellow-400 rounded-t-2xl"></div>
        <div class="w-9 h-9 rounded-xl bg-yellow-400/10 text-yellow-400 flex items-center justify-center mb-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5z" />
                <path d="M2 17l10 5 10-5M2 12l10 5 10-5" /></svg>
        </div>
        <div class="font-black text-3xl leading-none" style="font-family:'Syne',sans-serif">2</div>
        <div class="text-xs text-slate-400 mt-1 uppercase tracking-wider">Proyectos liderados</div>
    </div>

    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-5 py-4 relative overflow-hidden hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-lg hover:shadow-black/30 transition-all">
        <div class="absolute top-0 left-0 right-0 h-0.5 bg-sky-400 rounded-t-2xl"></div>
        <div class="w-9 h-9 rounded-xl bg-sky-400/10 text-sky-400 flex items-center justify-center mb-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" /></svg>
        </div>
        <div class="font-black text-3xl leading-none" style="font-family:'Syne',sans-serif">5</div>
        <div class="text-xs text-slate-400 mt-1 uppercase tracking-wider">Compañeros de equipo</div>
    </div>

    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-5 py-4 relative overflow-hidden hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-lg hover:shadow-black/30 transition-all">
        <div class="absolute top-0 left-0 right-0 h-0.5 bg-emerald-500 rounded-t-2xl"></div>
        <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" /></svg>
        </div>
        <div class="font-black text-3xl leading-none" style="font-family:'Syne',sans-serif">50<span class="text-base font-semibold text-slate-400">%</span></div>
        <div class="text-xs text-slate-400 mt-1 uppercase tracking-wider">Avance promedio</div>
    </div>

</div>

<!-- MAIN GRID -->
<div class="grid gap-5" style="grid-template-columns:340px 1fr">

    <!-- LEFT COL -->
    <div class="flex flex-col gap-5">

        <!-- Datos personales -->
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/25 transition-all">
            <div class="px-5 py-4 border-b border-[#00C853]/10 bg-[#111D30]/60 flex items-center gap-2">
                <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400" style="font-family:'Syne',sans-serif">Datos <span class="text-emerald-400">Personales</span></h3>
            </div>
            <div class="p-5 flex flex-col">

                <div class="flex items-start gap-3.5 py-3 border-b border-[#2b2b2b]">
                    <div class="w-8 h-8 rounded-lg bg-[#182236] border border-[#00C853]/15 flex items-center justify-center text-slate-400 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                            <circle cx="12" cy="7" r="4" /></svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-500">Nombre completo</p>
                        <p class="text-sm font-medium mt-0.5">Luis Miguel Muñoz</p>
                    </div>
                </div>

                <div class="flex items-start gap-3.5 py-3 border-b border-[#2b2b2b]">
                    <div class="w-8 h-8 rounded-lg bg-[#182236] border border-[#00C853]/15 flex items-center justify-center text-slate-400 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" /></svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-500">Correo electrónico</p>
                        <p class="text-sm font-medium mt-0.5">luis.munoz@sigpro.edu.co</p>
                    </div>
                </div>

                <div class="flex items-start gap-3.5 py-3 border-b border-[#2b2b2b]">
                    <div class="w-8 h-8 rounded-lg bg-[#182236] border border-[#00C853]/15 flex items-center justify-center text-slate-400 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" /></svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-500">Fecha de ingreso</p>
                        <p class="text-sm font-medium mt-0.5">12 de Febrero, 2026</p>
                    </div>
                </div>

                <div class="flex items-start gap-3.5 py-3 border-b border-[#2b2b2b]">
                    <div class="w-8 h-8 rounded-lg bg-[#182236] border border-[#00C853]/15 flex items-center justify-center text-slate-400 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                            <polyline points="14 2 14 8 20 8" /></svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-500">Documento</p>
                        <p class="text-sm font-medium mt-0.5">1.234.567.890</p>
                    </div>
                </div>

                <div class="flex items-start gap-3.5 py-3 border-b border-[#2b2b2b]">
                    <div class="w-8 h-8 rounded-lg bg-[#182236] border border-[#00C853]/15 flex items-center justify-center text-slate-400 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" /></svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-500">Último acceso</p>
                        <p class="text-sm font-medium mt-0.5">Hoy, 9:42 AM</p>
                    </div>
                </div>

                <div class="flex items-start gap-3.5 pt-3">
                    <div class="w-8 h-8 rounded-lg bg-[#182236] border border-[#00C853]/15 flex items-center justify-center text-slate-400 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="20 6 9 17 4 12" /></svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-500">Estado de la cuenta</p>
                        <span class="inline-flex items-center gap-1.5 mt-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/12 text-emerald-400 border border-emerald-500/25">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Activo
                        </span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Rol y permisos -->
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/25 transition-all">
            <div class="px-5 py-4 border-b border-[#00C853]/10 bg-[#111D30]/60">
                <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400" style="font-family:'Syne',sans-serif">Rol y <span class="text-emerald-400">Permisos</span></h3>
            </div>
            <div class="p-5">
                <!-- Role box -->
                <div class="bg-emerald-500/8 border border-emerald-500/20 rounded-xl p-4 flex items-center gap-3.5 mb-4">
                    <div class="w-11 h-11 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M6 20v-2a4 4 0 018 0v2" />
                            <path d="M18 8l2 2-4 4" /></svg>
                    </div>
                    <div>
                        <p class="font-bold text-emerald-400" style="font-family:'Syne',sans-serif">Líder de Proyecto</p>
                        <p class="text-xs text-slate-400 mt-0.5">Gestión completa de proyectos asignados</p>
                    </div>
                </div>
                <!-- Permisos -->
                <div class="flex flex-col gap-2.5">
                    <div class="flex items-center gap-2.5 text-sm">
                        <div class="w-5 h-5 rounded-md bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center shrink-0">
                            <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" /></svg>
                        </div>
                        Crear y editar proyectos
                    </div>
                    <div class="flex items-center gap-2.5 text-sm">
                        <div class="w-5 h-5 rounded-md bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center shrink-0">
                            <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" /></svg>
                        </div>
                        Asignar miembros al equipo
                    </div>
                    <div class="flex items-center gap-2.5 text-sm">
                        <div class="w-5 h-5 rounded-md bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center shrink-0">
                            <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" /></svg>
                        </div>
                        Actualizar avance del Gantt
                    </div>
                    <div class="flex items-center gap-2.5 text-sm text-slate-500">
                        <div class="w-5 h-5 rounded-md bg-[#182236] border border-[#2b2b2b] flex items-center justify-center shrink-0">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" /></svg>
                        </div>
                        Administrar usuarios
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- RIGHT COL -->
    <div class="flex flex-col gap-5">

        <!-- Proyectos asignados -->
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/25 transition-all">
            <div class="px-5 py-4 border-b border-[#00C853]/10 bg-[#111D30]/60 flex items-center justify-between">
                <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400" style="font-family:'Syne',sans-serif">Proyectos <span class="text-emerald-400">Asignados</span></h3>
                <span class="text-xs text-slate-500">3 proyectos</span>
            </div>
            <div class="p-5 flex flex-col gap-3">

                <div class="flex items-center gap-3.5 bg-[#182236] border border-[#00C853]/15 rounded-xl px-4 py-3.5 hover:border-[#00C853]/30 hover:bg-emerald-500/5 transition-all">
                    <div class="w-1 h-10 rounded bg-emerald-400 shrink-0"></div>
                    <div class="flex-1">
                        <p class="font-bold text-sm" style="font-family:'Syne',sans-serif">Sigpro Académico</p>
                        <p class="text-xs text-slate-400 mt-0.5">Sistema de seguimiento educativo</p>
                    </div>
                    <div class="flex flex-col items-end gap-1.5">
                        <span class="px-2 py-0.5 rounded-md text-xs font-semibold uppercase tracking-wide bg-emerald-500/12 text-emerald-400 border border-emerald-500/20">Líder</span>
                        <span class="font-black text-sm text-emerald-400" style="font-family:'Syne',sans-serif">50%</span>
                        <div class="w-20 h-1 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-400 rounded-full" style="width:50%"></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3.5 bg-[#182236] border border-[#00C853]/15 rounded-xl px-4 py-3.5 hover:border-[#00C853]/30 hover:bg-emerald-500/5 transition-all">
                    <div class="w-1 h-10 rounded bg-yellow-400 shrink-0"></div>
                    <div class="flex-1">
                        <p class="font-bold text-sm" style="font-family:'Syne',sans-serif">Portería Sigpro</p>
                        <p class="text-xs text-slate-400 mt-0.5">Sistema de acceso institucional</p>
                    </div>
                    <div class="flex flex-col items-end gap-1.5">
                        <span class="px-2 py-0.5 rounded-md text-xs font-semibold uppercase tracking-wide bg-emerald-500/12 text-emerald-400 border border-emerald-500/20">Líder</span>
                        <span class="font-black text-sm text-yellow-400" style="font-family:'Syne',sans-serif">0%</span>
                        <div class="w-20 h-1 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full bg-yellow-400 rounded-full" style="width:0%"></div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3.5 bg-[#182236] border border-[#00C853]/15 rounded-xl px-4 py-3.5 hover:border-[#00C853]/30 hover:bg-emerald-500/5 transition-all">
                    <div class="w-1 h-10 rounded bg-sky-400 shrink-0"></div>
                    <div class="flex-1">
                        <p class="font-bold text-sm" style="font-family:'Syne',sans-serif">Emprender</p>
                        <p class="text-xs text-slate-400 mt-0.5">Plataforma de emprendimiento local</p>
                    </div>
                    <div class="flex flex-col items-end gap-1.5">
                        <span class="px-2 py-0.5 rounded-md text-xs font-semibold uppercase tracking-wide bg-sky-400/12 text-sky-400 border border-sky-400/20">Miembro</span>
                        <span class="font-black text-sm text-sky-400" style="font-family:'Syne',sans-serif">0%</span>
                        <div class="w-20 h-1 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full bg-sky-400 rounded-full" style="width:0%"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Equipo de trabajo -->
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/25 transition-all">
            <div class="px-5 py-4 border-b border-[#00C853]/10 bg-[#111D30]/60 flex items-center justify-between">
                <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400" style="font-family:'Syne',sans-serif">Equipo de <span class="text-emerald-400">Trabajo</span></h3>
                <span class="text-xs text-slate-500">5 compañeros</span>
            </div>
            <div class="p-5 flex flex-col gap-2">

                <div class="flex items-center gap-3 px-3.5 py-2.5 bg-[#182236]  border border-[#00C853]/15 rounded-xl hover:border-[#00C853]/25 hover:bg-emerald-500/5 transition-all">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-sky-700 to-sky-400 flex items-center justify-center font-black text-xs text-white shrink-0" style="font-family:'Syne',sans-serif">SG</div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Sebastián Grijalva</p>
                        <p class="text-xs text-slate-400">Líder · Gimnasio, Parking</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-md text-xs font-semibold uppercase tracking-wide bg-emerald-500/12 text-emerald-400 border border-emerald-500/20">Líder</span>
                </div>

                <div class="flex items-center gap-3 px-3.5 py-2.5 bg-[#182236] border border-[#00C853]/15 rounded-xl hover:border-[#00C853]/25 hover:bg-emerald-500/5 transition-all">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-violet-700 to-violet-400 flex items-center justify-center font-black text-xs text-white shrink-0" style="font-family:'Syne',sans-serif">JD</div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Juan David Quinchia</p>
                        <p class="text-xs text-slate-400">Miembro · 3 proyectos</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-md text-xs font-semibold uppercase tracking-wide bg-sky-400/12 text-sky-400 border border-sky-400/20">Miembro</span>
                </div>

                <div class="flex items-center gap-3 px-3.5 py-2.5 bg-[#182236] border border-[#00C853]/15 rounded-xl hover:border-[#00C853]/25 hover:bg-emerald-500/5 transition-all">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-orange-600 to-amber-400 flex items-center justify-center font-black text-xs text-white shrink-0" style="font-family:'Syne',sans-serif">SM</div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Sara Martínez</p>
                        <p class="text-xs text-slate-400">Miembro · Emprender</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-md text-xs font-semibold uppercase tracking-wide bg-sky-400/12 text-sky-400 border border-sky-400/20">Miembro</span>
                </div>

                <div class="flex items-center gap-3 px-3.5 py-2.5 bg-[#182236] border border-[#00C853]/15 rounded-xl hover:border-[#00C853]/25 hover:bg-emerald-500/5 transition-all">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-teal-700 to-teal-400 flex items-center justify-center font-black text-xs text-white shrink-0" style="font-family:'Syne',sans-serif">CR</div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Camilo Restrepo</p>
                        <p class="text-xs text-slate-400">Miembro · Portería Sigpro</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-md text-xs font-semibold uppercase tracking-wide bg-sky-400/12 text-sky-400 border border-sky-400/20">Miembro</span>
                </div>

                <div class="flex items-center gap-3 px-3.5 py-2.5 bg-[#182236] border border-[#00C853]/15 rounded-xl hover:border-[#00C853]/25 hover:bg-emerald-500/5 transition-all">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-red-700 to-red-400 flex items-center justify-center font-black text-xs text-white shrink-0" style="font-family:'Syne',sans-serif">DO</div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">Daniela Ospina</p>
                        <p class="text-xs text-slate-400">Miembro · 2 proyectos</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-md text-xs font-semibold uppercase tracking-wide bg-sky-400/12 text-sky-400 border border-sky-400/20">Miembro</span>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
