@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div x-data="{ modalEditarAbierto: false, modalEliminarAbierto: false }" class="flex flex-col gap-6">
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 relative transition-all">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-500 to-sky-400 rounded-t-2xl">
        </div>
        <div class="flex items-start justify-between mb-6 relative z-10 px-8 py-7">
            <div class="flex items-center gap-4">
                @php
                $words = explode(' ', $project->name);
                $initials = strtoupper(
                substr($words[0], 0, 1) .
                (isset($words[1]) ? substr($words[1], 0, 1) : '')
                );
                @endphp

                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-700 to-emerald-400 flex items-center justify-center font-black text-lg text-slate-900 shrink-0" style="font-family:'Syne',sans-serif">
                    {{ $initials }}
                </div>
                <div>
                    <h1 class="font-black text-2xl leading-tight" style="font-family:'Syne',sans-serif">{{ $project->name }}
                    </h1>
                    <p class="text-sm text-slate-400 mt-1">{{ $project->description }}</p>
                    <div class="flex gap-2 mt-2.5 flex-wrap">
                        <span class="px-3 py-0.5 rounded-full text-xs font-medium bg-emerald-500/15 text-emerald-400 border border-emerald-500/30">●
                            {{ ucwords(str_replace('_', ' ', strtolower($project->status))) }}</span>
                        <span class="px-3 py-0.5 rounded-full text-xs font-medium bg-yellow-400/15 text-yellow-400 border border-yellow-400/30">{{ number_format($project->progress, 0) }}%
                            completado</span>
                    </div>
                </div>
            </div>
            <div class="flex gap-2 shrink-0">
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
                <p class="text-sm font-medium">{{ $project->start_date->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-400 mb-1.5">Fecha Entrega</p>
                <p class="text-sm font-medium">{{ $project->due_date->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-400 mb-1.5">Líder</p>
                <p class="text-sm font-medium">
                    @php $leader = $project->leader->first(); @endphp

                    {{ $leader?->first_name ?? 'Sin líder' }}
                    {{ $leader?->last_name ?? '' }}
                </p>
                </p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-400 mb-1.5">Días restantes</p>
                @php
                $days = ceil(now()->floatDiffInDays($project->due_date, false));
                @endphp

                <p class="text-sm font-bold text-yellow-400">
                    {{ max(0, $days) }}
                </p>
            </div>
        </div>
        <div class="mt-5 pt-5 border-t border-emerald-500/20 relative z-10 px-8">
            <div class="flex justify-between items-center mb-2">
                <span class="text-xs uppercase tracking-widest text-slate-400">
                    Avance general del proyecto
                </span>
                <span class="font-black text-lg" style="
                font-family:'Syne',sans-serif;
                color: {{ $project->progress_color }};
            ">
                    {{ number_format($project->progress, 0) }}%
                </span>
            </div>

            <div class="w-full h-2 bg-white/5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-500" style="
                width: {{ $project->progress }}%;
                background: linear-gradient(
                    to right,
                    {{ $project->progress_color }},
                    {{ $project->progress_color }}AA
                );
            ">
                </div>
            </div>
        </div>
        <div class="mt-5 pt-5 pb-7 px-8 border-t border-emerald-500/20 flex items-center gap-3 relative z-10">
            <span class="text-xs uppercase tracking-widest text-slate-400 shrink-0">Equipo:</span>
            <div class="flex gap-1.5">
                @forelse($project->team as $member)
                @php
                $initials = strtoupper(
                substr($member->first_name, 0, 1) .
                substr($member->last_name, 0, 1)
                );
                @endphp

                <div class="w-8 h-8 rounded-lg border-2 border-slate-800 flex items-center justify-center font-black text-xs text-white" style="
                font-family:'Syne',sans-serif;
                background: linear-gradient(
                    to bottom right,
                    #6366f1,
                    #8b5cf6
                );
            " title="{{ $member->first_name }} {{ $member->last_name }}">
                    {{ $initials }}
                </div>
                @empty
                <span class="text-slate-400 text-sm">Sin miembros</span>
                @endforelse
            </div>
            <div class="text-sm text-slate-400">
                @forelse($project->team as $member)
                <span>
                    {{ $member->first_name }} {{ $member->last_name }}
                </span>@if(!$loop->last), @endif
                @empty
                @endforelse
            </div>
        </div>
    </div>

    <!-- GANTT  -->
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 transition-all">

        <!-- Gantt header bar -->
        <div class="px-6 py-5 border-b border-[#00C853]/15 bg-[#111D30]/60 flex items-center justify-between gap-4 flex-wrap">
            <div>
                <h2 class="font-bold text-base" style="font-family:'Syne',sans-serif">Cronograma <span class="text-emerald-400">Gantt</span></h2>
                <p class="text-xs text-slate-500 mt-0.5">Vista del cronograma</p>
            </div>
        </div>

        <!-- Tabla  -->
        <div class="overflow-x-auto">
            <table class="border-collapse w-full">
                <thead>
                    <tr>
                        <th class="text-[10px] font-bold tracking-[2px] text-emerald-400 px-3 py-2 border border-[#2b2b2b] text-center whitespace-nowrap" style="font-family:'Syne',sans-serif;min-width:90px;background:#0e1a2d">
                            FASES
                        </th>
                        <th class="text-[10px] font-bold tracking-[2px] text-emerald-400 px-3 py-2 border border-[#2b2b2b] text-center" style="font-family:'Syne',sans-serif;min-width:210px;background:#0e1a2d">
                            ACTIVIDADES
                        </th>
                        <th class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 px-2.5 py-2 border border-[#2b2b2b] text-center" style="min-width:72px;background:#111d30">
                            REUNIONES
                        </th>
                        <th class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 px-2.5 py-2 border border-[#2b2b2b] text-center" style="min-width:100px;background:#111d30">
                            FECHA INICIO
                        </th>
                        <th class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 px-2.5 py-2 border border-[#2b2b2b] text-center" style="min-width:100px;background:#111d30">
                            FECHA FIN
                        </th>
                        <th class="text-[10px] font-bold text-slate-300 border border-[#2b2b2b] text-center" style="width:56px;min-width:56px;padding:10px 0;background:#0e1a2d">ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- INVESTIGACIÓN - FASE 1 -->
                    <tr>
                        <td rowspan="10" class="text-emerald-400 font-bold text-[10px] tracking-[2px] text-center px-1.5 border-r-2 border-r-emerald-500/30 border border-[#2b2b2b] align-middle select-none" style="writing-mode:vertical-rl;text-orientation:mixed;transform:rotate(180deg);font-family:Syne,sans-serif;background:#0e1a2d">INVESTIGACIÓN</td>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#1a2740">CONTEXTO DEL PROBLEMA</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">7/12/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">7/12/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-blue-700/80 border border-blue-600/40"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#172337">ÁRBOL DE PROBLEMAS</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">20/10/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">15/12/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#1a2740">PLANTEAMIENTO DEL PROBLEMA</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">20/10/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">15/12/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#172337">ÁRBOL DE OBJETIVOS</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">20/10/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">15/12/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#1a2740">CADENA DE VALOR</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">20/10/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">15/12/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#172337">ANTECEDENTES</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">20/10/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">15/12/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#1a2740">JUSTIFICACIÓN</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">20/10/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">15/12/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#172337">MARCO CONCEPTUAL</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">20/10/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">15/12/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#1a2740">RESUMEN</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">20/10/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">15/12/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#172337">TÍTULO DEL PROYECTO</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">7/08/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">7/08/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-blue-700/80 border border-blue-600/40"></span></td>
                    </tr>

                    <!-- CONSTRUCCIÓN DEL SOFTWARE - FASE 2 -->
                    <tr>
                        <td rowspan="12" class="text-emerald-400 font-bold text-[10px] tracking-[2px] text-center px-1.5 border-r-2 border-r-emerald-500/30 border border-[#2b2b2b] align-middle select-none" style="writing-mode:vertical-rl;text-orientation:mixed;transform:rotate(180deg);font-family:Syne,sans-serif;background:#0e1a2d">CONSTRUCCIÓN DEL SOFTWARE</td>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#1a2740">1. LEVANTAMIENTO DE INFORMACIÓN</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">5/9/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">5/9/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-blue-700/80 border border-blue-600/40"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#172337">2. ANÁLISIS DE REQUERIMIENTOS</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">6/07/2024</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">28/08/2024</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#1a2740">3. DISEÑO BD / CASOS DE USO / MER / CLASES</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">6/07/2024</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">28/08/2024</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#172337">4. DISEÑO INTERFAZ CRUD</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-blue-700/80 border border-blue-600/40"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#1a2740">5. CREACIÓN Y VALIDACIÓN DE PROTOTIPO</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-blue-700/80 border border-blue-600/40"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#172337">6. IMPLEMENTACIÓN BD Y CONSULTAS SQL</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">1/09/2024</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">30/10/2024</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#1a2740">7. IMPLEMENTACIÓN DE LA APLICACIÓN</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-blue-700/80 border border-blue-600/40"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#172337">8. DESARROLLO DE PRUEBAS</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">1/11/2024</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">15/11/2024</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#1a2740">9. DEPURACIÓN DE ERRORES</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-blue-700/80 border border-blue-600/40"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#172337">10. DOCUMENTACIÓN</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">20/10/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">15/12/2023</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#1a2740">11. MANUAL DE USUARIO</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#1a2740"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-blue-700/80 border border-blue-600/40"></span></td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-200 px-3 py-2 border border-[#2b2b2b] leading-snug" style="background:#172337">12. CAPACITACIÓN EN EL MANEJO</td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">—</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">15/11/2024</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="text-slate-400 text-xs">30/11/2024</span></td>
                        <td class="border border-[#2b2b2b] text-center" style="background:#172337"><span class="inline-block w-3.5 h-3.5 rounded-sm bg-blue-700/80 border border-blue-600/40"></span></td>
                    </tr>
                </tbody>
            </table>
        </div>

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
        </div>
    </div>

    <!-- MODAL DE EDICIÓN -->
    <div x-show="modalEditarAbierto" @click.away="modalEditarAbierto = false; document.body.style.overflow = ''; " x-transition.opacity @close-modal.window="modalEditarAbierto = false" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center" x-cloak>
        <div x-transition.scale.origin.center class="relative">
            @include('modals.edit.project')
        </div>
    </div>

    <!-- MODAL ELIMINAR -->
    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <div x-show="modalEliminarAbierto" @click.away="modalEliminarAbierto = false; document.body.style.overflow = ''; " x-transition.opacity class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center" x-cloak>

            <div class="absolute inset-0" @click="modalEliminarAbierto = false"></div>

            <div x-transition.scale.origin.center class="relative bg-[#1C2A40] border border-red-500/20 rounded-2xl p-6 w-full max-w-md shadow-2xl">

                <h2 class="text-lg font-bold text-red-400 mb-2" style="font-family:'Syne',sans-serif">
                    Eliminar proyecto
                </h2>

                <p class="text-sm text-slate-400 mb-6">
                    ¿Estás seguro de que deseas eliminar este proyecto? Esta acción no se puede deshacer.
                </p>

                <div class="flex justify-end gap-2">
                    <button type="button" @click="modalEliminarAbierto = false" class="px-4 py-2 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all">
                        Cancelar
                    </button>

                    <button type="submit" class="px-4 py-2 rounded-xl text-sm bg-red-500 text-white hover:bg-red-600 transition-all">
                        Sí, eliminar
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
