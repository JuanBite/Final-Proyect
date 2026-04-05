@extends('layouts.app')

@section('title', 'Gestión')

@section('content')

<div x-data="appData()" x-init="init()">

    {{-- 🔹 STATS --}}
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
                <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif"
                    x-text="db.regions.length">0</div>
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
                <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif"
                    x-text="db.centers.length">0</div>
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
                    <polyline points="10 9 9 9 8 9" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif"
                    x-text="db.fichas.length">0</div>
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

    {{-- 🔹 TABLA --}}
    <div>

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
            <h2 class="font-bold text-xl" style="font-family:'Syne',sans-serif">
                Gestión de
                <span class="text-emerald-400" x-text="tabs.find(t=>t.key===tab)?.label ?? ''"></span>
            </h2>

            <div class="flex items-center gap-2 flex-wrap">

                {{-- Buscador --}}
                <div
                    class="flex items-center gap-2 bg-slate-700 border border-emerald-500/20 rounded-xl px-3 py-2 opacity-70">
                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" />
                    </svg>
                    <input type="text" placeholder="Busqueda"
                        class="border-none outline-none text-slate-400 text-sm placeholder-slate-500 w-44 bg-slate-700 ">
                </div>

                {{-- Tabs como filtros --}}
                <div class="flex gap-1.5">
                    <template x-for="t in tabs" :key="t.key">
                        <button @click="tab=t.key; search=''" :class="tab===t.key
                                ? 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30'
                                : 'bg-slate-700 text-slate-400 border-emerald-500/15 hover:text-white'"
                            class="px-3 py-1.5 rounded-full text-xs font-medium border cursor-pointer transition-all"
                            x-text="t.label">
                        </button>
                    </template>
                </div>

                {{-- Botón nuevo --}}
                <button @click="openModal('add')" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium
                           bg-emerald-500 text-slate-900 shadow-lg shadow-emerald-500/25
                           hover:bg-emerald-400 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Nuevo registro
                </button>

            </div>
        </div>

        {{-- TABLE --}}
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
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <template x-for="row in rows" :key="row.id">
                        <tr class="border-b border-white/5 last:border-0 hover:bg-emerald-500/5 transition-colors">

                            <template x-for="(col, index) in cols[tab]" :key="col">
                                <td class="px-5 py-3.5">

                                    {{-- Primera columna: nombre con avatar --}}
                                    <template x-if="index === 0">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-700 to-emerald-400
                                                        flex items-center justify-center font-black text-xs shrink-0 text-slate-900"
                                                style="font-family:'Syne',sans-serif"
                                                x-text="row[col]?.substring(0,2).toUpperCase()">
                                            </div>
                                            <span class="text-sm font-semibold" style="font-family:'Syne',sans-serif"
                                                x-text="row[col]"></span>
                                        </div>
                                    </template>

                                    {{-- cohort_number: badge verde --}}
                                    <template x-if="col === 'cohort_number'">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium
                                                     bg-emerald-500/12 text-emerald-400 border border-emerald-500/25">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            <span x-text="row[col]"></span>
                                        </span>
                                    </template>

                                    {{-- region_id / center_id: badge neutral --}}
                                    <template x-if="col === 'region_id' || col === 'center_id'">
                                        <span
                                            class="px-2 py-0.5 rounded-md text-xs bg-white/5 border border-white/10 text-slate-400"
                                            x-text="cell(col, row)"></span>
                                    </template>

                                    {{-- code: código monoespaciado --}}
                                    <template x-if="col === 'code'">
                                        <span
                                            class="text-xs font-mono text-slate-300 bg-slate-800/60 px-2 py-0.5 rounded-md border border-white/10"
                                            x-text="row[col]"></span>
                                    </template>

                                    {{-- program_name: texto normal --}}
                                    <template x-if="col === 'program_name'">
                                        <span class="text-sm text-slate-300" x-text="row[col]"></span>
                                    </template>

                                </td>
                            </template>

                            {{-- ACCIONES --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">

                                    <button @click="openModal('edit', row)"
                                        class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15
                                               flex items-center justify-center text-slate-400
                                               hover:bg-emerald-500/20 hover:text-emerald-400 transition-all cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </button>

                                    <button @click="confirmDelete(row.id)" class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15
                                               flex items-center justify-center text-slate-400
                                               hover:bg-red-500/20 hover:text-red-400 transition-all cursor-pointer">
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
                    </template>

                    {{-- Empty state --}}
                    <tr x-show="rows.length === 0">
                        <td :colspan="cols[tab].length + 1" class="px-5 py-10 text-center text-slate-500 text-sm">
                            Sin registros. Agrega el primero.
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>

    {{-- 🔹 MODAL CREAR / EDITAR --}}
    <div x-show="modal" x-transition.opacity.duration.200ms @click.away="modal=false; document.body.style.overflow=''"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>

        <div @click.stop
            class="bg-[#111D30] border border-[#00C853]/20 rounded-2xl w-[500px] max-w-[95vw] overflow-hidden shadow-2xl">

            {{-- Header --}}
            <div class="px-7 py-5 border-b border-[#00C853]/15 bg-[#00C853]/[.03] flex items-center justify-between">
                <h2 class="font-black text-lg" style="font-family:'Syne',sans-serif"
                    x-text="mode==='add' ? 'Nuevo registro' : 'Editar registro'"></h2>
                <button @click="modal=false; document.body.style.overflow=''"
                    class="text-slate-400 hover:text-white transition-colors text-lg leading-none">✕</button>
            </div>

            {{-- Body --}}
            <div class="px-7 py-6 grid grid-cols-2 gap-4">
                <template x-for="f in formFields" :key="f.key">
                    <div class="flex flex-col gap-1">
                        <label class="text-xs text-slate-400 uppercase tracking-widest" x-text="f.label"></label>
                        <input x-model="form[f.key]" :placeholder="f.label" class="bg-[#182236] border border-[#00C853]/20 rounded-[10px] px-3.5 py-2.5
                                   text-[#E8F4FF] text-sm outline-none focus:border-emerald-500/50 transition-colors">
                    </div>
                </template>
            </div>

            {{-- Footer --}}
            <div class="px-7 py-5 border-t border-[#00C853]/15 flex justify-end gap-3">
                <button @click="modal=false; document.body.style.overflow=''"
                    class="px-5 py-2.5 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all cursor-pointer">
                    Cancelar
                </button>
                <button @click="save()" class="px-5 py-2.5 rounded-xl text-sm bg-emerald-500 text-slate-900 font-semibold
                           hover:bg-emerald-400 shadow-lg shadow-emerald-500/25 transition-all cursor-pointer">
                    Guardar
                </button>
            </div>

        </div>
    </div>

    {{-- 🔹 MODAL ELIMINAR --}}
    <div x-show="deleteModal" x-transition
        @click.away="deleteModal=false; document.body.style.overflow=''; pendingDeleteId=null"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-cloak>

        <div @click.stop
            class="relative bg-[#1C2A40] border border-red-500/20 rounded-2xl p-6 w-full max-w-md shadow-2xl">

            <h2 class="text-lg font-bold text-red-400 mb-2" style="font-family:'Syne',sans-serif">
                Eliminar Registro
            </h2>
            <p class="text-sm text-slate-400 mb-6">
                ¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.
            </p>
            <div class="flex justify-end gap-2">
                <button @click="deleteModal=false; document.body.style.overflow=''; pendingDeleteId=null"
                    class="px-4 py-2 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all cursor-pointer">
                    Cancelar
                </button>
                <button @click="remove()"
                    class="px-4 py-2 rounded-xl text-sm bg-red-500 text-white hover:bg-red-600 transition-all cursor-pointer">
                    Sí, eliminar
                </button>
            </div>

        </div>
    </div>
    

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {

Alpine.data('appData', () => ({

    db: {
        regions: [{ id: 1, name: 'Caldas', code: 'CAL' }],
        centers: [],
        fichas: []
    },

    tab: 'regions',
    search: '',
    modal: false,
    deleteModal: false,
    mode: 'add',
    form: {},
    pendingDeleteId: null,

    nextId: { regions: 2, centers: 1, fichas: 1 },

    tabs: [
        { key: 'regions', label: 'Regiones' },
        { key: 'centers', label: 'Centros' },
        { key: 'fichas', label: 'Fichas' }
    ],

    cols: {
        regions: ['name', 'code'],
        centers: ['name', 'code', 'region_id'],
        fichas: ['cohort_number', 'program_name', 'center_id']
    },

    labels: {
        name: 'Nombre',
        code: 'Código',
        region_id: 'Región',
        center_id: 'Centro',
        cohort_number: 'fichas',
        program_name: 'Programa'
    },

    init() {},

    get rows() {
        const base = this.db[this.tab];
        if (!this.search.trim()) return base;
        const q = this.search.toLowerCase();
        return base.filter(r =>
            Object.values(r).some(v => String(v).toLowerCase().includes(q))
        );
    },

    cell(col, row) {
        if (col === 'region_id') {
            const r = this.db.regions.find(x => x.id === row[col]);
            return r ? r.name : row[col] ?? '-';
        }
        if (col === 'center_id') {
            const c = this.db.centers.find(x => x.id === row[col]);
            return c ? c.name : row[col] ?? '-';
        }
        return row[col] ?? '-';
    },

    get formFields() {
        return this.cols[this.tab].map(c => ({ key: c, label: this.labels[c] }));
    },

    openModal(mode, row = null) {
        this.mode = mode;
        this.form = row ? { ...row } : {};
        this.modal = true;
        document.body.style.overflow = 'hidden';
    },

    save() {
        if (this.mode === 'add') {
            this.form.id = this.nextId[this.tab]++;
            this.db[this.tab].push({ ...this.form });
        } else {
            const idx = this.db[this.tab].findIndex(r => r.id === this.form.id);
            if (idx !== -1) this.db[this.tab][idx] = { ...this.form };
        }
        this.modal = false;
        document.body.style.overflow = '';
    },

    confirmDelete(id) {
        this.pendingDeleteId = id;
        this.deleteModal = true;
        document.body.style.overflow = 'hidden';
    },

    remove() {
        this.db[this.tab] = this.db[this.tab].filter(r => r.id !== this.pendingDeleteId);
        this.pendingDeleteId = null;
        this.deleteModal = false;
        document.body.style.overflow = '';
    }

}))
})
</script>
@endpush