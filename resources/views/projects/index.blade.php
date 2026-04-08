@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div x-data="{ modalAbierto: false }" x-init="window.closeProjectModal = () => { modalAbierto = false }">
    <!-- Header -->
    <div class="flex items-center justify-between mb-7">
        <h1 class="font-syne font-bold text-xl text-[#E8F4FF]">Tarjetas de <span class="text-[#00C853]">Proyecto</span>
        </h1>
        
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
        @foreach($projects as $project)


        <!-- Card: Gimnasio -->
        <div class="card-hover bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden cursor-pointer hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30">
            <!-- Banner -->
            <div class="h-[90px] bg-gradient-to-br from-[#182236] to-[#111D30] border-b border-[#00C853]/15 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0" style="background: radial-gradient(circle at 30% 50%, rgba(0,200,83,0.12) 0%, transparent 70%)">
                </div>
                <span class="text-[20px] text-[#ffffff]">{{ $project->name }}<span class=""></span></span>
            </div>
            <!-- Body -->
            <a href="{{ route('projects.show', $project->id) }}">
                <div class="p-5 flex flex-col">
                    <h3 class="font-syne font-bold text-base text-[#E8F4FF] mb-2">{{ $project->name }}</h3>
                    <div class="flex flex-col gap-1 mb-4">

                        @forelse ($project->users as $user)

                        <span class="text-sm text-gray-400">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </span>

                        @empty

                        <span class="text-sm text-gray-400">
                            No se encuentran miembros
                        </span>

                        @endforelse

                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">

                            <div class="relative w-14 h-14 flex items-center justify-center">

                                <svg class="absolute" width="56" height="56" viewBox="0 0 48 48">
                                    <!-- Fondo -->
                                    <circle cx="24" cy="24" r="18" fill="none" stroke="rgba(255,255,255,0.07)" stroke-width="6" />
                                    <!-- Progreso -->
                                    <circle cx="24" cy="24" r="18" fill="none" stroke="{{ $project->progress_color }}" stroke-width="6" stroke-dasharray="{{ $project->progress_circumference }}" stroke-dashoffset="{{ $project->progress_offset }}" stroke-linecap="round" transform="rotate(-90 24 24)" />
                                </svg>

                                <!-- Texto -->
                                <span class="text-[12px] font-extrabold" style="color: {{ $project->progress_color }}">
                                    {{ number_format($project->progress, 0) }}%
                                </span>

                            </div>

                            <div class="text-[11px] text-[#8AAABB] leading-snug">
                                Avance<br />actual
                            </div>

                        </div>
                        <span class="text-[11px] font-medium px-3 py-1 rounded-full bg-[#FFD740]/12 text-[#FFD740] border border-[#FFD740]/25">
                            {{ ucwords(str_replace('_', ' ', strtolower($project->status))) }}
                        </span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>


    <!-- MODAL -->
    <div x-show="modalAbierto" x-transition.opacity class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center" style="display: none;" @click.away="modalAbierto = false" @keydown.escape.window="modalAbierto = false">
        <div x-show="modalAbierto" x-transition.scale.origin.center class="transform transition-all">
            @include('modals.create.project')
        </div>
    </div>
</div>
@endsection
