@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div x-data="{ modalEditarAbierto: false, modalEliminarAbierto: false }" class="flex flex-col gap-6">
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 relative transition-all">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-500 to-sky-400 rounded-t-2xl">
        </div>
        <div class="flex items-start justify-between mb-6 relative z-10 px-8 py-7">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-700 to-emerald-400 flex items-center justify-center font-black text-lg text-slate-900 shrink-0" style="font-family:'Syne',sans-serif">SA</div>
                <div>
                    <h1 class="font-black text-2xl leading-tight" style="font-family:'Syne',sans-serif">Sigpro Académico
                    </h1>
                    <p class="text-sm text-slate-400 mt-1">Sistema de seguimiento y gestión educativa institucional</p>
                    <div class="flex gap-2 mt-2.5 flex-wrap">
                        <span class="px-3 py-0.5 rounded-full text-xs font-medium bg-emerald-500/15 text-emerald-400 border border-emerald-500/30">●
                            Activo</span>
                        <span class="px-3 py-0.5 rounded-full text-xs font-medium bg-sky-400/15 text-sky-400 border border-sky-400/30">Educación</span>
                        <span class="px-3 py-0.5 rounded-full text-xs font-medium bg-yellow-400/15 text-yellow-400 border border-yellow-400/30">50%
                            completado</span>
                    </div>
                </div>
            </div>
            <div class="flex gap-2 shrink-0">
                <!-- Botón Editar con Alpine -->
                <button @click="modalEditarAbierto = true" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-slate-800 text-slate-400 border border-emerald-500/20 hover:text-slate-100 hover:border-emerald-500/40 cursor-pointer transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                    Editar
                </button>
                <button @click="modalEliminarAbierto = true" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-red-500/8 text-red-400 border border-red-500/20 hover:bg-red-500/15 cursor-pointer transition-all">

                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                    </svg>

                    Eliminar
                </button>
            </div>
        </div>
        <div class="grid grid-cols-5 gap-5 relative z-10 px-8 pb-5">
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-400 mb-1.5">Fecha Inicio</p>
                <p class="text-sm font-medium">12 Feb 2026</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-400 mb-1.5">Fecha Entrega</p>
                <p class="text-sm font-medium">15 Feb 2027</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-400 mb-1.5">Líder</p>
                <p class="text-sm font-medium">Luis Miguel M.</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-400 mb-1.5">Reuniones</p>
                <p class="text-sm font-bold text-emerald-400" style="font-family:'Syne',sans-serif">8 realizadas</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-400 mb-1.5">Días restantes</p>
                <p class="text-sm font-bold text-yellow-400" style="font-family:'Syne',sans-serif">346 días</p>
            </div>
        </div>
        <div class="mt-5 pt-5 border-t border-emerald-500/20 relative z-10 px-8">
            <div class="flex justify-between items-center mb-2">
                <span class="text-xs uppercase tracking-widest text-slate-400">Avance general del proyecto</span>
                <span id="pct-display" class="font-black text-lg text-emerald-400" style="font-family:'Syne',sans-serif">50%</span>
            </div>
            <div class="w-full h-2 bg-white/5 rounded-full overflow-hidden">
                <div id="main-progress" class="h-full bg-gradient-to-r from-emerald-700 to-emerald-400 rounded-full transition-all duration-1000" style="width:50%"></div>
            </div>
        </div>
        <div class="mt-5 pt-5 pb-7 px-8 border-t border-emerald-500/20 flex items-center gap-3 relative z-10">
            <span class="text-xs uppercase tracking-widest text-slate-400 shrink-0">Equipo:</span>
            <div class="flex gap-1.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-700 to-emerald-400 border-2 border-slate-800 flex items-center justify-center font-black text-xs text-slate-900" style="font-family:'Syne',sans-serif" title="Luis Miguel Muñoz">LM</div>
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-sky-700 to-sky-400 border-2 border-slate-800 flex items-center justify-center font-black text-xs text-slate-900" style="font-family:'Syne',sans-serif" title="Sebastián Grijalva">SG</div>
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-violet-700 to-violet-400 border-2 border-slate-800 flex items-center justify-center font-black text-xs text-white" style="font-family:'Syne',sans-serif" title="Juan David Quinchia">JD</div>
            </div>
            <span class="text-sm text-slate-400">Luis Miguel Muñoz · Sebastián Grijalva · Juan David Quinchia</span>
        </div>
    </div>

    <!-- GANTT -->
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 transition-all">

        <!-- Gantt header bar -->
        <div class="px-6 py-5 border-b border-[#00C853]/15 bg-[#111D30]/60 flex items-center justify-between gap-4 flex-wrap">
            <div>
                <h2 class="font-bold text-base" style="font-family:'Syne',sans-serif">Cronograma <span class="text-emerald-400">Gantt</span></h2>
                <p class="text-xs text-slate-500 mt-0.5">Click = planificado · Doble click = completado · Click derecho =
                    limpiar</p>
            </div>
            <div class="flex items-center gap-1 bg-[#111D30] border border-[#00C853]/20 rounded-xl p-1">
                <button onclick="prevMonth()" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/10 cursor-pointer transition-all bg-transparent border-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                </button>
                <select id="monthJump" onchange="jumpToMonth(this.value)" class="bg-[#111D30] border border-[#00C853]/20 text-slate-100 text-xs px-2.5 py-1.5 rounded-lg outline-none cursor-pointer">
                </select>
                <button onclick="nextMonth()" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/10 cursor-pointer transition-all bg-transparent border-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                </button>
                <div class="w-px h-5 bg-[#00C853]/20 mx-0.5"></div>
                <button onclick="goToday()" class="px-3 h-8 rounded-lg text-xs text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/10 cursor-pointer transition-all bg-transparent border-none whitespace-nowrap font-medium">
                    Hoy
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="border-collapse" style="width:max-content;min-width:100%">
                <thead>
                    <tr>
                        <!-- FASES -->
                        <th rowspan="2" class="text-[10px] font-bold tracking-[2px] text-emerald-400 px-3 py-2 border border-[#2b2b2b] text-center whitespace-nowrap" style="font-family:'Syne',sans-serif;min-width:90px;background:#0e1a2d">
                            FASES
                        </th>
                        <!-- ACTIVIDADES -->
                        <th rowspan="2" class="text-[10px] font-bold tracking-[2px] text-emerald-400 px-3 py-2 border border-[#2b2b2b] text-center" style="font-family:'Syne',sans-serif;min-width:210px;background:#0e1a2d">
                            ACTIVIDADES
                        </th>
                        <!-- REUNIONES -->
                        <th rowspan="2" class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 px-2.5 py-2 border border-[#2b2b2b] text-center" style="min-width:72px;background:#111d30">
                            REUNIONES
                        </th>
                        <!-- FECHA INICIO -->
                        <th rowspan="2" class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 px-2.5 py-2 border border-[#2b2b2b] text-center" style="min-width:100px;background:#111d30">
                            FECHA INICIO
                        </th>
                        <!-- FECHA FIN -->
                        <th rowspan="2" class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 px-2.5 py-2 border border-[#2b2b2b] text-center" style="min-width:100px;background:#111d30">
                            FECHA FIN
                        </th>
                        <!-- Week headers -->
                        <th class="text-[10px] font-bold text-slate-300 border border-[#2b2b2b] text-center" style="width:56px;min-width:56px;padding:10px 0;background:#0e1a2d">S1</th>
                        <th class="text-[10px] font-bold text-slate-300 border border-[#2b2b2b] text-center" style="width:56px;min-width:56px;padding:10px 0;background:#0e1a2d">S2</th>
                        <th class="text-[10px] font-bold text-slate-300 border border-[#2b2b2b] text-center" style="width:56px;min-width:56px;padding:10px 0;background:#0e1a2d">S3</th>
                        <th class="text-[10px] font-bold text-slate-300 border border-[#2b2b2b] text-center" style="width:56px;min-width:56px;padding:10px 0;background:#0e1a2d">S4</th>
                    </tr>
                    <tr>
                        <th id="monthColLabel" colspan="4" class="text-[10px] font-bold text-emerald-400 tracking-widest uppercase border border-[#00C853]/15 text-center py-2" style="font-family:'Syne',sans-serif;background:rgba(0,200,83,.08)">
                            —
                        </th>
                    </tr>
                </thead>
                <tbody id="ganttBody"></tbody>
            </table>
        </div>

        <!-- Add activity -->
        <button onclick="addActivity()" class="w-full flex items-center gap-2 px-6 py-2.5 border-t border-[#00C853]/10 text-xs text-slate-500 hover:text-emerald-400 hover:bg-emerald-500/5 cursor-pointer transition-all bg-transparent">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Agregar actividad
        </button>

        <!-- Legend -->
        <div class="flex items-center gap-5 px-6 py-3 border-t border-[#00C853]/10" style="background:#0e1a2d">
            <div class="flex items-center gap-1.5 text-xs text-slate-400">
                <div class="w-3.5 h-3.5 rounded-sm bg-blue-700/80 border border-blue-600/40"></div> Planificado
            </div>
            <div class="flex items-center gap-1.5 text-xs text-slate-400">
                <div class="w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></div> Completado
            </div>
            <div class="flex items-center gap-1.5 text-xs text-slate-400">
                <div class="w-3.5 h-3.5 rounded-sm border border-[#00C853]/15" style="background:rgba(255,255,255,.03)">
                </div> Sin actividad
            </div>
            <span id="monthProgress" class="ml-auto text-xs text-slate-500"></span>
        </div>
    </div>>

    <!-- MODAL DE EDICIÓN -->
    <div x-show="modalEditarAbierto" x-transition.opacity @close-modal.window="modalEditarAbierto = false" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center" style="display: none;">

        <!-- OVERLAY -->
        <div class="absolute inset-0" @click="modalEditarAbierto = false"></div>

        <!-- CONTENIDO -->
        <div x-transition.scale.origin.center class="relative">
            @include('modals.edit.project')
        </div>

    </div>

    <!-- MODAL ELIMINAR -->
    <div x-show="modalEliminarAbierto" x-transition.opacity class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center" style="display: none;">

        <!-- OVERLAY -->
        <div class="absolute inset-0" @click="modalEliminarAbierto = false"></div>

        <!-- CONTENIDO -->
        <div x-transition.scale.origin.center class="relative bg-[#1C2A40] border border-red-500/20 rounded-2xl p-6 w-full max-w-md shadow-2xl">

            <!-- Título -->
            <h2 class="text-lg font-bold text-red-400 mb-2" style="font-family:'Syne',sans-serif">
                Eliminar proyecto
            </h2>

            <!-- Texto -->
            <p class="text-sm text-slate-400 mb-6">
                ¿Estás seguro de que deseas eliminar este proyecto? Esta acción no se puede deshacer.
            </p>

            <!-- Botones -->
            <div class="flex justify-end gap-2">

                <!-- Cancelar -->
                <button @click="modalEliminarAbierto = false" class="px-4 py-2 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all">
                    Cancelar
                </button>

                <!-- Eliminar -->

                <button type="submit" class="px-4 py-2 rounded-xl text-sm bg-red-500 text-white hover:bg-red-600 transition-all">
                    Sí, eliminar
                </button>

            </div>
        </div>
    </div>

</div>

<script>
    const MONTHS = [{
            y: 2023
            , m: 0
            , label: 'Enero 2023'
            , short: 'ENE'
        }, {
            y: 2023
            , m: 1
            , label: 'Febrero 2023'
            , short: 'FEB'
        }
        , {
            y: 2023
            , m: 2
            , label: 'Marzo 2023'
            , short: 'MAR'
        }, {
            y: 2023
            , m: 3
            , label: 'Abril 2023'
            , short: 'ABR'
        }
        , {
            y: 2023
            , m: 4
            , label: 'Mayo 2023'
            , short: 'MAY'
        }, {
            y: 2023
            , m: 5
            , label: 'Junio 2023'
            , short: 'JUN'
        }
        , {
            y: 2023
            , m: 6
            , label: 'Julio 2023'
            , short: 'JUL'
        }, {
            y: 2023
            , m: 7
            , label: 'Agosto 2023'
            , short: 'AGO'
        }
        , {
            y: 2023
            , m: 8
            , label: 'Septiembre 2023'
            , short: 'SEPT'
        }, {
            y: 2023
            , m: 9
            , label: 'Octubre 2023'
            , short: 'OCT'
        }
        , {
            y: 2023
            , m: 10
            , label: 'Noviembre 2023'
            , short: 'NOV'
        }, {
            y: 2023
            , m: 11
            , label: 'Diciembre 2023'
            , short: 'DIC'
        }
        , {
            y: 2024
            , m: 0
            , label: 'Enero 2024'
            , short: 'ENE'
        }, {
            y: 2024
            , m: 1
            , label: 'Febrero 2024'
            , short: 'FEB'
        }
        , {
            y: 2024
            , m: 2
            , label: 'Marzo 2024'
            , short: 'MAR'
        }, {
            y: 2024
            , m: 3
            , label: 'Abril 2024'
            , short: 'ABR'
        }
        , {
            y: 2024
            , m: 4
            , label: 'Mayo 2024'
            , short: 'MAY'
        }, {
            y: 2024
            , m: 5
            , label: 'Junio 2024'
            , short: 'JUN'
        }
        , {
            y: 2024
            , m: 6
            , label: 'Julio 2024'
            , short: 'JUL'
        }, {
            y: 2024
            , m: 7
            , label: 'Agosto 2024'
            , short: 'AGO'
        }
        , {
            y: 2024
            , m: 8
            , label: 'Septiembre 2024'
            , short: 'SEPT'
        }, {
            y: 2024
            , m: 9
            , label: 'Octubre 2024'
            , short: 'OCT'
        }
        , {
            y: 2024
            , m: 10
            , label: 'Noviembre 2024'
            , short: 'NOV'
        }, {
            y: 2024
            , m: 11
            , label: 'Diciembre 2024'
            , short: 'DIC'
        }
        , {
            y: 2025
            , m: 0
            , label: 'Enero 2025'
            , short: 'ENE'
        }, {
            y: 2025
            , m: 1
            , label: 'Febrero 2025'
            , short: 'FEB'
        }
        , {
            y: 2025
            , m: 2
            , label: 'Marzo 2025'
            , short: 'MAR'
        }, {
            y: 2025
            , m: 3
            , label: 'Abril 2025'
            , short: 'ABR'
        }
        , {
            y: 2025
            , m: 4
            , label: 'Mayo 2025'
            , short: 'MAY'
        }, {
            y: 2025
            , m: 5
            , label: 'Junio 2025'
            , short: 'JUN'
        }
        , {
            y: 2025
            , m: 6
            , label: 'Julio 2025'
            , short: 'JUL'
        }, {
            y: 2025
            , m: 7
            , label: 'Agosto 2025'
            , short: 'AGO'
        }
        , {
            y: 2025
            , m: 8
            , label: 'Septiembre 2025'
            , short: 'SEPT'
        }, {
            y: 2025
            , m: 9
            , label: 'Octubre 2025'
            , short: 'OCT'
        }
        , {
            y: 2025
            , m: 10
            , label: 'Noviembre 2025'
            , short: 'NOV'
        }, {
            y: 2025
            , m: 11
            , label: 'Diciembre 2025'
            , short: 'DIC'
        }
        , {
            y: 2026
            , m: 0
            , label: 'Enero 2026'
            , short: 'ENE'
        }, {
            y: 2026
            , m: 1
            , label: 'Febrero 2026'
            , short: 'FEB'
        }
        , {
            y: 2026
            , m: 2
            , label: 'Marzo 2026'
            , short: 'MAR'
        }, {
            y: 2026
            , m: 3
            , label: 'Abril 2026'
            , short: 'ABR'
        }
        , {
            y: 2026
            , m: 4
            , label: 'Mayo 2026'
            , short: 'MAY'
        }, {
            y: 2026
            , m: 5
            , label: 'Junio 2026'
            , short: 'JUN'
        }
        , {
            y: 2026
            , m: 6
            , label: 'Julio 2026'
            , short: 'JUL'
        }, {
            y: 2026
            , m: 7
            , label: 'Agosto 2026'
            , short: 'AGO'
        }
        , {
            y: 2026
            , m: 8
            , label: 'Septiembre 2026'
            , short: 'SEPT'
        }, {
            y: 2026
            , m: 9
            , label: 'Octubre 2026'
            , short: 'OCT'
        }
        , {
            y: 2026
            , m: 10
            , label: 'Noviembre 2026'
            , short: 'NOV'
        }, {
            y: 2026
            , m: 11
            , label: 'Diciembre 2026'
            , short: 'DIC'
        }
    , ];

    const ganttData = [{
            phase: 'INVESTIGACIÓN'
            , activities: [{
                    name: 'CONTEXTO DEL PROBLEMA'
                    , reuniones: ''
                    , inicio: '7/12/2023'
                    , fin: '7/12/2023'
                    , filled: {
                        11: [2, 3]
                    }
                }
                , {
                    name: 'ÁRBOL DE PROBLEMAS'
                    , reuniones: ''
                    , inicio: '20/10/2023'
                    , fin: '15/12/2023'
                    , filled: {
                        9: [2, 3]
                        , 10: [0, 1, 2, 3]
                        , 11: [0, 1, 2, 3]
                    }
                }
                , {
                    name: 'PLANTEAMIENTO DEL PROBLEMA'
                    , reuniones: ''
                    , inicio: '20/10/2023'
                    , fin: '15/12/2023'
                    , filled: {
                        9: [2, 3]
                        , 10: [0, 1, 2, 3]
                        , 11: [0, 1, 2, 3]
                    }
                }
                , {
                    name: 'ÁRBOL DE OBJETIVOS'
                    , reuniones: ''
                    , inicio: '20/10/2023'
                    , fin: '15/12/2023'
                    , filled: {
                        10: [2, 3]
                        , 11: [0, 1]
                    }
                }
                , {
                    name: 'CADENA DE VALOR'
                    , reuniones: ''
                    , inicio: '20/10/2023'
                    , fin: '15/12/2023'
                    , filled: {
                        10: [2, 3]
                        , 11: [0, 1]
                    }
                }
                , {
                    name: 'ANTECEDENTES'
                    , reuniones: ''
                    , inicio: '20/10/2023'
                    , fin: '15/12/2023'
                    , filled: {
                        10: [2, 3]
                        , 11: [0, 1]
                    }
                }
                , {
                    name: 'JUSTIFICACIÓN'
                    , reuniones: ''
                    , inicio: '20/10/2023'
                    , fin: '15/12/2023'
                    , filled: {
                        10: [2, 3]
                        , 11: [0, 1]
                    }
                }
                , {
                    name: 'MARCO CONCEPTUAL'
                    , reuniones: ''
                    , inicio: '20/10/2023'
                    , fin: '15/12/2023'
                    , filled: {
                        10: [2, 3]
                        , 11: [0, 1]
                    }
                }
                , {
                    name: 'RESUMEN'
                    , reuniones: ''
                    , inicio: '20/10/2023'
                    , fin: '15/12/2023'
                    , filled: {
                        10: [2, 3]
                        , 11: [0, 1]
                    }
                }
                , {
                    name: 'TÍTULO DEL PROYECTO'
                    , reuniones: ''
                    , inicio: '7/08/2023'
                    , fin: '7/08/2023'
                    , filled: {
                        7: [0, 1]
                    }
                }
            , ]
        }
        , {
            phase: 'CONSTRUCCIÓN DEL SOFTWARE'
            , activities: [{
                    name: '1. LEVANTAMIENTO DE INFORMACIÓN'
                    , reuniones: ''
                    , inicio: '5/9/2023'
                    , fin: '5/9/2023'
                    , filled: {
                        8: [0, 1]
                    }
                }
                , {
                    name: '2. ANÁLISIS DE REQUERIMIENTOS'
                    , reuniones: ''
                    , inicio: '6/07/2024'
                    , fin: '28/08/2024'
                    , filled: {
                        18: [2, 3]
                        , 19: [0, 1, 2, 3]
                    }
                }
                , {
                    name: '3. DISEÑO BD / CASOS DE USO / MER / CLASES'
                    , reuniones: ''
                    , inicio: '6/07/2024'
                    , fin: '28/08/2024'
                    , filled: {
                        18: [2, 3]
                        , 19: [0, 1, 2, 3]
                    }
                }
                , {
                    name: '4. DISEÑO INTERFAZ CRUD'
                    , reuniones: ''
                    , inicio: ''
                    , fin: ''
                    , filled: {
                        20: [0, 1, 2, 3]
                    }
                }
                , {
                    name: '5. CREACIÓN Y VALIDACIÓN DE PROTOTIPO'
                    , reuniones: ''
                    , inicio: ''
                    , fin: ''
                    , filled: {
                        20: [0, 1, 2, 3]
                        , 21: [0, 1]
                    }
                }
                , {
                    name: '6. IMPLEMENTACIÓN BD Y CONSULTAS SQL'
                    , reuniones: ''
                    , inicio: '1/09/2024'
                    , fin: '30/10/2024'
                    , filled: {
                        20: [0, 1, 2, 3]
                        , 21: [0, 1, 2, 3]
                    }
                }
                , {
                    name: '7. IMPLEMENTACIÓN DE LA APLICACIÓN'
                    , reuniones: ''
                    , inicio: ''
                    , fin: ''
                    , filled: {
                        21: [0, 1, 2, 3]
                        , 22: [0, 1]
                    }
                }
                , {
                    name: '8. DESARROLLO DE PRUEBAS'
                    , reuniones: ''
                    , inicio: '1/11/2024'
                    , fin: '15/11/2024'
                    , filled: {
                        22: [2, 3]
                    }
                }
                , {
                    name: '9. DEPURACIÓN DE ERRORES'
                    , reuniones: ''
                    , inicio: ''
                    , fin: ''
                    , filled: {
                        22: [2, 3]
                        , 23: [0]
                    }
                }
                , {
                    name: '10. DOCUMENTACIÓN'
                    , reuniones: ''
                    , inicio: '20/10/2023'
                    , fin: '15/12/2023'
                    , filled: {
                        11: [3]
                        , 12: [0]
                    }
                }
                , {
                    name: '11. MANUAL DE USUARIO'
                    , reuniones: ''
                    , inicio: ''
                    , fin: ''
                    , filled: {
                        23: [1, 2]
                    }
                }
                , {
                    name: '12. CAPACITACIÓN EN EL MANEJO'
                    , reuniones: ''
                    , inicio: '15/11/2024'
                    , fin: '30/11/2024'
                    , filled: {
                        23: [1, 2]
                    }
                }
            , ]
        }
    , ];

    const cellStates = {};
    let currentMonthIdx = 0;
    let rowCounter = 0;

    function ck(r, mi, w) {
        return `${r}_${mi}_${w}`;
    }

    function initStates() {
        let r = 0;
        ganttData.forEach(ph => ph.activities.forEach(act => {
            for (let mi = 0; mi < MONTHS.length; mi++)
                for (let w = 0; w < 4; w++)
                    cellStates[ck(r, mi, w)] = (act.filled[mi] && act.filled[mi].includes(w)) ? 1 : 0;
            r++;
        }));
        rowCounter = r;
    }

    function prevMonth() {
        if (currentMonthIdx > 0) {
            currentMonthIdx--;
            renderGantt();
        }
    }

    function nextMonth() {
        if (currentMonthIdx < MONTHS.length - 1) {
            currentMonthIdx++;
            renderGantt();
        }
    }

    function jumpToMonth(v) {
        currentMonthIdx = parseInt(v);
        renderGantt();
    }

    function goToday() {
        const n = new Date();
        const i = MONTHS.findIndex(m => m.y === n.getFullYear() && m.m === n.getMonth());
        if (i >= 0) {
            currentMonthIdx = i;
            renderGantt();
        }
    }

    function cycleCell(r, mi, w) {
        const k = ck(r, mi, w);
        cellStates[k] = ((cellStates[k] || 0) + 1) % 3;
        applyCell(r, mi, w);
        updateProgress();
    }

    function clearCellFn(r, mi, w) {
        cellStates[ck(r, mi, w)] = 0;
        applyCell(r, mi, w);
        updateProgress();
    }

    /* ── Cell color palette aligned with the card design ── */
    function getCellClasses(v) {
        const base = 'border border-[#2b2b2b] cursor-pointer transition-colors duration-150';
        const size = 'w-14 h-9';
        if (v === 1) return `${base} ${size} bg-blue-800/70 hover:bg-blue-700/90`;
        if (v === 2) return `${base} ${size} bg-emerald-600/50 hover:bg-emerald-500/70`;
        return `${base} ${size} hover:bg-emerald-500/10`;
    }

    /* Default td bg so empty cells match the card */
    const EMPTY_BG = 'background:rgba(255,255,255,.02)';

    function applyCell(r, mi, w) {
        const el = document.getElementById(`gc_${r}_${mi}_${w}`);
        if (!el) return;
        const v = cellStates[ck(r, mi, w)] || 0;
        el.className = getCellClasses(v);
        el.style.cssText = v === 0 ? EMPTY_BG : '';
    }

    function buildBody() {
        const tbody = document.getElementById('ganttBody');
        tbody.innerHTML = '';
        let r = 0;

        /* Alternate row bg for readability — both stay within the card palette */
        const rowBg = ['background:#1a2740', 'background:#172337'];

        ganttData.forEach((phase, pi) => {
            phase.activities.forEach((act, aIdx) => {
                const tr = document.createElement('tr');
                const ri = r;

                /* Phase column (rowspan) */
                if (aIdx === 0) {
                    const td = document.createElement('td');
                    td.className = 'text-emerald-400 font-bold text-[10px] tracking-[2px] text-center px-1.5 border-r-2 border-r-emerald-500/30 border border-[#2b2b2b] align-middle select-none';
                    td.style.cssText = 'writing-mode:vertical-rl;text-orientation:mixed;transform:rotate(180deg);font-family:Syne,sans-serif;background:#0e1a2d';
                    td.rowSpan = phase.activities.length;
                    td.textContent = phase.phase;
                    tr.appendChild(td);
                }

                /* Activity name */
                const actTd = document.createElement('td');
                actTd.className = 'text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug cursor-text';
                actTd.style.cssText = `min-width:210px;max-width:250px;${rowBg[r % 2]}`;
                actTd.contentEditable = true;
                actTd.textContent = act.name;
                tr.appendChild(actTd);

                /* Reuniones */
                const rTd = document.createElement('td');
                rTd.className = 'border border-[#2b2b2b] text-center';
                rTd.style.cssText = rowBg[r % 2];
                const rI = document.createElement('input');
                rI.className = 'bg-transparent border-none text-slate-400 text-xs text-center w-full px-1 py-2 outline-none';
                rI.type = 'text';
                rI.value = act.reuniones;
                rI.placeholder = '—';
                rTd.appendChild(rI);
                tr.appendChild(rTd);

                /* Fecha inicio */
                const fdTd = document.createElement('td');
                fdTd.className = 'border border-[#2b2b2b]';
                fdTd.style.cssText = rowBg[r % 2];
                const fdI = document.createElement('input');
                fdI.className = 'bg-transparent border-none text-slate-400 text-xs text-center w-full px-1 py-2 outline-none';
                fdI.type = 'text';
                fdI.value = act.inicio;
                fdI.placeholder = 'dd/mm/aaaa';
                fdTd.appendChild(fdI);
                tr.appendChild(fdTd);

                /* Fecha fin */
                const ffTd = document.createElement('td');
                ffTd.className = 'border border-[#2b2b2b]';
                ffTd.style.cssText = rowBg[r % 2];
                const ffI = document.createElement('input');
                ffI.className = 'bg-transparent border-none text-slate-400 text-xs text-center w-full px-1 py-2 outline-none';
                ffI.type = 'text';
                ffI.value = act.fin;
                ffI.placeholder = 'dd/mm/aaaa';
                ffTd.appendChild(ffI);
                tr.appendChild(ffTd);

                /* Week cells */
                for (let w = 0; w < 4; w++) {
                    const td = document.createElement('td');
                    const v = cellStates[ck(ri, currentMonthIdx, w)] || 0;
                    td.className = getCellClasses(v);
                    if (v === 0) td.style.cssText = EMPTY_BG;
                    td.id = `gc_${ri}_${currentMonthIdx}_${w}`;
                    td.addEventListener('click', () => cycleCell(ri, currentMonthIdx, w));
                    td.addEventListener('contextmenu', e => {
                        e.preventDefault();
                        clearCellFn(ri, currentMonthIdx, w);
                    });
                    tr.appendChild(td);
                }

                tbody.appendChild(tr);
                r++;
            });
        });
        rowCounter = r;
    }

    function renderGantt() {
        const mo = MONTHS[currentMonthIdx];
        document.getElementById('monthColLabel').textContent = `${mo.short} ${mo.y}`;
        document.getElementById('monthJump').value = currentMonthIdx;
        buildBody();
        updateProgress();
    }

    function updateProgress() {
        let total = 0
            , done = 0;
        Object.values(cellStates).forEach(v => {
            if (v === 1) total++;
            if (v === 2) {
                total++;
                done++;
            }
        });
        const pct = total > 0 ? Math.round(done / total * 100) : 50;
        document.getElementById('pct-display').textContent = pct + '%';
        document.getElementById('main-progress').style.width = pct + '%';

        const mo = MONTHS[currentMonthIdx];
        let mt = 0
            , md = 0
            , rr = 0;
        ganttData.forEach(ph => ph.activities.forEach(() => {
            for (let w = 0; w < 4; w++) {
                const v = cellStates[ck(rr, currentMonthIdx, w)] || 0;
                if (v === 1) mt++;
                if (v === 2) {
                    mt++;
                    md++;
                }
            }
            rr++;
        }));
        const mp = mt > 0 ? Math.round(md / mt * 100) : 0;
        document.getElementById('monthProgress').textContent = `Avance ${mo.short} ${mo.y}: ${mp}%`;
    }

    function addActivity() {
        const lp = ganttData[ganttData.length - 1];
        lp.activities.push({
            name: 'Nueva actividad'
            , reuniones: ''
            , inicio: ''
            , fin: ''
            , filled: {}
        });
        for (let mi = 0; mi < MONTHS.length; mi++)
            for (let w = 0; w < 4; w++) cellStates[ck(rowCounter, mi, w)] = 0;
        rowCounter++;
        buildBody();
        showToast('Actividad agregada');
    }

    function showToast(msg) {
        const t = document.getElementById('toast');
        document.getElementById('toast-msg').textContent = msg;
        t.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
        t.classList.add('translate-y-0', 'opacity-100');
        setTimeout(() => {
            t.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
            t.classList.remove('translate-y-0', 'opacity-100');
        }, 2800);
    }

    (function() {
        const sel = document.getElementById('monthJump');
        MONTHS.forEach((mo, i) => {
            const o = document.createElement('option');
            o.value = i;
            o.textContent = mo.label;
            o.style.background = '#111d30';
            sel.appendChild(o);
        });
        const n = new Date();
        const i = MONTHS.findIndex(m => m.y === n.getFullYear() && m.m === n.getMonth());
        currentMonthIdx = i >= 0 ? i : 8;
        initStates();
        renderGantt();
    })();

</script>
@endsection
