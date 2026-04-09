@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

@php
    $user = Auth::user();
@endphp

{{-- ================================================================
     HEADER
================================================================ --}}
<div class="flex items-end justify-between mb-8">
    <div>
        <p class="text-[10px] font-mono text-green-400/60 uppercase tracking-[0.2em] mb-1">Panel de Control</p>
        <h1 class="font-syne text-3xl font-extrabold text-white leading-tight">
            ¡Bienvenido, <span class="text-green-400">{{ $user->first_name . ' ' . $user->last_name }}</span> 👋
        </h1>
        <p class="text-gray-400 text-sm mt-1.5">Gestión de proyectos de grado · {{ $today->format('d M Y') }}</p>
    </div>
</div>

{{-- ================================================================
     STAT CARDS
================================================================ --}}
<div class="grid grid-cols-2 lg:grid-cols-5 gap-3 mb-7">

    <div class="lg:col-span-1 bg-[#1C2A40] border border-white/[0.07] rounded-xl p-4 hover:border-white/20 transition-colors">
        <p class="text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-2">Total</p>
        <p class="font-syne text-4xl font-extrabold text-white">{{ $stats['total'] }}</p>
        <p class="text-[11px] text-gray-500 font-mono mt-1">proyectos registrados</p>
    </div>

    <div class="bg-[#1C2A40] border border-yellow-400/25 rounded-xl p-4 hover:border-yellow-400/50 transition-colors">
        <p class="text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-2">En Progreso</p>
        <p class="font-syne text-4xl font-extrabold text-yellow-400">{{ $stats['en_progreso'] }}</p>
        <div class="mt-2 h-1 bg-white/[0.05] rounded-full overflow-hidden">
            <div class="h-full bg-yellow-400 rounded-full" style="width:{{ $stats['total'] ? round($stats['en_progreso']/$stats['total']*100) : 0 }}%"></div>
        </div>
    </div>

    <div class="bg-[#1C2A40] border border-red-400/25 rounded-xl p-4 hover:border-red-400/50 transition-colors">
        <p class="text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-2">Con Retraso</p>
        <p class="font-syne text-4xl font-extrabold text-red-400">{{ $stats['con_retraso'] }}</p>
        <div class="mt-2 h-1 bg-white/[0.05] rounded-full overflow-hidden">
            <div class="h-full bg-red-400 rounded-full" style="width:{{ $stats['total'] ? round($stats['con_retraso']/$stats['total']*100) : 0 }}%"></div>
        </div>
    </div>

    <div class="bg-[#1C2A40] border border-green-400/25 rounded-xl p-4 hover:border-green-400/50 transition-colors">
        <p class="text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-2">Completados</p>
        <p class="font-syne text-4xl font-extrabold text-green-400">{{ $stats['completados'] }}</p>
        <div class="mt-2 h-1 bg-white/[0.05] rounded-full overflow-hidden">
            <div class="h-full bg-green-400 rounded-full" style="width:{{ $stats['total'] ? round($stats['completados']/$stats['total']*100) : 0 }}%"></div>
        </div>
    </div>

    <div class="bg-[#1C2A40] border border-green-500/20 rounded-xl p-4 hover:border-green-500/40 transition-colors">
        <p class="text-[10px] font-mono text-gray-500 uppercase tracking-widest mb-2">Avance Global</p>
        @php
            $avg = $stats['avg_progress'];
            $r = 18; $circ = 2 * pi() * $r;
            $offset = $circ - ($avg / 100) * $circ;
            $avgColor = $avg >= 70 ? '#4ade80' : ($avg >= 40 ? '#facc15' : '#f87171');
        @endphp
        <div class="flex items-center gap-3">
            <svg width="48" height="48" viewBox="0 0 48 48">
                <circle cx="24" cy="24" r="{{ $r }}" fill="none" stroke="rgba(255,255,255,0.06)" stroke-width="5"/>
                <circle cx="24" cy="24" r="{{ $r }}" fill="none" stroke="{{ $avgColor }}" stroke-width="5"
                    stroke-dasharray="{{ $circ }}" stroke-dashoffset="{{ $offset }}"
                    stroke-linecap="round" transform="rotate(-90 24 24)"/>
                <text x="24" y="28" text-anchor="middle" fill="white" font-size="10" font-weight="700" font-family="monospace">{{ $avg }}%</text>
            </svg>
            <div>
                <p class="font-syne text-xl font-extrabold" style="color:{{ $avgColor }}">{{ $avg }}%</p>
                <p class="text-[10px] text-gray-500 font-mono">promedio</p>
            </div>
        </div>
    </div>

</div>

{{-- ================================================================
     FILA 2: DISTRIBUCIÓN + EN RIESGO
================================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-5">

    {{-- DONUT — Distribución de estados --}}
    <div class="lg:col-span-1 bg-[#1C2A40] border border-white/[0.07] rounded-xl p-5">
        <div class="flex items-center gap-2 mb-5">
            <div class="w-6 h-6 rounded-lg bg-green-500/10 border border-green-500/20 flex items-center justify-center">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-green-400">
                    <path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-syne font-bold text-white">Distribución</p>
                <p class="text-[10px] font-mono text-gray-500 uppercase tracking-widest">por estado</p>
            </div>
        </div>

        <div class="flex justify-center mb-4">
            <div class="relative" style="width:180px;height:180px">
                <canvas id="donutChart" width="180" height="180"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="font-syne text-3xl font-extrabold text-white">{{ $stats['total'] }}</span>
                    <span class="text-[10px] font-mono text-gray-500 uppercase tracking-widest">total</span>
                </div>
            </div>
        </div>

        {{-- FIX: si no hay datos mostramos mensaje en lugar de donut vacío --}}
        @if($stats['total'] === 0)
        <p class="text-[11px] font-mono text-gray-500 text-center py-2">Sin proyectos registrados</p>
        @endif

        <div class="space-y-2">
            @foreach($statusConfig as $key => $cfg)
            @php $count = match($key) {
                'IN_PROGRESS' => $stats['en_progreso'],
                'COMPLETED'   => $stats['completados'],
                'DELAYED'     => $stats['con_retraso'],
                default       => null   
            }; @endphp
            @if(!is_null($count))
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full" style="background:{{ $cfg['color'] }}"></div>
                    <span class="text-[11px] font-mono text-gray-400">{{ $cfg['label'] }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-20 h-1 bg-white/[0.05] rounded-full overflow-hidden">
                        <div class="h-full rounded-full" style="width:{{ $stats['total'] ? round($count/$stats['total']*100) : 0 }}%; background:{{ $cfg['color'] }}"></div>
                    </div>
                    <span class="text-[11px] font-mono font-bold w-4 text-right" style="color:{{ $cfg['color'] }}">{{ $count }}</span>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    {{-- EN RIESGO --}}
    <div class="lg:col-span-2 bg-[#1C2A40] border border-red-400/20 rounded-xl p-5">
        {{-- FIX: el style de scrollbar estaba aquí por error, se eliminó --}}
        <div class="flex items-center gap-2 mb-5">
            <div class="w-6 h-6 rounded-lg bg-red-400/10 border border-red-400/20 flex items-center justify-center">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-red-400">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-syne font-bold text-white">En Riesgo</p>
                <p class="text-[10px] font-mono text-gray-500 uppercase tracking-widest">vencen pronto · próximos vencimientos</p>
            </div>
        </div>
        @if($at_risk->count())
        <div class="space-y-3 max-h-96 overflow-y-auto pr-1" style="scrollbar-width:thin; scrollbar-color:rgba(255,255,255,0.1) transparent">
            @foreach($at_risk as $rp)
            @php
                $daysLeft = $rp->due_date ? $today->diffInDays($rp->due_date, false) : null;
                $urgency  = is_null($daysLeft) ? 'S/F' : ($daysLeft < 0 ? 'VENCIDO' : ($daysLeft === 0 ? 'HOY' : ($daysLeft === 1 ? 'MAÑANA' : "en {$daysLeft}d")));
                $urgColor = is_null($daysLeft) ? '#6b7280' : ($daysLeft <= 0 ? '#f87171' : ($daysLeft <= 7 ? '#fb923c' : '#facc15'));
            @endphp
            <div class="p-3 rounded-lg bg-white/[0.03] border border-white/[0.06] hover:border-red-400/20 transition-colors">
                <div class="flex items-start justify-between gap-2 mb-2">
                    <p class="text-[11px] font-mono text-white/80 font-semibold leading-snug">{{ $rp->name }}</p>
                    <span class="shrink-0 text-[9px] font-mono font-bold px-1.5 py-0.5 rounded"
                          style="background:{{ $urgColor }}20; color:{{ $urgColor }}">{{ $urgency }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex-1 h-1.5 bg-white/[0.05] rounded-full overflow-hidden">
                        <div class="h-full rounded-full bg-red-400/70" style="width:{{ $rp->progress }}%"></div>
                    </div>
                    <span class="text-[10px] font-mono text-red-400 shrink-0">{{ $rp->progress }}%</span>
                </div>
                @if($rp->leader_name)
                <p class="text-[9px] font-mono text-gray-500 mt-1.5">
                    Líder: {{ $rp->leader_name }}
                </p>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="flex flex-col items-center justify-center h-40 gap-2">
            <div class="w-10 h-10 rounded-full bg-green-400/10 border border-green-400/20 flex items-center justify-center">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-green-400">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <p class="text-[11px] font-mono text-gray-500 text-center">Sin proyectos en riesgo<br>en los próximos 14 días</p>
        </div>
        @endif
    </div>

</div>

{{-- ================================================================
     FILA 3: AVANCE POR PROYECTO FULL WIDTH
================================================================ --}}
<div class="grid grid-cols-1 gap-5 mb-5">

    <div class="bg-[#1C2A40] border border-white/[0.07] rounded-xl p-5">
        <div class="flex items-center gap-2 mb-5">
            <div class="w-6 h-6 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-blue-400">
                    <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/>
                    <line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-syne font-bold text-white">Avance por Proyecto</p>
                <p class="text-[10px] font-mono text-gray-500 uppercase tracking-widest">progreso individual</p>
            </div>
        </div>

        <div class="space-y-3 max-h-96 overflow-y-auto pr-1" style="scrollbar-width:thin; scrollbar-color:rgba(255,255,255,0.1) transparent">
            @forelse($projects as $p)
            @php
                $cfg      = $statusConfig[$p->status] ?? $statusConfig['IN_PROGRESS'];
                $pct      = $p->progress ?? 0;
                $daysLeft = $p->due_date ? $today->diffInDays($p->due_date, false) : null;
            @endphp
            <div class="group">
                <div class="flex items-center justify-between mb-1">
                    {{-- FIX: max-w relativo en lugar de píxeles fijos --}}
                    <div class="flex items-center gap-2 min-w-0">
                        <span class="text-[11px] font-mono text-gray-300 truncate max-w-[40%]">{{ $p->name }}</span>
                        <span class="shrink-0 text-[9px] font-mono px-1.5 py-0.5 rounded {{ $cfg['bg'] }} {{ $cfg['text'] }}">{{ $cfg['label'] }}</span>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        @if(!is_null($daysLeft))
                        <span class="text-[9px] font-mono {{ $daysLeft < 0 ? 'text-red-400' : ($daysLeft <= 7 ? 'text-yellow-400' : 'text-gray-500') }}">
                            {{ $daysLeft < 0 ? 'Vencido' : $daysLeft.'d restantes' }}
                        </span>
                        @endif
                        <span class="text-[11px] font-mono font-bold" style="color:{{ $cfg['color'] }}">{{ $pct }}%</span>
                    </div>
                </div>
                <div class="h-2 bg-white/[0.05] rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-500"
                         style="width:{{ $pct }}%; background:{{ $cfg['color'] }}; opacity:0.85"></div>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-sm font-mono text-center py-8">No hay proyectos registrados</p>
            @endforelse
        </div>
    </div>

</div>

{{-- ================================================================
     CHART.JS — solo Donut
================================================================ --}}
@push('page-scripts')
<script>
(function () {
    const tooltip = {
        backgroundColor: '#0d1b2e',
        borderColor: 'rgba(255,255,255,0.08)',
        borderWidth: 1,
        titleColor: 'rgba(255,255,255,0.4)',
        bodyColor: '#fff',
        padding: 10,
        cornerRadius: 10,
        titleFont: { family: 'monospace', size: 10 },
        bodyFont: { family: 'monospace', size: 12, weight: 'bold' },
    };

    // FIX: datos casteados a entero para evitar problemas si llegan como string
    const chartData = [
        {{ (int)$stats['en_progreso'] }},
        {{ (int)$stats['completados'] }},
        {{ (int)$stats['con_retraso'] }},
    ];

    function renderDonut() {
        if (typeof window.Chart === 'undefined') {
            return window.setTimeout(renderDonut, 50);
        }

        const ctx = document.getElementById('donutChart');
        if (!ctx) {
            return window.setTimeout(renderDonut, 50);
        }

        // FIX: si no hay datos, no renderizamos el donut para evitar advertencias de Chart.js
        const total = chartData.reduce((a, b) => a + b, 0);
        if (total === 0) return;

        window.Chart.defaults.color = 'rgba(255,255,255,0.25)';
        window.Chart.defaults.borderColor = 'rgba(255,255,255,0.05)';

        new window.Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['En Progreso', 'Completados', 'Con Retraso'],
                datasets: [{
                    data: chartData,
                    backgroundColor: ['#facc15', '#4ade80', '#f87171'],
                    borderColor: 'transparent',
                    borderRadius: 4,
                    spacing: 3,
                    hoverOffset: 6,
                }],
            },
            options: {
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        ...tooltip,
                        callbacks: { label: ctx => ` ${ctx.parsed} proyecto${ctx.parsed !== 1 ? 's' : ''}` },
                    },
                },
            },
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', renderDonut);
    } else {
        renderDonut();
    }
})();
</script>
@endpush

@endsection