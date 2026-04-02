@extends('layouts.app')

@section('title', 'Gestión')

@section('content')

<div x-data="appData()">

    {{-- STATS --}}
    <div class="grid grid-cols-4 gap-4">
        <div class="bg-[#1C2A40] p-5 rounded-2xl">
            <p class="text-2xl font-bold" x-text="db.regions.length"></p>
            <p>Regiones</p>
        </div>
        <div class="bg-[#1C2A40] p-5 rounded-2xl">
            <p class="text-2xl font-bold" x-text="db.centers.length"></p>
            <p>Centros</p>
        </div>
        <div class="bg-[#1C2A40] p-5 rounded-2xl">
            <p class="text-2xl font-bold" x-text="db.cohorts.length"></p>
            <p>Cohortes</p>
        </div>
        <div class="bg-[#1C2A40] p-5 rounded-2xl">
            <p class="text-2xl font-bold">5</p>
            <p>Proyectos activos</p>
        </div>
    </div>

    {{-- TABLA --}}
    <div class="bg-[#1C2A40] rounded-2xl mt-6 p-4">

        {{-- TABS --}}
        <div class="flex gap-2 mb-4">
            <button @click="tab='regions'" :class="tab==='regions' && 'text-green-400'">Regiones</button>
            <button @click="tab='centers'" :class="tab==='centers' && 'text-green-400'">Centros</button>
            <button @click="tab='cohorts'" :class="tab==='cohorts' && 'text-green-400'">Cohortes</button>
        </div>

        {{-- BUSCADOR --}}
        <input x-model="search" placeholder="Buscar..." class="mb-4 p-2 rounded bg-[#111] w-full">

        {{-- TABLA --}}
        <table class="w-full">
            <thead>
                <tr>
                    <template x-for="col in cols[tab]" :key="col">
                        <th class="text-left" x-text="colLabels[col]"></th>
                    </template>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <template x-for="row in rows" :key="row.id">
                    <tr>
                        <template x-for="col in cols[tab]" :key="col">
                            <td x-text="cellValue(col, row)"></td>
                        </template>

                        <td>
                            <button @click="edit(row)">✏️</button>
                            <button @click="remove(row.id)">🗑️</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

    </div>

</div>

@endsection


@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('appData', () => ({

        // 🔹 BASE DE DATOS MOCK
        db: {
            regions: [
                { id: 1, name: 'Caldas', code: 'CAL' },
                { id: 2, name: 'Antioquia', code: 'ANT' },
            ],
            centers: [
                { id: 1, name: 'Centro A', code: 'A1', region_id: 1 },
            ],
            cohorts: [
                { id: 1, cohort_number: '123', program_name: 'ADSO', center_id: 1 },
            ],
        },

        tab: 'regions',
        search: '',

        nextId: {
            regions: 3,
            centers: 2,
            cohorts: 2
        },

        // 🔹 COLUMNAS
        cols: {
            regions: ['name', 'code'],
            centers: ['name', 'code', 'region_id'],
            cohorts: ['cohort_number', 'program_name', 'center_id'],
        },

        colLabels: {
            name: 'Nombre',
            code: 'Código',
            region_id: 'Región',
            center_id: 'Centro',
            cohort_number: 'Cohorte',
            program_name: 'Programa'
        },

        // 🔹 FILTRADO
        get rows() {
            return this.db[this.tab].filter(r =>
                Object.values(r).some(v =>
                    String(v).toLowerCase().includes(this.search.toLowerCase())
                )
            );
        },

        // 🔹 RELACIONES
        regionName(id) {
            return this.db.regions.find(r => r.id == id)?.name || '-';
        },

        centerName(id) {
            return this.db.centers.find(c => c.id == id)?.name || '-';
        },

        cellValue(col, row) {
            if (col === 'region_id') return this.regionName(row[col]);
            if (col === 'center_id') return this.centerName(row[col]);
            return row[col];
        },

        // 🔹 ACCIONES
        edit(row) {
            alert('Editar ' + row.id);
        },

        remove(id) {
            this.db[this.tab] = this.db[this.tab].filter(r => r.id !== id);
        },

    }))
})
</script>
@endpush