


@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div x-data="{ modalAbierto: false }" x-init="window.closeProjectModal = () => { modalAbierto = false }">
    <!-- Header -->
    <div class="flex items-center justify-between mb-7">
        <h1 class="font-syne font-bold text-xl text-[#E8F4FF]">Tarjetas de <span class="text-[#00C853]">Proyecto</span>
        </h1>
        <!-- Botón Nuevo con Alpine.js -->
        <button @click="modalAbierto = true" type="button" class="flex items-center gap-2 px-5 py-2 bg-[#00C853] text-[#0A1628] font-semibold text-sm rounded-xl hover:brightness-110 transition-all cursor-pointer">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Nuevo
        </button>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-3 gap-5">
        <!-- Card: Gimnasio -->
        <div class="card-hover bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden cursor-pointer hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30">
            <!-- Banner -->
            <div class="h-[90px] bg-gradient-to-br from-[#182236] to-[#111D30] border-b border-[#00C853]/15 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0" style="background: radial-gradient(circle at 30% 50%, rgba(0,200,83,0.12) 0%, transparent 70%)">
                </div>
                <span class="font-syne font-extrabold text-[28px] tracking-[3px] text-[#E8F4FF] relative z-10">SIG<span class="text-[#00C853]">PRO</span></span>
            </div>
            <!-- Body -->
            <a href="{{ url('projects/details') }}">
                <div class="p-5">
                    <h3 class="font-syne font-bold text-base text-[#E8F4FF] mb-2">Gimnasio</h3>
                    <div class="flex flex-col gap-1 mb-4">
                        <span class="text-xs text-[#8AAABB]">Sebastián Grijalva</span>
                        <span class="text-xs text-[#8AAABB]">Luis Miguel Muñoz</span>
                        <span class="text-xs text-[#8AAABB]">Juan David Quinchia</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="relative w-12 h-12">
                                <svg width="48" height="48" viewBox="0 0 48 48" style="transform:rotate(-90deg)">
                                    <circle cx="24" cy="24" r="18" fill="none" stroke="rgba(255,255,255,0.07)" stroke-width="6" />
                                    <circle cx="24" cy="24" r="18" fill="none" stroke="#FFD740" stroke-width="6" stroke-dasharray="113.1" stroke-dashoffset="90.48" stroke-linecap="round" />
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center font-syne font-extrabold text-[11px] text-[#FFD740]">
                                    20%</div>
                            </div>
                            <div class="text-[11px] text-[#8AAABB] leading-snug">Avance<br />actual</div>
                        </div>
                        <span class="text-[11px] font-medium px-3 py-1 rounded-full bg-[#FFD740]/12 text-[#FFD740] border border-[#FFD740]/25">En
                            progreso</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card: Sigpro Académico -->
        <div class="card-hover bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden cursor-pointer hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30">
            <div class="h-[90px] bg-gradient-to-br from-[#182236] to-[#111D30] border-b border-[#00C853]/15 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0" style="background: radial-gradient(circle at 30% 50%, rgba(0,200,83,0.12) 0%, transparent 70%)">
                </div>
                <span class="font-syne font-extrabold text-[28px] tracking-[3px] text-[#E8F4FF] relative z-10">SIG<span class="text-[#00C853]">PRO</span></span>
            </div>
            <div class="p-5">
                <h3 class="font-syne font-bold text-base text-[#E8F4FF] mb-2">Sigpro Académico</h3>
                <div class="flex flex-col gap-1 mb-4">
                    <span class="text-xs text-[#8AAABB]">Luis Miguel Muñoz</span>
                    <span class="text-xs text-[#8AAABB]">Sebastián Grijalva</span>
                    <span class="text-xs text-[#8AAABB]">Juan David Quinchia</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="relative w-12 h-12">
                            <svg width="48" height="48" viewBox="0 0 48 48" style="transform:rotate(-90deg)">
                                <circle cx="24" cy="24" r="18" fill="none" stroke="rgba(255,255,255,0.07)" stroke-width="6" />
                                <circle cx="24" cy="24" r="18" fill="none" stroke="#00C853" stroke-width="6" stroke-dasharray="113.1" stroke-dashoffset="56.55" stroke-linecap="round" />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center font-syne font-extrabold text-[11px] text-[#00C853]">
                                50%</div>
                        </div>
                        <div class="text-[11px] text-[#8AAABB] leading-snug">Avance<br />actual</div>
                    </div>
                    <span class="text-[11px] font-medium px-3 py-1 rounded-full bg-[#00C853]/12 text-[#00C853] border border-[#00C853]/25">Activo</span>
                </div>
            </div>
        </div>

        <!-- Card: Parking Sigpro -->
        <div class="card-hover bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden cursor-pointer hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30">
            <div class="h-[90px] bg-gradient-to-br from-[#182236] to-[#111D30] border-b border-[#00C853]/15 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0" style="background: radial-gradient(circle at 30% 50%, rgba(0,200,83,0.12) 0%, transparent 70%)">
                </div>
                <span class="font-syne font-extrabold text-[28px] tracking-[3px] text-[#E8F4FF] relative z-10">SIG<span class="text-[#00C853]">PRO</span></span>
            </div>
            <div class="p-5">
                <h3 class="font-syne font-bold text-base text-[#E8F4FF] mb-2">Parking Sigpro</h3>
                <div class="flex flex-col gap-1 mb-4">
                    <span class="text-xs text-[#8AAABB]">Sebastián Grijalva</span>
                    <span class="text-xs text-[#8AAABB]">Luis Miguel Muñoz</span>
                    <span class="text-xs text-[#8AAABB]">Juan David Quinchia</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="relative w-12 h-12">
                            <svg width="48" height="48" viewBox="0 0 48 48" style="transform:rotate(-90deg)">
                                <circle cx="24" cy="24" r="18" fill="none" stroke="rgba(255,255,255,0.07)" stroke-width="6" />
                                <circle cx="24" cy="24" r="18" fill="none" stroke="#00C853" stroke-width="6" stroke-dasharray="113.1" stroke-dashoffset="22.62" stroke-linecap="round" />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center font-syne font-extrabold text-[11px] text-[#00C853]">
                                80%</div>
                        </div>
                        <div class="text-[11px] text-[#8AAABB] leading-snug">Avance<br />actual</div>
                    </div>
                    <span class="text-[11px] font-medium px-3 py-1 rounded-full bg-[#00C853]/12 text-[#00C853] border border-[#00C853]/25">Casi
                        listo</span>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL -->
    <div x-show="modalAbierto" x-transition.opacity class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center" style="display: none;" @click.away="modalAbierto = false" @keydown.escape.window="modalAbierto = false">
        <div x-show="modalAbierto" x-transition.scale.origin.center class="transform transition-all">
            @include('modals.create.project')
        </div>
    </div>
</div>
@endsection
