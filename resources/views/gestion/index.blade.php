@extends('layouts.app')
@section('title', 'Gestión')
@section('content')

<div x-data="appData('{{ auth()->user()->role }}')" x-init="init()">
    {{-- STATS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div
            class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 transition-all cursor-default">
            <div
                class="w-10 h-10 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                    <circle cx="12" cy="9" r="2.5" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif">{{ $regions->total()
                    }}</div>
                <div class="text-xs text-slate-400 mt-1">Regiones</div>
            </div>
        </div>
        <div
            class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-sky-400/15 text-sky-400 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif">{{ $centers->total()
                    }}</div>
                <div class="text-xs text-slate-400 mt-1">Centros</div>
            </div>
        </div>
        <div
            class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl transition-all cursor-default">
            <div
                class="w-10 h-10 rounded-xl bg-yellow-400/15 text-yellow-400 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif">{{ $cohorts->total()
                    }}</div>
                <div class="text-xs text-slate-400 mt-1">Fichas</div>
            </div>
        </div>
        <div
            class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl transition-all cursor-default">
            <div
                class="w-10 h-10 rounded-xl bg-purple-400/15 text-purple-400 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif">5</div>
                <div class="text-xs text-slate-400 mt-1">Proyectos activos</div>
            </div>
        </div>
    </div>

    {{-- TABLA --}}
    <div>
        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
            <h2 class="font-bold text-xl" style="font-family:'Syne',sans-serif">
                Gestión de
                <span class="text-emerald-400" x-text="tabs.find(t=>t.key===tab)?.label ?? ''"></span>
            </h2>
            <div class="flex items-center gap-2 flex-wrap">
                {{-- Search --}}
                <div <form method="GET" id="search-form" class="flex items-center">
                    <!-- Mantener tab -->
                    <input type="hidden" name="tab" value="{{ $tab }}">
                    <div
                        class="flex items-center gap-2 bg-slate-700 border border-emerald-500/20 rounded-xl px-3 py-0.1 opacity-70 flex-1 sm:flex-none">
                        <!-- Icono -->
                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8" />
                            <path d="M21 21l-4.35-4.35" />
                        </svg>
                        <!-- Input -->
                        <input type="text" name="search" id="search-input" placeholder="Búsqueda"
                            value="{{ request('search') }}"
                            class="border-none outline-none text-slate-400 text-sm placeholder-slate-500 w-full sm:w-44 bg-slate-700"
                            oninput="toggleClearBtn(this); liveSearch(this.value)">
                        <!-- Botón X -->
                        <button type="button" id="clear-search" onclick="clearSearch()"
                            class="text-slate-400 hover:text-slate-200 transition-colors {{ request('search') ? '' : 'hidden' }}">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M18 6L6 18M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- submit oculto por si presionan enter -->
                    <button type="submit" class="hidden"></button>
                    </form>
                </div>
                {{-- Tabs --}}
                <div class="flex gap-1.5">
                    <template x-for="t in tabs" :key="t.key">
                        <button
                            @click="window.location.href='?tab=' + t.key + '&search=' + (new URLSearchParams(window.location.search).get('search') ?? '')"
                            :class="tab===t.key ? 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30' : 'bg-slate-700 text-slate-400 border-emerald-500/15 hover:text-white'"
                            class="px-3 py-1.5 rounded-full text-xs font-medium border cursor-pointer transition-all"
                            x-text="t.label">
                        </button>
                    </template>
                </div>
                {{-- Nuevo --}}
                <button @click="openModal('add')"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 shadow-lg shadow-emerald-500/25 hover:bg-emerald-400 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Nuevo registro
                </button>
            </div>
        </div>

        {{-- TABLE --}}
        <div id="table-container">
            <div class="bg-[#1C2A40] border border-emerald-500/20 rounded-2xl overflow-hidden overflow-x-auto">
                <table class="w-full border-collapse min-w-[600px]">
                    <thead>
                        <tr class="bg-emerald-500/5 border-b border-emerald-500/15">
                            <template x-for="col in cols[tab]" :key="col">
                                <th class="text-left px-5 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium"
                                    x-text="labels[col]"></th>
                            </template>
                            <th
                                class="text-center px-5 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- REGIONS --}}
                        @if($tab === 'regions')
                        @forelse($regions as $region)
                        <tr class="border-b border-white/5 hover:bg-emerald-500/5 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-700 to-emerald-400 flex items-center justify-center font-black text-xs text-slate-900">
                                        {{ strtoupper(substr($region->name, 0, 2)) }}
                                    </div>
                                    <span class="text-sm font-semibold">{{ $region->name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                <span
                                    class="text-xs font-mono text-slate-300 bg-slate-800/60 px-2 py-0.5 rounded-md border border-white/10">
                                    {{ $region->code }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">
                                    {{-- Editar --}}
                                    <button type="button"
                                        @click="openModal('edit', @js(['id'=>$region->id,'name'=>$region->name,'code'=>$region->code]), 'regions')"
                                        class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-emerald-500/20 hover:text-emerald-400 transition-all cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </button>
                                    {{-- Eliminar --}}
                                    <button type="button"
                                        @click="openDelete('{{ route('regions.destroy', $region->id) }}')"
                                        class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-red-500/20 hover:text-red-400 transition-all cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                                            <path d="M10 11v6M14 11v6" />
                                            <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-10 text-slate-500 text-sm">Sin registros. Agrega el
                                primero.</td>
                        </tr>
                        @endforelse
                        @endif

                        {{-- CENTERS --}}
                        @if($tab === 'centers')
                        @forelse($centers as $center)
                        <tr class="border-b border-white/5 hover:bg-emerald-500/5 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-700 to-emerald-400 flex items-center justify-center font-black text-xs text-slate-900">
                                        {{ strtoupper(substr($center->name, 0, 2)) }}
                                    </div>
                                    <span class="text-sm font-semibold">{{ $center->name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                <span
                                    class="text-xs font-mono text-slate-300 bg-slate-800/60 px-2 py-0.5 rounded-md border border-white/10">
                                    {{ $center->code }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <span
                                    class="px-2 py-0.5 rounded-md text-xs bg-white/5 border border-white/10 text-slate-400">
                                    {{ $center->region->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button"
                                        @click="openModal('edit', @js(['id'=>$center->id,'name'=>$center->name,'code'=>$center->code,'region_id'=>$center->region_id]), 'centers')"
                                        class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-emerald-500/20 hover:text-emerald-400 transition-all cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </button>
                                    <button type="button"
                                        @click="openDelete('{{ route('centers.destroy', $center->id) }}')"
                                        class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-red-500/20 hover:text-red-400 transition-all cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                                            <path d="M10 11v6M14 11v6" />
                                            <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-10 text-slate-500 text-sm">Sin registros. Agrega el
                                primero.</td>
                        </tr>
                        @endforelse
                        @endif

                        {{-- COHORTS --}}
                        @if($tab === 'cohorts')
                        @forelse($cohorts as $cohort)
                        <tr class="border-b border-white/5 hover:bg-emerald-500/5 transition-colors">
                            <td class="px-5 py-3.5">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/25">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                    {{ $cohort->cohort_number }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="text-sm text-slate-300">{{ $cohort->program_name }}</span>
                            </td>
                            <td class="px-5 py-3.5">
                                <span
                                    class="px-2 py-0.5 rounded-md text-xs bg-white/5 border border-white/10 text-slate-400">
                                    {{ $cohort->center->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <span
                                    class="px-2 py-0.5 rounded-md text-xs bg-white/5 border border-white/10 text-slate-400">
                                    {{ $cohort->center->region->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button"
                                        @click="openModal('edit', @js(['id'=>$cohort->id,'cohort_number'=>$cohort->cohort_number,'program_name'=>$cohort->program_name,'center_id'=>$cohort->center_id]), 'cohorts')"
                                        class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-emerald-500/20 hover:text-emerald-400 transition-all cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </button>
                                    <button type="button"
                                        @click="openDelete('{{ route('cohorts.destroy', $cohort->id) }}')"
                                        class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-red-500/20 hover:text-red-400 transition-all cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                                            <path d="M10 11v6M14 11v6" />
                                            <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-10 text-slate-500 text-sm">Sin registros Agrega el
                                primero.</td>
                        </tr>
                        @endforelse
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <div class="mt-6">
    @if($tab === 'regions')
        {{ $regions->links() }}
    @elseif($tab === 'centers')
        {{ $centers->links() }}
    @elseif($tab === 'cohorts')
        {{ $cohorts->links() }}
    @endif
</div>

    {{-- MODAL CREAR / EDITAR --}}
    <div x-show="modal" x-transition.opacity.duration.200ms @click.away="modal=false; document.body.style.overflow=''"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
        <div @click.stop
            class="bg-[#111D30] border border-[#00C853]/20 rounded-2xl w-[500px] max-w-[95vw] overflow-hidden shadow-2xl">

            <div class="px-7 py-5 border-b border-[#00C853]/15 bg-[#00C853]/[.03] flex items-center justify-between">
                <h2 class="font-black text-lg" style="font-family:'Syne',sans-serif"
                    x-text="mode==='add' ? 'Nuevo registro' : 'Editar registro'"></h2>
                <button type="button" @click="modal=false; document.body.style.overflow=''"
                    class="text-slate-400 hover:text-white transition-colors text-lg leading-none">✕</button>
            </div>

            {{-- El form está DENTRO del modal. Action y _method los asigna Alpine via x-ref --}}
            <form method="POST" x-ref="modalForm">
                @csrf
                <input type="hidden" name="_method" x-ref="modalMethod" value="POST">

                <div class="px-7 py-6 grid grid-cols-2 gap-4">
                    <template x-for="f in formFields" :key="f.key">
                        <div class="flex flex-col gap-1">

                            <label class="text-xs text-slate-400 uppercase tracking-widest" x-text="f.label "></label>

                            <!-- INPUT NORMAL -->
                            <template x-if="f.key !== 'region_id' && f.key !== 'center_id'">
                                <input :name="f.key" x-model="form[f.key]" :placeholder="f.label"
                                    class="bg-[#182236] border border-[#00C853]/20 rounded px-3 py-2 text-sm">
                            </template>

                            <!-- SELECT REGIONES -->
                            <template x-if="f.key === 'region_id' && tab !== 'cohorts'">
                                <select name="region_id" x-model="form.region_id"
                                    class="bg-[#182236] border border-[#00C853]/20 rounded px-3 py-2 text-sm">

                                    <option value="">Seleccione una región</option>

                                    @foreach($regions as $region)
                                    <option value="{{ $region->id }}">
                                        {{ $region->name }}
                                    </option>
                                    @endforeach

                                </select>
                            </template>

                            <!-- SELECT CENTROS -->
                            <template x-if="f.key === 'center_id'">
                                <select name="center_id" x-model="form.center_id"
                                    class="bg-[#182236] border border-[#00C853]/20 rounded px-3 py-2 text-sm">

                                    <option value="">Seleccione un centro</option>

                                    @foreach($centers as $center)
                                    <option value="{{ $center->id }}">
                                        {{ $center->name }}
                                    </option>
                                    @endforeach

                                </select>
                            </template>

                        </div>
                    </template>
                </div>

                <div class="px-7 py-5 border-t border-[#00C853]/15 flex justify-end gap-3">
                    <button type="button" @click="modal=false; document.body.style.overflow=''"
                        class="px-5 py-2.5 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all cursor-pointer">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm bg-emerald-500 text-slate-900 font-semibold hover:bg-emerald-400 shadow-lg shadow-emerald-500/25 transition-all cursor-pointer">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL ELIMINAR --}}
    <div x-show="deleteModal" x-transition @click.away="deleteModal=false; document.body.style.overflow=''"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-cloak>
        <div @click.stop class="bg-[#1C2A40] border border-red-500/20 rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h2 class="text-lg font-bold text-red-400 mb-2" style="font-family:'Syne',sans-serif">Eliminar Registro</h2>
            <p class="text-sm text-slate-400 mb-6">¿Estás seguro de que deseas eliminar este registro? Esta acción no se
                puede deshacer.</p>

            <form method="POST" x-ref="deleteForm">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-2">
                    <button type="button" @click="deleteModal=false; document.body.style.overflow=''"
                        class="px-4 py-2 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all cursor-pointer">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-xl text-sm bg-red-500 text-white hover:bg-red-600 transition-all cursor-pointer">
                        Sí, eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    function toggleClearBtn(input) {
    const btn = document.getElementById('clear-search');
    btn.classList.toggle('hidden', input.value === '');
}

function clearSearch() {
    const input = document.getElementById('search-input');
    input.value = '';
    toggleClearBtn(input);

    const params = new URLSearchParams(window.location.search);
    params.delete('search');

    window.location.href = '?' + params.toString();
}

let searchTimeout = null;

function liveSearch(value) {
    clearTimeout(searchTimeout);

    searchTimeout = setTimeout(() => {
        const params = new URLSearchParams(window.location.search);
        params.set('search', value);
        params.set('tab', '{{ $tab }}');

        if (!value) params.delete('search');

        fetch(`?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            document.getElementById('table-container').innerHTML =
                doc.getElementById('table-container').innerHTML;
        });

    }, 200);
}
    document.addEventListener('alpine:init', () => {
    Alpine.data('appData', (role) => ({

    role: role,

    tab: '{{ $tab }}',
    modal: false,
    deleteModal: false,
    mode: 'add',
    form: {},

    // 👇 tabs ahora vacío, se define en init()
    tabs: [],

    cols: {
        regions: ['name', 'code'],
        centers: ['name', 'code', 'region_id'],
        cohorts: ['cohort_number', 'program_name', 'center_id', 'region_id']
    },

    labels: {
        name: 'Nombre',
        code: 'Código',
        region_id: 'Región',
        center_id: 'Centro',
        cohort_number: 'Número ficha',
        program_name: 'Programa'
    },

    storeRoutes: {
        regions: '{{ route("regions.store") }}',
        centers: '{{ route("centers.store") }}',
        cohorts: '{{ route("cohorts.store") }}'
    },

    updateRoutes: {
        regions: '/regions/',
        centers: '/centers/',
        cohorts:  '/cohorts/'
    },

    init() {

        // 🔥 CONTROL DE TABS POR ROL
        if (this.role === 'INSTRUCTOR') {
            this.tabs = [
                { key: 'cohorts', label: 'Fichas' }
            ];

            // 🔥 seguridad extra (si intentan forzar URL)
            if (this.tab !== 'cohorts') {
                this.tab = 'cohorts';
            }

        } else {
            this.tabs = [
                { key: 'regions', label: 'Regiones' },
                { key: 'centers', label: 'Centros' },
                { key: 'cohorts', label: 'Fichas' }
            ];
        }
    },

    get formFields() {
        if(this.tab === 'cohorts') {
            return [
                ...this.cols[this.tab]
                    .filter(c => c !== 'region_id' && c !== 'center_id')
                    .map(c => ({ key: c, label: this.labels[c] })),
                { key: 'center_id', label: 'Centro' }
            ];
        }
        return this.cols[this.tab].map(c => ({ key: c, label: this.labels[c] }));
    },

    openModal(mode, row = null, tabKey = null) {
        this.mode = mode;
        this.form = row ? { ...row } : {};

        const t = tabKey ?? this.tab;

        if (mode === 'add') {
            this.$refs.modalForm.action  = this.storeRoutes[t];
            this.$refs.modalMethod.value = 'POST';
        } else {
            this.$refs.modalForm.action  = this.updateRoutes[t] + row.id;
            this.$refs.modalMethod.value = 'PUT';
        }

        this.modal = true;
        document.body.style.overflow = 'hidden';
    },

    openDelete(route) {
        this.$refs.deleteForm.action = route;
        this.deleteModal = true;
        document.body.style.overflow = 'hidden';
    }

}))
})
</script>
@endpush