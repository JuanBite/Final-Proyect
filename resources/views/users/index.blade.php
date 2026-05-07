@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@section('breadcrumbs')
<span class="text-[#00C853]/30">›</span>
<span class="font-syne font-bold text-sm text-[#E8F4FF]">Usuarios</span>
@endsection

<div x-data="{ createModalOpen: false, editModalOpen: false, deleteModalOpen: false, showModalOpen: false }"
    x-init=" { createModalOpen = false, editModalOpen = false, deleteModalOpen = false, showModalOpen = false }"
    class="p-2 space-y-4">

    {{-- 🔹 STATS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Usuarios --}}
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl">{{ $totalUsers }}</div>
                <div class="text-xs text-slate-400">Usuarios totales</div>
            </div>
        </div>

        {{-- Líderes --}}
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-sky-400/15 text-sky-400 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                    <path d="M2 17l10 5 10-5" />
                    <path d="M2 12l10 5 10-5" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl">
                    {{ $totalLeaders }}
                </div>
                <div class="text-xs text-slate-400">Líderes de proyecto</div>
            </div>
        </div>

        {{-- Miembros --}}
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-yellow-400/15 text-yellow-400 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl">
                    {{ $totalMembers }}
                </div>
                <div class="text-xs text-slate-400">Integrantes activos</div>
            </div>
        </div>

        {{-- Proyectos activos --}}
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-red-400/15 text-red-400 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl">
                    {{ $projects->count() }}
                </div>
                <div class="text-xs text-slate-400">Proyectos activos</div>
            </div>
        </div>

    </div>

    {{-- 🔹 HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">

        <h2 class="text-xl font-bold text-white">
            Gestión de <span class="text-emerald-400">Usuarios</span>
        </h2>

        <div class="flex items-center gap-2 flex-wrap">

            {{-- Buscador --}}
            <form method="GET" action="{{ route('users.index') }}" class="flex items-center gap-2" id="search-form">
                <input type="hidden" name="sort" value="{{ $sort }}">

                <div
                    class="flex items-center gap-2 bg-slate-700 border border-emerald-500/20 rounded-xl px-3 py-0.1 opacity-70 flex-1 sm:flex-none">
                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" />
                    </svg>
                    <input type="text" name="search" id="search-input" placeholder="Búsqueda"
                        value="{{ request('search') }}"
                        class="border-none outline-none text-slate-400 text-sm placeholder-slate-500 w-full sm:w-44 bg-slate-700"
                        oninput="toggleClearBtn(this); liveSearch(this.value)">
                    <button type="button" id="clear-search" onclick="clearSearch()"
                        class="text-slate-400 hover:text-slate-200 transition-colors {{ request('search') ? '' : 'hidden' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Filtros rol --}}
                <div class="flex gap-1.5 items-center flex-wrap">
                    <a href="{{ route('users.index', array_merge(request()->except('filter'), ['sort' => $sort, 'cohort' => request('cohort')])) }}"
                        class="px-3 py-1.5 rounded-full text-xs border transition-all
                {{ !request('filter') ? 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30' : 'bg-slate-700 text-slate-400 border-white/10' }}">
                        Todos
                    </a>
                    <a href="{{ route('users.index', array_merge(request()->except('filter'), ['filter' => 'LEADER', 'sort' => $sort, 'cohort' => request('cohort')])) }}"
                        class="px-3 py-1.5 rounded-full text-xs border transition-all
                {{ request('filter') === 'LEADER' ? 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30' : 'bg-slate-700 text-slate-400 border-white/10' }}">
                        Líderes
                    </a>
                    <a href="{{ route('users.index', array_merge(request()->except('filter'), ['filter' => 'MEMBER', 'sort' => $sort, 'cohort' => request('cohort')])) }}"
                        class="px-3 py-1.5 rounded-full text-xs border transition-all
                {{ request('filter') === 'MEMBER' ? 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30' : 'bg-slate-700 text-slate-400 border-white/10' }}">
                        Integrantes
                    </a>

                    {{-- Toggle orden --}}
                    <a href="{{ route('users.index', array_merge(request()->query(), ['sort' => $sort === 'desc' ? 'asc' : 'desc'])) }}"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs border transition-all
                {{ $sort === 'asc' ? 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30' : 'bg-slate-700 text-slate-400 border-white/10' }}">
                        @if($sort === 'asc')
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 4.5h14.25M3 9h9.75M3 13.5h5.25m5.25-.75L17.25 9m0 0L21 12.75M17.25 9v12" />
                        </svg>
                        Recientes
                        @else
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21l3.75-3.75" />
                        </svg>
                        Antiguos
                        @endif
                    </a>

                    {{-- Filtro por ficha --}}
                    <select name="cohort" onchange="this.form.submit()"
                        class="px-3 py-1.5 rounded-full text-xs border transition-all bg-slate-700 border-white/10 outline-none cursor-pointer
                {{ request('cohort') ? 'text-emerald-400 border-emerald-500/30 bg-emerald-500/15' : 'text-slate-400' }}">
                        <option value="">Todas las fichas</option>
                        @foreach($cohorts as $c)
                        <option value="{{ $c->id }}" {{ request('cohort')==$c->id ? 'selected' : '' }}
                            style="background:#1e293b; color:white;">
                            {{ $c->cohort_number }} — {{ $c->program_name }}
                        </option>
                        @endforeach
                    </select>

                    {{-- Limpiar ficha --}}
                    @if(request('cohort'))
                    <a href="{{ route('users.index', request()->except('cohort')) }}"
                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs border transition-all bg-slate-700 text-slate-400 border-white/10 hover:text-red-400 hover:border-red-400/30">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Limpiar ficha
                    </a>
                    @endif
                </div>

                <button type="submit" class="hidden"></button>
            </form>

            {{-- Botón nuevo usuario --}}
            <button @click="createModalOpen = true"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm bg-emerald-500 text-slate-900">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Nuevo usuario
            </button>

        </div>
    </div>

    {{-- 🔹 TABLA --}}
    <div class="bg-[#1C2A40]  border border-emerald-500/20 rounded-2xl overflow-hidden overflow-x-auto">

        <table class="w-full min-w-[800px]" id="users-table">

            <thead class="bg-emerald-500/5 border-b border-emerald-500/15">
                <tr class="bg-emerald-500/5 border-b border-emerald-500/15">
                    <th
                        class="text-left px-4 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium w-[22%]">
                        Usuario</th>
                    <th
                        class="text-left px-4 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium w-[13%]">
                        Rol</th>
                    <th
                        class="text-left px-4 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium w-[13%]">
                        Rol de Proyecto</th>
                    <th
                        class="text-left px-4 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium w-[22%]">
                        Proyectos asignados</th>
                    <th
                        class="text-left px-4 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium w-[10%]">
                        Estado</th>
                    <th
                        class="text-left px-4 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium w-[10%]">
                        Ingreso</th>
                    <th
                        class="text-center px-4 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium w-[10%]">
                        Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($users as $user)

                @php
                $isLeader = $user->projectMembers->contains('project_role','LEADER');
                $role = $isLeader ? 'LEADER' : ($user->projectMembers->isNotEmpty() ? 'MEMBER' : null);
                @endphp

                <tr class="border-b border-white/5 hover:bg-emerald-500/5">

                    {{-- Usuario --}}
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-700 to-emerald-400 flex items-center justify-center text-black font-bold">
                                {{ strtoupper(substr($user->first_name,0,1)) }}{{
                                strtoupper(substr($user->last_name,0,1)) }}
                            </div>
                            <div>
                                <div class="text-sm font-semibold">
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </div>
                                <div class="text-xs text-slate-400">
                                    {{ $user->email }}
                                </div>
                            </div>
                        </div>
                    </td>

                    {{-- Rol --}}
                    <td class="px-4 py-3.5">
                        @if($user->role === 'ADMIN')
                        <span
                            class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-yellow-500/12 text-yellow-400 border border-yellow-500/25">
                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400"></span>
                            ADMIN
                        </span>
                        @elseif($user->role === 'INSTRUCTOR')
                        <span
                            class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-emerald-500/12 text-emerald-400 border border-emerald-500/25">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            INSTRUCTOR
                        </span>
                        @else
                        <span
                            class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-slate-500/20 text-slate-300 border border-slate-500/25">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            APRENDIZ
                        </span>
                        @endif
                    </td>

                    {{-- Rol de proyecto --}}
                    <td class="px-4 py-3.5">
                        @if($role === 'LEADER')
                        <span
                            class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-emerald-500/12 text-emerald-400 border border-emerald-500/25">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            LIDER
                        </span>
                        @elseif($role === 'MEMBER')
                        <span
                            class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-slate-500/20 text-slate-300 border border-slate-500/25">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            INTEGRANTE
                        </span>
                        @else
                        <span class="text-xs text-slate-500 italic">Sin rol</span>
                        @endif
                    </td>

                    {{-- Proyectos --}}
                    <td class="px-4 py-3.5">
                        <div class="flex flex-wrap gap-1">
                            @forelse($user->projects as $project)
                            <span
                                class="px-2 py-0.5 rounded-md text-xs bg-white/5 border border-white/10 text-slate-400 truncate max-w-[150px]">
                                {{ $project->name }}
                            </span>
                            @empty
                            <span class="text-xs text-slate-500 italic">Sin proyectos</span>
                            @endforelse
                        </div>
                    </td>

                    {{-- Estado --}}
                    <td class="px-4 py-3.5">
                        @if($user->status)
                        <span class="inline-flex items-center gap-1.5 text-sm">
                            <span
                                class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_0_3px_rgba(52,211,153,0.2)]"></span>
                            Activo
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 text-sm text-slate-400">
                            <span class="w-2 h-2 rounded-full bg-slate-500"></span>
                            Inactivo
                        </span>
                        @endif
                    </td>

                    {{-- Fecha --}}
                    <td class="px-4 py-3.5 text-xs text-slate-400">
                        {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                    </td>

                    {{-- Acciones --}}
                    <td class="px-4 py-3.5">
                        <div class="flex items-center justify-center gap-1.5">
                            <button @click="editModalOpen = true, currentUserId = {{ $user->id }}"
                                class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-emerald-500/20 hover:text-emerald-400 transition-all cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                            </button>

                            <button @click="deleteModalOpen = true; currentUserId = {{ $user->id }}"
                                class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-red-500/20 hover:text-red-400 transition-all cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <polyline points="3 6 5 6 21 6" />
                                    <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                                    <path d="M10 11v6M14 11v6" />
                                    <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                                </svg>
                            </button>

                            <button
                                @click="showModalOpen = true; currentShowUserId = {{ $user->id }}; document.body.style.overflow='hidden'"
                                class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-[#40C4FF]/20 hover:text-[#40C4FF] transition-all cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Paginador --}}
        @if($users->hasPages())
        <div class="flex items-center justify-between px-5 py-4 border-t border-white/5">
            <span class="text-xs text-slate-400">
                Mostrando {{ $users->firstItem() }}–{{ $users->lastItem() }} de {{ $users->total() }} usuarios
            </span>
            <div class="flex items-center gap-1">
                {{-- Anterior --}}
                @if($users->onFirstPage())
                <span class="px-3 py-1.5 rounded-lg text-xs text-slate-600 bg-white/5 cursor-not-allowed">←
                    Anterior</span>
                @else
                <a href="{{ $users->previousPageUrl() }}"
                    class="px-3 py-1.5 rounded-lg text-xs text-slate-400 bg-white/5 hover:bg-emerald-500/20 hover:text-emerald-400 transition-all">
                    ← Anterior
                </a>
                @endif

                {{-- Páginas --}}
                @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="px-3 py-1.5 rounded-lg text-xs transition-all
                {{ $page == $users->currentPage()
                    ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30'
                    : 'text-slate-400 bg-white/5 hover:bg-emerald-500/10 hover:text-emerald-400' }}">
                    {{ $page }}
                </a>
                @endforeach

                {{-- Siguiente --}}
                @if($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}"
                    class="px-3 py-1.5 rounded-lg text-xs text-slate-400 bg-white/5 hover:bg-emerald-500/20 hover:text-emerald-400 transition-all">
                    Siguiente →
                </a>
                @else
                <span class="px-3 py-1.5 rounded-lg text-xs text-slate-600 bg-white/5 cursor-not-allowed">Siguiente
                    →</span>
                @endif
            </div>
        </div>
        @endif
        <!-- Modal de creación de usuario -->
        <div x-show="createModalOpen" @close-create-modal.window="createModalOpen=false"
            x-transition.opacity.duration.200ms
            class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center"
            @click.away="createModalOpen=false; document.body.style.overflow=''" x-cloak>
            <div @click.stop>
                @include('modals.create.user')
            </div>
        </div>
        <!-- Modal de edición de usuario -->
        <div x-show="editModalOpen" @close-edit-modal.window="editModalOpen=false; currentUserId=null"
            x-transition.opacity.duration.200ms
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
            @click.away="editModalOpen=false; document.body.style.overflow=''; currentUserId=null" x-cloak>
            @foreach($users as $user)
            <div x-show="editModalOpen && currentUserId === {{ $user->id }}">
                @include('modals.edit.user', ['user' => $user])
            </div>
            @endforeach
        </div>

        <!-- MODAL ELIMINAR -->
        <div x-show="deleteModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
            <div @click.away="deleteModalOpen = false" class="bg-[#1C2A40] p-6 rounded-2xl w-full max-w-md">
                <h2 class="text-red-400 font-bold mb-2">Eliminar usuario</h2>
                <p class="text-sm text-slate-400 mb-6">¿Seguro que deseas eliminar este usuario?</p>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="deleteModalOpen = false"
                        class="px-4 py-2 bg-slate-700 rounded-xl">Cancelar</button>
                    @foreach($users as $user)
                    <form x-show="currentUserId === {{ $user->id }}" method="POST"
                        action="{{ route('users.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 rounded-xl text-white">Eliminar</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- MODAL SHOW --}}
        <div x-show="showModalOpen" @close-show-modal.window="showModalOpen=false; currentShowUserId=null"
            x-transition.opacity.duration.200ms
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
            @click.away="showModalOpen=false; document.body.style.overflow=''; currentShowUserId=null" x-cloak>
            @foreach($users as $user)
            <div x-show="showModalOpen && currentShowUserId === {{ $user->id }}">
                @include('modals.show.user', ['user' => $user])
            </div>
            @endforeach
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

        // Debounce: espera 300ms después de que el usuario deje de escribir
        searchTimeout = setTimeout(() => {
            const params = new URLSearchParams(window.location.search);
            params.set('search', value);
            if (!value) params.delete('search');

            fetch(`{{ route('users.index') }}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    // Reemplaza solo la tabla/lista de usuarios
                    document.getElementById('users-table').innerHTML =
                        doc.getElementById('users-table').innerHTML;
                });
        }, 300);
    }

</script>

@endsection