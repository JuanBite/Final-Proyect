@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div x-data="{ modalAbierto: false }" x-init="window.closeProjectModal = () => { modalAbierto = false }">
    <!-- Header -->
    <div class="flex items-center justify-between gap-6 mb-7">
        <h1 class="font-syne font-bold text-xl text-[#E8F4FF]">Tarjetas de <span class="text-[#00C853]">Proyecto</span>
        </h1>

        <form method="GET" action="{{ route('projects.index') }}" id="search-form"
            class="flex items-center w-full max-w-sm">
            <!-- Contenedor del buscador -->
            <div
                class="w-full flex items-center gap-2.5 bg-[#1C2A40] border border-[#00C853]/20 rounded-xl px-4 py-2.5 transition-all duration-200 hover:border-[#00C853]/40 focus-within:border-[#00C853]/60">

                <!-- Icono de búsqueda -->
                <svg class="w-5 h-5 text-slate-500 flex-shrink-0 transition-colors" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" />
                </svg>

                <!-- Input -->
                <input type="text" name="search" id="search-input" placeholder="Buscar proyecto..."
                    value="{{ request('search') }}"
                    class="bg-transparent text-sm text-slate-300 placeholder-slate-500 outline-none flex-1 min-w-0 transition-colors"
                    oninput="toggleClearBtn(this); liveSearch(this.value)">

                <!-- Botón limpiar -->
                <button type="button" id="clear-search" onclick="clearSearch()"
                    class="flex-shrink-0 w-5 h-5 flex items-center justify-center text-slate-500 hover:text-slate-300 transition-colors {{ request('search') ? '' : 'hidden' }}"
                    title="Limpiar búsqueda">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                    </svg>
                </button>
            </div>

            <button type="submit" class="hidden"></button>
        </form>

        <button @click="modalAbierto = true" type="button"
            class="flex items-center gap-2 px-5 py-3 bg-[#00C853] text-[#0A1628] font-semibold text-sm rounded-xl hover:brightness-110 transition-all cursor-pointer whitespace-nowrap flex-shrink-0">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Nuevo
        </button>
    </div>

    <!-- Cards -->
    <div id="projects-container" class="grid grid-cols-3 gap-5">
        @foreach($projects as $project)


        <!-- Card: Gimnasio -->
        <div
            class="card-hover bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden cursor-pointer hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30">
            <!-- Banner -->
            <div
                class="h-[90px] bg-gradient-to-br from-[#182236] to-[#111D30] border-b border-[#00C853]/15 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0"
                    style="background: radial-gradient(circle at 30% 50%, rgba(0,200,83,0.12) 0%, transparent 70%)">
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
                                    <circle cx="24" cy="24" r="18" fill="none" stroke="rgba(255,255,255,0.07)"
                                        stroke-width="6" />
                                    <!-- Progreso -->
                                    <circle cx="24" cy="24" r="18" fill="none" stroke="{{ $project->progress_color }}"
                                        stroke-width="6" stroke-dasharray="{{ $project->progress_circumference }}"
                                        stroke-dashoffset="{{ $project->progress_offset }}" stroke-linecap="round"
                                        transform="rotate(-90 24 24)" />
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
                        <span
                            class="text-[11px] font-medium px-3 py-1 rounded-full bg-[#FFD740]/12 text-[#FFD740] border border-[#FFD740]/25">
                            {{ ucwords(str_replace('_', ' ', strtolower($project->status))) }}
                        </span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach

    </div>
    <div class="mt-6">
        {{ $projects->links() }}
    </div>



    <!-- MODAL -->
    <div x-show="modalAbierto" x-transition.opacity
        class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center" style="display: none;"
        @click.away="modalAbierto = false" @keydown.escape.window="modalAbierto = false">
        <div x-show="modalAbierto" x-transition.scale.origin.center class="transform transition-all">
            @include('modals.create.project')
        </div>
    </div>
</div>

<script>
    function toggleClearBtn(input) {
    const btn = document.getElementById('clear-search');
    btn.classList.toggle('hidden', input.value === '');
}

function clearSearch() {
    const input = document.getElementById('search-input');
    input.value = '';
    toggleClearBtn(input);
    document.getElementById('search-form').submit();
}

let searchTimeout = null;

function liveSearch(value) {
    clearTimeout(searchTimeout);

    searchTimeout = setTimeout(() => {
        const params = new URLSearchParams(window.location.search);
        params.set('search', value);

        if (!value) params.delete('search');

        fetch(`{{ route('projects.index') }}?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            // 🔥 IMPORTANTE: reemplazar solo las cards
            document.getElementById('projects-container').innerHTML =
                doc.getElementById('projects-container').innerHTML;
        });
    }, 300);
}

document.addEventListener('click', function(e) {
    if (e.target.closest('.pagination a')) {
        e.preventDefault();

        const url = e.target.closest('a').href;

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            document.getElementById('projects-container').innerHTML =
                doc.getElementById('projects-container').innerHTML;

            document.querySelector('.mt-6').innerHTML =
                doc.querySelector('.mt-6').innerHTML;
        });
    }
});
</script>
@endsection