@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@section('breadcrumbs')
<span class="text-[#00C853]/30">›</span>
<a href="{{ url('projects') }}"
    class="text-[11px] uppercase tracking-[1.5px] text-[#8AAABB] hover:text-[#00C853] transition-colors">
    Proyectos
</a>
<span class="text-[#00C853]/30">›</span>
<span class="font-syne font-bold text-sm text-[#E8F4FF]">{{ $project->name }}</span>
@endsection

@php
$monthNames = [
1 => 'Enero',
2 => 'Febrero',
3 => 'Marzo',
4 => 'Abril',
5 => 'Mayo',
6 => 'Junio',
7 => 'Julio',
8 => 'Agosto',
9 => 'Septiembre',
10 => 'Octubre',
11 => 'Noviembre',
12 => 'Diciembre',
];
$years = range(now()->year - 2, now()->year + 3);

$submissionsJson = [];
foreach ($submissionsMap as $taskId => $weeks) {
$submissionsJson[$taskId] = [];
foreach ($weeks as $week => $subs) {
$submissionsJson[$taskId][$week] = collect($subs)
->map(
fn($s) => [
'id' => $s->id,
'filename' => $s->original_filename ?? basename($s->file_path ?? 'archivo'),
'url' => $s->file_path ? asset('storage/' . $s->file_path) : null,
'mime' => $s->mime_type ?? '',
'is_image' => str_starts_with($s->mime_type ?? '', 'image/'),
'comments' => $s->comments ?? '',
'grade' => $s->grade,
'feedback' => $s->feedback ?? '',
'grade_url' => url("projects/{$project->id}/tasks/{$taskId}/submissions/{$s->id}/grade"),
'delete_url' => url("projects/{$project->id}/tasks/{$taskId}/submissions/{$s->id}"),

],
)
->values()
->toArray();
}
}
@endphp

@php $canGrade = in_array(auth()->user()->role, ['ADMIN', 'INSTRUCTOR']); @endphp
{{-- ── JSON de submissions en elemento seguro, fuera del atributo x-data ── --}}
<script id="submissions-data" type="application/json">
    @json($submissionsJson)
</script>

{{-- ═══════════════════════════════════════════════════════════════════════════════
SCOPE PRINCIPAL: modales editar/eliminar proyecto
═══════════════════════════════════════════════════════════════════════════════ --}}
<div x-data="{ modalEditarAbierto: false, modalEliminarAbierto: false }" class="flex flex-col gap-6">

    {{-- ── Tarjeta cabecera del proyecto ─────────────────────────────────────── --}}
    <div
        class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 relative transition-all">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-500 to-sky-400 rounded-t-2xl"></div>

        <div class="flex items-start justify-between mb-6 relative z-10 px-8 py-7">
            <div class="flex items-top gap-4">
                @php
                $words = explode(' ', $project->name);
                $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                @endphp
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-700 to-emerald-400 flex items-center justify-center font-black text-lg text-slate-900 shrink-0"
                    style="font-family:'Syne',sans-serif">
                    {{ $initials }}
                </div>
                <div>
                    <h1 class="font-black text-2xl leading-tight" style="font-family:'Syne',sans-serif">
                        {{ $project->name }}</h1>
                    <p class="text-sm text-slate-400 mt-1 leading-relaxed break-all">{{ $project->description }}</p>
                    <div class="flex gap-2 mt-2.5 flex-wrap">
                        <span
                            class="px-3 py-0.5 rounded-full text-xs font-medium bg-emerald-500/15 text-emerald-400 border border-emerald-500/30">
                            ● {{ ucwords(str_replace('_', ' ', strtolower($project->status))) }}
                        </span>
                        <span
                            class="px-3 py-0.5 rounded-full text-xs font-medium bg-yellow-400/15 text-yellow-400 border border-yellow-400/30">
                            {{ number_format($project->progress, 0) }}% completado
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex gap-2 shrink-0">
                <button @click="modalEditarAbierto = true" type="button"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-slate-800 text-slate-400 border border-emerald-500/20 hover:text-slate-100 hover:border-emerald-500/40 cursor-pointer transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                    Editar
                </button>
                <button @click="modalEliminarAbierto = true" type="button"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-red-500/8 text-red-400 border border-red-500/20 hover:bg-red-500/15 cursor-pointer transition-all">
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
                <p class="text-sm font-medium">{{ $project->leader?->first_name ?? 'Sin líder' }}
                    {{ $project->leader?->last_name ?? '' }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-slate-400 mb-1.5">Días restantes</p>
                @php $days = ceil(now()->floatDiffInDays($project->due_date, false)); @endphp
                <p class="text-sm font-bold text-yellow-400">{{ max(0, $days) }}</p>
            </div>
        </div>

        <div class="mt-5 pt-5 border-t border-emerald-500/20 relative z-10 px-8">
            <div class="flex justify-between items-center mb-2">
                <span class="text-xs uppercase tracking-widest text-slate-400">Avance general del proyecto</span>
                <span class="font-black text-lg"
                    style="font-family:'Syne',sans-serif;color:{{ $project->progress_color }}">
                    {{ number_format($project->progress, 0) }}%
                </span>
            </div>
            <div class="w-full h-2 bg-white/5 rounded-full overflow-hidden">
                <div class="h-full rounded-full transition-all duration-500"
                    style="width:{{ $project->progress }}%;background:linear-gradient(to right,{{ $project->progress_color }},{{ $project->progress_color }}AA)">
                </div>
            </div>
        </div>

        <div class="mt-5 pt-5 pb-7 px-8 border-t border-emerald-500/20 flex items-center gap-3 relative z-10">
            <span class="text-xs uppercase tracking-widest text-slate-400 shrink-0">Equipo:</span>
            <div class="flex gap-1.5">
                @forelse($project->team as $member)
                @php $initials = strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1));
                @endphp
                <div class="w-8 h-8 rounded-lg border-2 border-slate-800 flex items-center justify-center font-black text-xs text-white"
                    style="font-family:'Syne',sans-serif;background:linear-gradient(to bottom right,#6366f1,#8b5cf6)"
                    title="{{ $member->first_name }} {{ $member->last_name }}">
                    {{ $initials }}
                </div>
                @empty
                <span class="text-slate-400 text-sm">Sin miembros</span>
                @endforelse
            </div>
            <div class="text-sm text-slate-400">
                @forelse($project->team as $member)
                <span>{{ $member->first_name }} {{ $member->last_name }}</span>
                @if (!$loop->last), @endif
                @empty
                @endforelse
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════════════
    GANTT — scope Alpine independiente
    ═══════════════════════════════════════════════════════════════════════════ --}}

    {{-- ✅ FIX PRINCIPAL:
    - allSubmissions se carga en init() desde el <script type="application/json">
        seguro
         - Se elimina @json() del atributo x-data para evitar que caracteres especiales rompan el parser JS
         - El listener usa @open-entrega.window con kebab-case consistente
         - Las celdas usan $dispatch('open-entrega', ...) con kebab-case
    --}}
    <div
        x-data="{
            modalAgregar: false,
            modalEntrega: false,
            entregaTaskId: null,
            entregaWeek: null,
            currentSubmissions: [],
            allSubmissions: {},

            init() {
                const el = document.getElementById('submissions-data');
                if (el) {
                    try {
                        this.allSubmissions = JSON.parse(el.textContent);
                    } catch(e) {
                        console.error('Error al parsear submissions:', e);
                        this.allSubmissions = {};
                    }
                }
            },

            openEntrega(taskId, week) {
                this.entregaTaskId      = taskId;
                this.entregaWeek        = week;
                this.currentSubmissions = (this.allSubmissions[taskId] || {})[week] || [];
                this.modalEntrega       = true;
            }
        }"
        @open-entrega.window="openEntrega($event.detail.taskId, $event.detail.week)"
        class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 transition-all">

        {{-- ── Header Gantt ──────────────────────────────────────────────── --}}
        <div
            class="px-6 py-5 border-b border-[#00C853]/15 bg-[#111D30]/60 flex items-center justify-between gap-4 flex-wrap">
            <div>
                <h2 class="font-bold text-base" style="font-family:'Syne',sans-serif">
                    Cronograma <span class="text-emerald-400">Gantt</span>
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Vista del cronograma</p>
            </div>

            <div class="flex items-center gap-3 flex-wrap">
                <form method="GET" action="{{ route('projects.show', $project->id) }}" id="gantt-filter-form">
                    <div class="flex items-center gap-2">
                        <select name="filter_year"
                            onchange="document.getElementById('gantt-filter-form').submit()"
                            class="bg-[#0e1a2d] border border-[#00C853]/20 text-slate-300 text-xs rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500/50">
                            @foreach ($years as $y)
                                <option value="{{ $y }}" {{ $filterYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                        <select name="filter_month"
                            onchange="document.getElementById('gantt-filter-form').submit()"
                            class="bg-[#0e1a2d] border border-[#00C853]/20 text-slate-300 text-xs rounded-lg px-3 py-2 focus:outline-none focus:border-emerald-500/50">
                            @foreach ($monthNames as $num => $name)
                                <option value="{{ $num }}" {{ $filterMonth == $num ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

                {{-- ✅ Este botón está en el scope del Gantt, accede a modalAgregar directamente --}}
                <button @click="modalAgregar = true" type="button"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 hover:bg-emerald-500/25 hover:border-emerald-500/50 transition-all cursor-pointer"
                    style="font-family:'Syne',sans-serif">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Agregar actividad
                </button>
            </div>
        </div>

        {{-- ── Tabla ─────────────────────────────────────────────────────── --}}
        <div class="overflow-x-auto">
            <table class="border-collapse w-full">
                <thead>
                    <tr>
                        <th class="text-[10px] font-bold tracking-[2px] text-emerald-400 px-3 py-2 border border-[#2b2b2b] text-center whitespace-nowrap"
                            style="font-family:'Syne',sans-serif;min-width:90px;background:#0e1a2d">FASES</th>
                        <th class="text-[10px] font-bold tracking-[2px] text-emerald-400 px-3 py-2 border border-[#2b2b2b] text-center"
                            style="font-family:'Syne',sans-serif;min-width:220px;background:#0e1a2d">ACTIVIDADES</th>
                        <th class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 px-2.5 py-2 border border-[#2b2b2b] text-center"
                            style="min-width:110px;background:#111d30">FECHA INICIO</th>
                        <th class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 px-2.5 py-2 border border-[#2b2b2b] text-center"
                            style="min-width:110px;background:#111d30">FECHA FIN</th>
                        @for ($w = 1; $w <= 4; $w++)
                            <th class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 px-2 py-2 border border-[#2b2b2b] text-center"
                                style="min-width:70px;background:#111d30">S{{ $w }}</th>
                        @endfor
                        <th class="text-[10px] font-bold text-slate-300 border border-[#2b2b2b] text-center"
                            style="width:60px;min-width:60px;padding:10px 0;background:#0e1a2d">ESTADO</th>
                        <th class="text-[10px] font-bold text-slate-300 border border-[#2b2b2b] text-center"
                            style="width:80px;min-width:80px;padding:10px 0;background:#0e1a2d"></th>
                    </tr>
                    <tr>
                        <td colspan="2" style="background:#090f1c;border:1px solid #2b2b2b"></td>
                        <td colspan="2"
                            class="text-center text-[10px] text-emerald-400/60 py-1.5 border border-[#2b2b2b]"
                            style="background:#090f1c;font-family:'Syne',sans-serif;letter-spacing:2px">
                            {{ strtoupper($monthNames[$filterMonth]) }} {{ $filterYear }}
                        </td>
                        @for ($w = 1; $w <= 4; $w++)
                            <td class="text-center text-[10px] text-slate-500 py-1 border border-[#2b2b2b]"
                                style="background:#090f1c">Sem {{ $w }}</td>
                        @endfor
                        <td colspan="2" style="background:#090f1c;border:1px solid #2b2b2b"></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse($phases as $phaseName => $phaseTasks)
                        @foreach ($phaseTasks as $taskIndex => $task)
                            @php
                                $rowBg   = $taskIndex % 2 === 0 ? '#1a2740' : '#172337';
                                $isFirst = $taskIndex === 0;
                            @endphp

                            <tr x-data="{
                                editing: false,
                                d: {
                                    phase:       @js($task->phase),
                                    title:       @js($task->title),
                                    description: @js($task->description ?? ''),
                                    start_date:  @js($task->start_date?->format('Y-m-d') ?? ''),
                                    due_date:    @js($task->due_date?->format('Y-m-d') ?? ''),
                                    status:      @js($task->status?->value ?? ($task->status ?? 'PENDING')),
                                    assigned_to: @js((string) ($task->assigned_to ?? ''))
                                }
                            }">

                                {{-- Celda de FASE (solo primera fila del grupo) --}}
                                @if ($isFirst)
                                    <td rowspan="{{ $phaseTasks->count() }}"
                                        class="text-emerald-400 font-bold text-[10px] tracking-[2px] text-center px-1.5 border-r-2 border-r-emerald-500/30 border border-[#2b2b2b] align-middle select-none"
                                        style="writing-mode:vertical-rl;text-orientation:mixed;transform:rotate(180deg);font-family:Syne,sans-serif;background:#0e1a2d;min-width:90px">
                                        {{ $phaseName }}
                                    </td>
                                @endif

                                {{-- ── TÍTULO ── --}}
                                <td class="border border-[#2b2b2b] px-3 py-2 cursor-text group/title"
                                    style="background:{{ $rowBg }}"
                                    @click="editing = true"
                                    title="{{ $task->title }} — clic para editar">
                                    <span x-show="!editing"
                                        class="text-xs text-slate-200 leading-snug group-hover/title:text-emerald-300 transition-colors">
                                        {{ $task->title }}
                                        <span class="ml-1 opacity-0 group-hover/title:opacity-40 transition-opacity text-[8px] text-emerald-400">✎</span>
                                    </span>
                                    <input x-show="editing" x-model="d.title" @click.stop type="text"
                                        placeholder="Título de la actividad"
                                        class="w-full bg-[#0e1a2d] border border-emerald-500/40 text-slate-200 text-xs rounded-lg px-2 py-1.5 focus:outline-none focus:border-emerald-400"
                                        x-cloak>
                                    <input x-show="editing" x-model="d.description" @click.stop type="text"
                                        placeholder="Descripción (opcional)"
                                        class="mt-1 w-full bg-[#0e1a2d] border border-[#00C853]/15 text-slate-400 text-[10px] rounded-lg px-2 py-1 focus:outline-none focus:border-emerald-500/40 placeholder-slate-600"
                                        x-cloak>
                                </td>

                                {{-- ── FECHA INICIO ── --}}
                                <td class="border border-[#2b2b2b] text-center cursor-text"
                                    style="background:{{ $rowBg }}" @click="editing = true">
                                    <span x-show="!editing" class="text-slate-400 text-xs">
                                        {{ $task->start_date ? $task->start_date->format('d/m/Y') : '—' }}
                                    </span>
                                    <input x-show="editing" x-model="d.start_date" @click.stop type="date"
                                        class="bg-[#0e1a2d] border border-emerald-500/40 text-slate-200 text-xs rounded-lg px-2 py-1 focus:outline-none focus:border-emerald-400 w-full"
                                        x-cloak>
                                </td>

                                {{-- ── FECHA FIN ── --}}
                                <td class="border border-[#2b2b2b] text-center cursor-text"
                                    style="background:{{ $rowBg }}" @click="editing = true">
                                    <span x-show="!editing" class="text-slate-400 text-xs">
                                        {{ $task->due_date ? $task->due_date->format('d/m/Y') : '—' }}
                                    </span>
                                    <input x-show="editing" x-model="d.due_date" @click.stop type="date"
                                        class="bg-[#0e1a2d] border border-emerald-500/40 text-slate-200 text-xs rounded-lg px-2 py-1 focus:outline-none focus:border-emerald-400 w-full"
                                        x-cloak>
                                </td>

                                {{-- ── CELDAS DE SEMANAS ── --}}
                                {{-- ✅ FIX: $dispatch con kebab-case 'open-entrega' coincide con @open-entrega.window --}}
                                @for ($w = 1; $w <= 4; $w++)
                                    @php
                                        $weekSubs = $submissionsMap[$task->id][$w] ?? [];
                                        $hasFile  = count($weekSubs) > 0;
                                    @endphp
                                    <td class="border border-[#2b2b2b] text-center p-1.5 cursor-pointer group relative"
                                        style="background:{{ $rowBg }}"
                                        @click.stop="$dispatch('open-entrega', { taskId: {{ $task->id }}, week: {{ $w }} })"
                                        title="Semana {{ $w }} — {{ $hasFile ? count($weekSubs) . ' entrega(s)' : 'Clic para agregar entrega' }}">
                                        @if ($hasFile)
                                            <span
                                                class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-500/30 border border-emerald-400/50 group-hover:bg-emerald-500/50 transition-all">
                                                <svg class="w-2.5 h-2.5 text-emerald-400" fill="none"
                                                    stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                            <span
                                                class="absolute -top-1 -right-1 text-[9px] bg-emerald-500 text-white rounded-full w-3.5 h-3.5 flex items-center justify-center font-bold leading-none">
                                                {{ count($weekSubs) }}
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center justify-center w-5 h-5 rounded border border-dashed border-slate-600/40 group-hover:border-emerald-500/50 transition-all">
                                                <svg class="w-2 h-2 text-slate-600 group-hover:text-emerald-500 transition-colors"
                                                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </span>
                                        @endif
                                    </td>
                                @endfor

                                {{-- ── ESTADO ── --}}
                                <td class="border border-[#2b2b2b] text-center cursor-pointer"
                                    style="background:{{ $rowBg }}" @click="editing = true">
                                    @php
                                        $sv          = $task->status?->value ?? $task->status;
                                        $statusColor = match ($sv) {
                                            'COMPLETED'   => 'bg-emerald-500/60 border-emerald-400/30',
                                            'IN_PROGRESS' => 'bg-yellow-500/60 border-yellow-400/30',
                                            default       => 'bg-blue-700/80 border-blue-600/40',
                                        };
                                    @endphp
                                    <span x-show="!editing"
                                        class="inline-block w-3.5 h-3.5 rounded-sm {{ $statusColor }} border"
                                        title="{{ match ($sv) { 'COMPLETED' => 'Completado', 'IN_PROGRESS' => 'En progreso', default => 'Planificado' } }}">
                                    </span>
                                    <select x-show="editing" x-model="d.status" @click.stop
                                        class="bg-[#0e1a2d] border border-emerald-500/40 text-slate-200 text-[10px] rounded-lg px-1 py-1 focus:outline-none focus:border-emerald-400 w-full"
                                        x-cloak>
                                        <option value="PENDING">Planificado</option>
                                        <option value="IN_PROGRESS">En progreso</option>
                                        <option value="COMPLETED">Completado</option>
                                    </select>
                                </td>

                                {{-- ── ACCIONES ── --}}
                                <td class="border border-[#2b2b2b] text-center px-2"
                                    style="background:{{ $rowBg }}">

                                    <div x-show="editing" class="flex items-center justify-center gap-1">
                                        <form action="{{ route('project-tasks.update', [$project->id, $task->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="phase"       :value="d.phase">
                                            <input type="hidden" name="title"       :value="d.title">
                                            <input type="hidden" name="description" :value="d.description">
                                            <input type="hidden" name="start_date"  :value="d.start_date">
                                            <input type="hidden" name="due_date"    :value="d.due_date">
                                            <input type="hidden" name="status"      :value="d.status">
                                            <input type="hidden" name="assigned_to" :value="d.assigned_to">
                                            <button type="submit"
                                                class="p-1.5 rounded-lg text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/15 transition-all cursor-pointer"
                                                title="Guardar cambios">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </button>
                                        </form>

                                        <button @click.stop="editing = false" type="button"
                                            class="p-1.5 rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-all cursor-pointer"
                                            title="Cancelar">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div x-show="!editing" class="flex items-center justify-center">
                                        <form action="{{ route('project-tasks.destroy', [$project->id, $task->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Eliminar actividad «{{ addslashes($task->title) }}»? Esto también eliminará sus entregas.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-1.5 rounded-lg text-slate-500 hover:text-red-400 hover:bg-red-500/10 transition-all cursor-pointer"
                                                title="Eliminar actividad">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-16 border border-[#2b2b2b]"
                                style="background:#111d30">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor"
                                        stroke-width="1" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <p class="text-slate-500 text-sm">Este proyecto aún no tiene actividades en el cronograma.</p>
                                    <button @click="modalAgregar = true" type="button"
                                        class="mt-1 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 hover:bg-emerald-500/25 transition-all cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Agregar primera actividad
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ── Leyenda ── --}}
        <div class="flex items-center gap-5 px-6 py-3 border-t border-[#00C853]/10" style="background:#0e1a2d">
            <div class="flex items-center gap-1.5 text-xs text-slate-400">
                <div class="w-3.5 h-3.5 rounded-sm bg-blue-700/80 border border-blue-600/40"></div> Planificado
            </div>
            <div class="flex items-center gap-1.5 text-xs text-slate-400">
                <div class="w-3.5 h-3.5 rounded-sm bg-yellow-500/60 border border-yellow-400/30"></div> En progreso
            </div>
            <div class="flex items-center gap-1.5 text-xs text-slate-400">
                <div class="w-3.5 h-3.5 rounded-sm bg-emerald-500/60 border border-emerald-400/30"></div> Completado
            </div>
            <div class="ml-auto flex items-center gap-1.5 text-xs text-slate-500">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Clic en S1–S4 para entregas · Clic en celda para editar
            </div>
        </div>


        {{-- ════════════════════════════════════════════════════════════════════
             MODAL: AGREGAR ACTIVIDAD
             ════════════════════════════════════════════════════════════════════ --}}
        <div x-show="modalAgregar"
             @click.away="modalAgregar = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4"
             x-cloak>
            <div @click.stop
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="bg-[#1C2A40] border border-emerald-500/20 rounded-2xl p-6 w-full max-w-lg shadow-2xl">

                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-base font-bold text-emerald-400" style="font-family:'Syne',sans-serif">Nueva actividad</h3>
                    <button @click="modalAgregar = false"
                        class="text-slate-500 hover:text-white transition-colors cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('project-tasks.store', $project->id) }}" method="POST" class="flex flex-col gap-4">
                    @csrf

                    <div>
    <label class="text-xs uppercase tracking-widest text-slate-400 mb-1.5 block">Fase</label>
    <select name="phase" required
        class="w-full bg-[#0e1a2d] border border-[#00C853]/20 text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500/60">
        <option value="" style="background:#0e1a2d">— Selecciona una fase —</option>
        <option value="ANALISIS"   style="background:#0e1a2d" {{ old('phase') === 'ANALISIS'   ? 'selected' : '' }}>ANÁLISIS</option>
        <option value="PLANEACION" style="background:#0e1a2d" {{ old('phase') === 'PLANEACION' ? 'selected' : '' }}>PLANEACIÓN</option>
        <option value="EJECUCION"  style="background:#0e1a2d" {{ old('phase') === 'EJECUCION'  ? 'selected' : '' }}>EJECUCIÓN</option>
        <option value="EVALUACION" style="background:#0e1a2d" {{ old('phase') === 'EVALUACION' ? 'selected' : '' }}>EVALUACIÓN</option>
    </select>
</div>

                    <div>
                        <label class="text-xs uppercase tracking-widest text-slate-400 mb-1.5 block">Título de la actividad</label>
                        <input type="text" name="title" required placeholder="ej: Análisis de requerimientos"
                            class="w-full bg-[#0e1a2d] border border-[#00C853]/20 text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500/60 placeholder-slate-600"
                            value="{{ old('title') }}">
                    </div>

                    <div>
                        <label class="text-xs uppercase tracking-widest text-slate-400 mb-1.5 block">Descripción <span class="text-slate-600">(opcional)</span></label>
                        <textarea name="description" rows="2" placeholder="Descripción breve..."
                            class="w-full bg-[#0e1a2d] border border-[#00C853]/20 text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500/60 placeholder-slate-600 resize-none">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs uppercase tracking-widest text-slate-400 mb-1.5 block">Fecha inicio</label>
                            <input type="date" name="start_date"
                                class="w-full bg-[#0e1a2d] border border-[#00C853]/20 text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500/60"
                                value="{{ old('start_date') }}">
                        </div>
                        <div>
                            <label class="text-xs uppercase tracking-widest text-slate-400 mb-1.5 block">Fecha fin</label>
                            <input type="date" name="due_date"
                                class="w-full bg-[#0e1a2d] border border-[#00C853]/20 text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500/60"
                                value="{{ old('due_date') }}">
                        </div>
                    </div>

                    <div>
                        <label class="text-xs uppercase tracking-widest text-slate-400 mb-1.5 block">Estado inicial</label>
                        <select name="status"
                            class="w-full bg-[#0e1a2d] border border-[#00C853]/20 text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500/60">
                            <option value="PENDING"     {{ old('status', 'PENDING') === 'PENDING'     ? 'selected' : '' }}>Planificado</option>
                            <option value="IN_PROGRESS" {{ old('status') === 'IN_PROGRESS' ? 'selected' : '' }}>En progreso</option>
                            <option value="COMPLETED"   {{ old('status') === 'COMPLETED'   ? 'selected' : '' }}>Completado</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs uppercase tracking-widest text-slate-400 mb-1.5 block">
                            Responsable <span class="text-slate-600">(opcional)</span>
                        </label>
                        <select name="assigned_to"
                            class="w-full bg-[#0e1a2d] border border-[#00C853]/20 text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500/60">
                            <option value="">— Sin asignar —</option>
                            @foreach ($project->members as $member)
                                <option value="{{ $member->id }}" {{ old('assigned_to') == $member->id ? 'selected' : '' }}>
                                    {{ $member->first_name }} {{ $member->last_name }}
                                    @if ($member->pivot->project_role === 'LEADER') (Líder) @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end gap-2 mt-2">
                        <button type="button" @click="modalAgregar = false"
                            class="px-4 py-2 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all cursor-pointer">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="px-5 py-2 rounded-xl text-sm font-semibold bg-emerald-500 text-slate-900 hover:bg-emerald-400 transition-all cursor-pointer">
                            Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>


        {{-- ════════════════════════════════════════════════════════════════════
             MODAL: ENTREGAS
             ════════════════════════════════════════════════════════════════════ --}}
        <div x-show="modalEntrega"
             @click.away="modalEntrega = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4"
             x-cloak>
            <div @click.stop
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="bg-[#1C2A40] border border-emerald-500/20 rounded-2xl p-6 w-full max-w-lg shadow-2xl max-h-[90vh] overflow-y-auto">

                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-base font-bold text-emerald-400" style="font-family:'Syne',sans-serif">Entregas</h3>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Semana <span class="text-slate-300 font-semibold" x-text="entregaWeek"></span>
                            — {{ $monthNames[$filterMonth] }} {{ $filterYear }}
                        </p>
                    </div>
                    <button @click="modalEntrega = false"
                        class="text-slate-500 hover:text-white transition-colors cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <template x-if="currentSubmissions.length > 0">
                    <div class="mb-5">
                        <p class="text-[10px] uppercase tracking-widest text-slate-400 mb-2.5">
                            Archivos subidos (<span x-text="currentSubmissions.length"></span>)
                        </p>

                        <div class="flex flex-col gap-2">
                            <template x-for="sub in currentSubmissions" :key="sub.id">
    <div class="flex flex-col gap-2 bg-[#0e1a2d] rounded-xl px-3 py-2.5 border border-[#00C853]/15 group/sub">

        {{-- ── Fila principal: icono + nombre + acciones ── --}}
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                :class="sub.is_image ? 'bg-sky-500/20 text-sky-400' : 'bg-violet-500/20 text-violet-400'">
                <template x-if="sub.is_image">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 3h18M3 21h18" />
                    </svg>
                </template>
                <template x-if="!sub.is_image">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </template>
            </div>

            <div class="flex-1 min-w-0">
                <a :href="sub.url" target="_blank" x-text="sub.filename"
                    class="text-xs text-slate-200 hover:text-emerald-400 truncate block transition-colors font-medium"></a>
                <p x-show="sub.comments" x-text="sub.comments"
                    class="text-[10px] text-slate-500 truncate mt-0.5"></p>
            </div>

            <a :href="sub.url" target="_blank"
                class="p-1.5 rounded-lg text-slate-500 hover:text-emerald-400 hover:bg-emerald-500/10 transition-all opacity-0 group-hover/sub:opacity-100"
                title="Ver / descargar">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
            </a>

            <form :action="sub.delete_url" method="POST"
                @submit.prevent="if(confirm('¿Eliminar esta entrega?')) $el.submit()">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit"
                    class="p-1.5 rounded-lg text-slate-500 hover:text-red-400 hover:bg-red-500/10 transition-all opacity-0 group-hover/sub:opacity-100 cursor-pointer"
                    title="Eliminar entrega">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                    </svg>
                </button>
            </form>
        </div>

        {{-- ── Calificación (solo visible para admin/instructor) ── --}}
        @if($canGrade)
        <div x-data="{ gradingOpen: false }"
             class="border-t border-emerald-500/10 pt-2 mt-0.5">

            {{-- Badge de nota actual --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-[10px] uppercase tracking-widest text-slate-500">Calificación:</span>
                    <span x-show="sub.grade !== null && sub.grade !== undefined"
                        class="text-xs font-black px-2 py-0.5 rounded-full"
                        :class="sub.grade >= 60
                            ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30'
                            : 'bg-red-500/20 text-red-400 border border-red-500/30'"
                        x-text="sub.grade + '/100'">
                    </span>
                    <span x-show="sub.grade === null || sub.grade === undefined"
                        class="text-[10px] text-slate-600 italic">Sin calificar</span>
                </div>
                <button @click="gradingOpen = !gradingOpen" type="button"
                    class="text-[10px] px-2.5 py-1 rounded-lg border transition-all cursor-pointer"
                    :class="gradingOpen
                        ? 'bg-slate-700 text-slate-300 border-slate-600'
                        : 'bg-emerald-500/10 text-emerald-400 border-emerald-500/25 hover:bg-emerald-500/20'"
                    x-text="gradingOpen ? 'Cancelar' : (sub.grade !== null && sub.grade !== undefined ? 'Editar nota' : '+ Calificar')">
                </button>
            </div>

            {{-- Feedback existente --}}
            <p x-show="sub.feedback && !gradingOpen"
               x-text="'💬 ' + sub.feedback"
               class="text-[10px] text-slate-500 mt-1 italic leading-relaxed"></p>

            {{-- Formulario de calificación --}}
            <div x-show="gradingOpen"
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 -translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="mt-2.5">
                <form :action="sub.grade_url" method="POST" class="flex flex-col gap-2.5">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">

                    <div class="flex items-center gap-3">
                        <div class="flex-1">
                            <label class="text-[10px] uppercase tracking-widest text-slate-400 mb-1 block">
                                Nota <span class="text-slate-600">(0 – 100)</span>
                            </label>
                            <input type="number" name="grade" min="0" max="100" required
                                :value="sub.grade ?? ''"
                                placeholder="ej: 85"
                                class="w-full bg-[#111d30] border border-emerald-500/30 text-slate-200 text-sm rounded-xl px-3 py-2 focus:outline-none focus:border-emerald-400 placeholder-slate-600">
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] uppercase tracking-widest text-slate-400 mb-1 block">
                            Retroalimentación <span class="text-slate-600">(opcional)</span>
                        </label>
                        <textarea name="feedback" rows="2"
                            placeholder="Observaciones para el estudiante..."
                            :value="sub.feedback ?? ''"
                            class="w-full bg-[#111d30] border border-emerald-500/30 text-slate-200 text-xs rounded-xl px-3 py-2 focus:outline-none focus:border-emerald-400 placeholder-slate-600 resize-none"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-1.5 rounded-xl text-xs font-semibold bg-emerald-500 text-slate-900 hover:bg-emerald-400 transition-all cursor-pointer">
                            Guardar calificación
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

    </div>
</template>
                        </div>

                        <div class="flex items-center gap-3 mt-5 mb-4">
                            <div class="flex-1 h-px bg-emerald-500/15"></div>
                            <span class="text-[10px] uppercase tracking-widest text-slate-500">Agregar otra entrega</span>
                            <div class="flex-1 h-px bg-emerald-500/15"></div>
                        </div>
                    </div>
                </template>

                {{-- ── Formulario de subida ── --}}
                {{-- ✅ FIX: action construida con concatenación simple, sin template literal problemático --}}
                <form
                    :action="'{{ url('projects/' . $project->id . '/tasks') }}/' + entregaTaskId + '/submissions'"
                    method="POST"
                    enctype="multipart/form-data"
                    class="flex flex-col gap-4">
                    @csrf

                    <input type="hidden" name="week_number"  x-bind:value="entregaWeek">
                    <input type="hidden" name="filter_year"  value="{{ $filterYear }}">
                    <input type="hidden" name="filter_month" value="{{ $filterMonth }}">

                    <div>
                        <label class="text-xs uppercase tracking-widest text-slate-400 mb-1.5 block">Archivo</label>
                        <label
                            class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-[#00C853]/25 rounded-xl px-6 py-7 cursor-pointer hover:border-emerald-500/50 hover:bg-emerald-500/5 transition-all group"
                            x-data="{ filename: '' }">
                            <svg class="w-7 h-7 text-slate-500 group-hover:text-emerald-400 transition-colors"
                                fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <span class="text-xs text-slate-500 group-hover:text-slate-300 transition-colors text-center"
                                x-text="filename || 'Arrastra un archivo o selecciónalo'">
                            </span>
                            <span class="text-[10px] text-slate-600">Imágenes, PDF, Word, Excel, ZIP — máx. 20 MB</span>
                            <input type="file" name="file" required class="hidden"
                                @change="filename = $event.target.files[0]?.name ?? ''">
                        </label>
                    </div>

                    <div>
                        <label class="text-xs uppercase tracking-widest text-slate-400 mb-1.5 block">Comentarios <span class="text-slate-600">(opcional)</span></label>
                        <textarea name="comments" rows="2" placeholder="Notas sobre esta entrega..."
                            class="w-full bg-[#0e1a2d] border border-[#00C853]/20 text-slate-200 text-sm rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500/60 placeholder-slate-600 resize-none"></textarea>
                    </div>

                    <div class="flex justify-end gap-2 mt-1">
                        <button type="button" @click="modalEntrega = false"
                            class="px-4 py-2 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all cursor-pointer">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="px-5 py-2 rounded-xl text-sm font-semibold bg-emerald-500 text-slate-900 hover:bg-emerald-400 transition-all cursor-pointer">
                            Subir entrega
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>{{-- fin div Gantt --}}


    {{-- ── Modal editar proyecto ── --}}
    <div x-show="modalEditarAbierto"
         @click.away="modalEditarAbierto = false; document.body.style.overflow = '';"
         x-transition.opacity
         @close-modal.window="modalEditarAbierto = false"
         class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center"
         x-cloak>
        <div x-transition.scale.origin.center class="relative">
            @include('modals.edit.project')
        </div>
    </div>

    {{-- ── Modal eliminar proyecto ── --}}
    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div x-show="modalEliminarAbierto"
             @click.away="modalEliminarAbierto = false; document.body.style.overflow = '';"
             x-transition.opacity
             class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center"
             x-cloak>
            <div class="absolute inset-0" @click="modalEliminarAbierto = false"></div>
            <div x-transition.scale.origin.center
                 class="relative bg-[#1C2A40] border border-red-500/20 rounded-2xl p-6 w-full max-w-md shadow-2xl">
                <h2 class="text-lg font-bold text-red-400 mb-2" style="font-family:'Syne',sans-serif">Eliminar proyecto</h2>
                <p class="text-sm text-slate-400 mb-6">¿Estás seguro de que deseas eliminar este proyecto? Esta acción no se puede deshacer.</p>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="modalEliminarAbierto = false"
                        class="px-4 py-2 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-xl text-sm bg-red-500 text-white hover:bg-red-600 transition-all">
                        Sí, eliminar
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection