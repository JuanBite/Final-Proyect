@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- ROW 1: Torta + Barras horizontales -->
<div class="grid grid-cols-2 gap-6">

    <!-- GRÁFICA TORTA (SVG donut) -->
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 transition-all">
        <div class="px-6 py-5 border-b border-[#2b2b2b] bg-[#111D30]/60">
            <h2 class="font-bold text-base" style="font-family:'Syne',sans-serif">Estado de <span class="text-emerald-400">Proyectos</span></h2>
            <p class="text-xs text-slate-500 mt-0.5">Distribución por estado actual</p>
        </div>
        <div class="p-6 flex items-center gap-8">
            <!-- SVG donut -->
            <div class="shrink-0">
                <svg width="176" height="176" viewBox="0 0 176 176">
                    <!-- Fondo ring -->
                    <circle cx="88" cy="88" r="68" fill="none" stroke="#182236" stroke-width="26" />
                    <!--
                  Circunferencia = 2π × 68 ≈ 427.3
                  Activo     1/3 ≈ 33% → 141  offset 0
                  En pausa   1/3 ≈ 33% → 141  offset -141
                  Planificado 1/3 ≈ 33% → 142 offset -282
                -->
                    <circle cx="88" cy="88" r="68" fill="none" stroke="#10b981" stroke-width="26" stroke-dasharray="141 427.3" stroke-dashoffset="0" transform="rotate(-90 88 88)" />
                    <circle cx="88" cy="88" r="68" fill="none" stroke="#facc15" stroke-width="26" stroke-dasharray="141 427.3" stroke-dashoffset="-141" transform="rotate(-90 88 88)" />
                    <circle cx="88" cy="88" r="68" fill="none" stroke="#38bdf8" stroke-width="26" stroke-dasharray="142 427.3" stroke-dashoffset="-282" transform="rotate(-90 88 88)" />
                    <!-- Separadores -->
                    <circle cx="88" cy="88" r="68" fill="none" stroke="#1C2A40" stroke-width="3" stroke-dasharray="1 427.3" stroke-dashoffset="0" transform="rotate(-90 88 88)" />
                    <!-- Centro -->
                    <text x="88" y="82" text-anchor="middle" fill="#e2e8f0" font-size="20" font-weight="800" font-family="Syne,sans-serif">3</text>
                    <text x="88" y="98" text-anchor="middle" fill="#475569" font-size="9" font-family="DM Sans,sans-serif" letter-spacing="2">PROYECTOS</text>
                </svg>
            </div>
            <!-- Leyenda -->
            <div class="flex flex-col gap-4 flex-1">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 shrink-0"></div>
                        <span class="text-sm text-slate-300">Activo</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-20 h-1.5 bg-[#182236] rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full" style="width:33%"></div>
                        </div>
                        <span class="text-sm font-bold text-emerald-400 w-7 text-right" style="font-family:'Syne',sans-serif">1</span>
                    </div>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-yellow-400 shrink-0"></div>
                        <span class="text-sm text-slate-300">En pausa</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-20 h-1.5 bg-[#182236] rounded-full overflow-hidden">
                            <div class="h-full bg-yellow-400 rounded-full" style="width:33%"></div>
                        </div>
                        <span class="text-sm font-bold text-yellow-400 w-7 text-right" style="font-family:'Syne',sans-serif">1</span>
                    </div>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-sky-400 shrink-0"></div>
                        <span class="text-sm text-slate-300">Planificado</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-20 h-1.5 bg-[#182236] rounded-full overflow-hidden">
                            <div class="h-full bg-sky-400 rounded-full" style="width:33%"></div>
                        </div>
                        <span class="text-sm font-bold text-sky-400 w-7 text-right" style="font-family:'Syne',sans-serif">1</span>
                    </div>
                </div>
                <div class="pt-3 border-t border-[#2b2b2b] flex items-center justify-between">
                    <span class="text-xs text-slate-500 uppercase tracking-wider">Total</span>
                    <span class="text-sm font-black text-slate-200" style="font-family:'Syne',sans-serif">3 proyectos</span>
                </div>
            </div>
        </div>
    </div>

    <!-- BARRAS HORIZONTALES — Avance por proyecto -->
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 transition-all">
        <div class="px-6 py-5 border-b border-[#2b2b2b] bg-[#111D30]/60 flex items-center justify-between">
            <div>
                <h2 class="font-bold text-base" style="font-family:'Syne',sans-serif">Avance por <span class="text-emerald-400">Proyecto</span></h2>
                <p class="text-xs text-slate-500 mt-0.5">Porcentaje de completitud actual</p>
            </div>
            <span class="text-xs text-slate-500 bg-[#182236] border border-[#2b2b2b] px-3 py-1 rounded-lg">2026</span>
        </div>
        <div class="p-6 flex flex-col gap-6">

            <div class="flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                        <span class="text-sm font-medium">Sigpro Académico</span>
                    </div>
                    <span class="font-black text-emerald-400 text-sm" style="font-family:'Syne',sans-serif">50%</span>
                </div>
                <div class="w-full h-3 bg-[#182236] rounded-full overflow-hidden border border-[#2b2b2b]">
                    <div class="h-full rounded-full bg-gradient-to-r from-emerald-700 to-emerald-400" style="width:50%"></div>
                </div>
                <div class="flex justify-between text-[10px] text-slate-500"><span>Feb 2026</span><span>Feb 2027</span></div>
            </div>

            <div class="flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                        <span class="text-sm font-medium">Portería Sigpro</span>
                    </div>
                    <span class="font-black text-yellow-400 text-sm" style="font-family:'Syne',sans-serif">0%</span>
                </div>
                <div class="w-full h-3 bg-[#182236] rounded-full overflow-hidden border border-[#2b2b2b]">
                    <div class="h-full rounded-full bg-gradient-to-r from-yellow-700 to-yellow-400" style="width:2%"></div>
                </div>
                <div class="flex justify-between text-[10px] text-slate-500"><span>Mar 2026</span><span>Dic 2026</span></div>
            </div>

            <div class="flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-sky-400"></div>
                        <span class="text-sm font-medium">Emprender</span>
                    </div>
                    <span class="font-black text-sky-400 text-sm" style="font-family:'Syne',sans-serif">0%</span>
                </div>
                <div class="w-full h-3 bg-[#182236] rounded-full overflow-hidden border border-[#2b2b2b]">
                    <div class="h-full rounded-full bg-gradient-to-r from-sky-700 to-sky-400" style="width:2%"></div>
                </div>
                <div class="flex justify-between text-[10px] text-slate-500"><span>Abr 2026</span><span>Ene 2027</span></div>
            </div>

        </div>
    </div>

</div>

<!-- ROW 2: Barras verticales -->
<div class="grid grid-cols-2 gap-6">


    <!-- DIAGRAMA DE BALANCE ACUMULADO (Burnup SVG) -->
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 transition-all">
        <div class="px-6 py-5 border-b border-[#2b2b2b] bg-[#111D30]/60">
            <h2 class="font-bold text-base" style="font-family:'Syne',sans-serif">Balance <span class="text-emerald-400">Acumulado</span></h2>
            <p class="text-xs text-slate-500 mt-0.5">Avance real vs. curva ideal · Sigpro Académico 2026</p>
        </div>
        <div class="p-6">
            <!--
              SVG burnup — 13 puntos (Feb → Feb 2027)
              Viewbox 0 0 420 180
              Eje Y: 0%=170, 100%=10 → y = 170 - (pct * 1.6)
              Eje X: 13 puntos → x = 30 + i * 30
              Ideal: línea recta (30,170)→(390,10)
              Real: Feb=0,Mar=0,Abr=5,May=10,Jun=15,Jul=20,Ago=25,Sep=30,Oct=40,Nov=45,Dic=50
            -->
            <svg width="100%" viewBox="0 0 420 195" style="overflow:visible">

                <!-- Líneas guía -->
                <line x1="30" y1="10" x2="400" y2="10" stroke="#2b2b2b" stroke-width="1" />
                <line x1="30" y1="50" x2="400" y2="50" stroke="#2b2b2b" stroke-width="1" />
                <line x1="30" y1="90" x2="400" y2="90" stroke="#2b2b2b" stroke-width="1" stroke-dasharray="4 3" opacity="0.6" />
                <line x1="30" y1="130" x2="400" y2="130" stroke="#2b2b2b" stroke-width="1" />
                <line x1="30" y1="170" x2="400" y2="170" stroke="#2b2b2b" stroke-width="1" />

                <!-- Etiquetas Y -->
                <text x="24" y="14" text-anchor="end" fill="#475569" font-size="9" font-family="DM Sans,sans-serif">100%</text>
                <text x="24" y="54" text-anchor="end" fill="#475569" font-size="9" font-family="DM Sans,sans-serif">75%</text>
                <text x="24" y="94" text-anchor="end" fill="#475569" font-size="9" font-family="DM Sans,sans-serif">50%</text>
                <text x="24" y="134" text-anchor="end" fill="#475569" font-size="9" font-family="DM Sans,sans-serif">25%</text>
                <text x="24" y="174" text-anchor="end" fill="#475569" font-size="9" font-family="DM Sans,sans-serif">0%</text>

                <!-- Área bajo curva ideal -->
                <polygon points="30,170 390,10 390,170" fill="rgba(0,200,83,0.04)" />

                <!-- Área bajo curva real -->
                <polygon points="30,170 60,170 90,162 120,154 150,146 180,138 210,130 240,122 270,106 300,98 330,90 360,170" fill="rgba(16,185,129,0.08)" />

                <!-- Línea ideal (punteada) -->
                <line x1="30" y1="170" x2="390" y2="10" stroke="#00C853" stroke-width="1.5" stroke-dasharray="6 4" opacity="0.35" />

                <!-- Línea real -->
                <polyline points="30,170 60,170 90,162 120,154 150,146 180,138 210,130 240,122 270,106 300,98 330,90" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round" />

                <!-- Puntos -->
                <circle cx="30" cy="170" r="3" fill="#10b981" />
                <circle cx="60" cy="170" r="3" fill="#10b981" />
                <circle cx="90" cy="162" r="3" fill="#10b981" />
                <circle cx="120" cy="154" r="3" fill="#10b981" />
                <circle cx="150" cy="146" r="3" fill="#10b981" />
                <circle cx="180" cy="138" r="3" fill="#10b981" />
                <circle cx="210" cy="130" r="3" fill="#10b981" />
                <circle cx="240" cy="122" r="3" fill="#10b981" />
                <circle cx="270" cy="106" r="3" fill="#10b981" />
                <circle cx="300" cy="98" r="3" fill="#10b981" />
                <!-- Punto actual destacado -->
                <circle cx="330" cy="90" r="5.5" fill="#10b981" stroke="#1C2A40" stroke-width="2" />

                <!-- Tooltip punto actual -->
                <rect x="308" y="72" width="36" height="14" rx="4" fill="rgba(16,185,129,0.18)" stroke="rgba(16,185,129,0.4)" stroke-width="1" />
                <text x="326" y="82.5" text-anchor="middle" fill="#10b981" font-size="9" font-family="Syne,sans-serif" font-weight="700">50%</text>

                <!-- Etiquetas eje X -->
                <text x="30" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">Feb</text>
                <text x="60" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">Mar</text>
                <text x="90" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">Abr</text>
                <text x="120" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">May</text>
                <text x="150" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">Jun</text>
                <text x="180" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">Jul</text>
                <text x="210" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">Ago</text>
                <text x="240" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">Sep</text>
                <text x="270" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">Oct</text>
                <text x="300" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">Nov</text>
                <text x="330" y="185" text-anchor="middle" fill="#10b981" font-size="8" font-family="DM Sans,sans-serif">Dic</text>
                <text x="360" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">Ene</text>
                <text x="390" y="185" text-anchor="middle" fill="#475569" font-size="8" font-family="DM Sans,sans-serif">Feb</text>

            </svg>

            <div class="flex items-center gap-6 mt-2 pt-3 border-t border-[#2b2b2b]">
                <div class="flex items-center gap-2 text-xs text-slate-400">
                    <svg width="24" height="8">
                        <line x1="0" y1="4" x2="24" y2="4" stroke="#00C853" stroke-width="1.5" stroke-dasharray="5 3" opacity="0.5" /></svg>
                    Curva ideal
                </div>
                <div class="flex items-center gap-2 text-xs text-slate-400">
                    <svg width="24" height="8">
                        <line x1="0" y1="4" x2="24" y2="4" stroke="#10b981" stroke-width="2.5" /></svg>
                    Avance real
                </div>
                <div class="ml-auto flex items-center gap-1.5">
                    <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                    <span class="text-xs text-slate-500">Hoy: <span class="text-emerald-400 font-bold" style="font-family:'Syne',sans-serif">50%</span></span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
