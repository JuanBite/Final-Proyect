{{--
Partial: _import_modals.blade.php
Incluir en gestion/index.blade.php y users/index.blade.php con:
@include('partials._import_modals')
--}}

@php $importer = auth()->user(); @endphp

{{-- ── Botón flotante Importar (solo roles con permiso) ─────────────────── --}}
@if(in_array($importer->role, ['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR']))

{{-- Botón que abre el modal correcto según la vista --}}
@isset($importContext)
@if($importContext === 'gestion')
<div class="fixed bottom-4 right-4 z-10" x-show="!importGestionModal">
    <button @click="importGestionModal = true"
        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium bg-sky-500/90 text-white shadow-lg shadow-sky-500/30 border border-sky-500/25 hover:bg-sky-400 transition-all cursor-pointer">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
            <polyline points="17 8 12 3 7 8" />
            <line x1="12" y1="3" x2="12" y2="15" />
        </svg>
        Importar
    </button>
</div>
@elseif($importContext === 'users')
<div class="fixed bottom-4 right-4 z-10" x-show="!importUsersModal">
    <button @click="importUsersModal = true"
        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium bg-sky-500/90 text-white shadow-lg shadow-sky-500/30 border border-sky-500/25 hover:bg-sky-400 transition-all cursor-pointer">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
            <polyline points="17 8 12 3 7 8" />
            <line x1="12" y1="3" x2="12" y2="15" />
        </svg>
        Importar usuarios
    </button>
</div>
@endif

@endisset

{{-- ══════════════════════════════════════════════════════════════════════════
MODAL IMPORTAR GESTIÓN
══════════════════════════════════════════════════════════════════════════ --}}
<div x-show="importGestionModal" x-transition.opacity.duration.200ms @click.away="importGestionModal = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
    <div @click.stop
        class="bg-[#111D30] border border-[#00C853]/20 rounded-2xl w-[480px] max-w-[95vw] overflow-hidden shadow-2xl">

        <div class="px-7 py-5 border-b border-[#00C853]/15 flex items-center justify-between">
            <div>
                <div class="font-black text-lg" style="font-family:'Syne',sans-serif">Importar Gestión</div>
                <div class="text-xs text-slate-400 mt-0.5">
                    @if($importer->role === 'ADMIN')
                    Regiones, centros y fichas desde Excel
                    @elseif($importer->role === 'REGIONAL_ADMIN')
                    Centros y fichas de tu regional desde Excel
                    @else
                    Fichas de tu centro desde Excel
                    @endif
                </div>
            </div>
            <button @click="importGestionModal = false"
                class="text-slate-400 hover:text-white transition-colors">✕</button>
        </div>

        {{-- Alertas --}}
        @if(session('success'))
        <div
            class="mx-7 mt-5 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/25 text-emerald-400 text-sm">
            {{ session('success') }}
        </div>
        @endif
        @if(session('warning'))
        <div
            class="mx-7 mt-5 px-4 py-3 rounded-xl bg-yellow-500/10 border border-yellow-500/25 text-yellow-400 text-sm">
            {{ session('warning') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mx-7 mt-5 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/25 text-red-400 text-sm">
            {{ session('error') }}
        </div>
        @endif
        @if(session('import_errors'))
        <div
            class="mx-7 mt-3 px-4 py-3 rounded-xl bg-yellow-500/10 border border-yellow-500/25 text-yellow-300 text-xs max-h-32 overflow-y-auto">
            <div class="font-semibold mb-1">Advertencias:</div>
            @foreach(session('import_errors') as $err)
            <div>• {{ $err }}</div>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('import.gestion') }}" enctype="multipart/form-data" class="px-7 py-6">
            @csrf

            {{-- Instrucciones según rol --}}
            <div class="bg-[#182236] border border-[#00C853]/15 rounded-xl p-4 mb-5 text-xs text-slate-400 space-y-1">
                <div class="font-semibold text-slate-300 mb-2">Estructura requerida del Excel:</div>

                @if($importer->role === 'ADMIN')
                <div>📄 Hoja <span class="text-emerald-400 font-mono">regiones</span>: <span class="font-mono">name,
                        code</span></div>
                <div>📄 Hoja <span class="text-emerald-400 font-mono">centros</span>: <span class="font-mono">name,
                        code, region_name</span></div>
                <div>📄 Hoja <span class="text-emerald-400 font-mono">fichas</span>: <span
                        class="font-mono">cohort_number, program_name, center_name, start_date, end_date</span></div>
                @elseif($importer->role === 'REGIONAL_ADMIN')
                <div class="text-sky-400">COORDINATOR</div>
                <div class="text-yellow-400/80 mt-1">⚠ Solo coordinadores de tu regional ({{ $importer->region->name ??
                    '' }})</div>
                @else
                <div>📄 Hoja <span class="text-emerald-400 font-mono">regiones</span>: <span
                        class="text-slate-500 italic">se ignora (sin permiso)</span></div>
                <div>📄 Hoja <span class="text-emerald-400 font-mono">centros</span>: <span
                        class="text-slate-500 italic">se ignora (sin permiso)</span></div>
                <div>📄 Hoja <span class="text-emerald-400 font-mono">fichas</span>: <span
                        class="font-mono">cohort_number, program_name, center_name, start_date, end_date</span> <span
                        class="text-yellow-400/80">(solo tu centro)</span></div>
                @endif
            </div>

            {{-- Input file --}}
            <label
                class="flex flex-col items-center justify-center gap-3 border-2 border-dashed border-[#00C853]/20 rounded-xl p-6 cursor-pointer hover:border-[#00C853]/40 transition-all bg-[#182236]/50"
                x-data="{ fileName: '' }">
                <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                    <polyline points="17 8 12 3 7 8" />
                    <line x1="12" y1="3" x2="12" y2="15" />
                </svg>
                <span class="text-sm text-slate-400"
                    x-text="fileName || 'Haz clic para seleccionar el archivo .xlsx'"></span>
                <input type="file" name="file" accept=".xlsx,.xls" class="hidden"
                    @change="fileName = $event.target.files[0]?.name ?? ''">
            </label>

            <div class="flex justify-end gap-2.5 mt-5">
                <button type="button" @click="importGestionModal = false"
                    class="px-5 py-2.5 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-5 py-2.5 rounded-xl text-sm bg-emerald-500 text-slate-900 font-semibold hover:bg-emerald-400 transition-all">
                    Importar
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════════════════
MODAL IMPORTAR USUARIOS
══════════════════════════════════════════════════════════════════════════ --}}
<div x-show="importUsersModal" x-transition.opacity.duration.200ms @click.away="importUsersModal = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" x-cloak>
    <div @click.stop
        class="bg-[#111D30] border border-[#00C853]/20 rounded-2xl w-[480px] max-w-[95vw] overflow-hidden shadow-2xl">

        <div class="px-7 py-5 border-b border-[#00C853]/15 flex items-center justify-between">
            <div>
                <div class="font-black text-lg" style="font-family:'Syne',sans-serif">Importar Usuarios</div>
                <div class="text-xs text-slate-400 mt-0.5">Carga masiva de usuarios desde Excel</div>
            </div>
            <button @click="importUsersModal = false"
                class="text-slate-400 hover:text-white transition-colors">✕</button>
        </div>

        {{-- Alertas --}}
        @if(session('success'))
        <div
            class="mx-7 mt-5 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/25 text-emerald-400 text-sm">
            {{ session('success') }}
        </div>
        @endif
        @if(session('warning'))
        <div
            class="mx-7 mt-5 px-4 py-3 rounded-xl bg-yellow-500/10 border border-yellow-500/25 text-yellow-400 text-sm">
            {{ session('warning') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mx-7 mt-5 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/25 text-red-400 text-sm">
            {{ session('error') }}
        </div>
        @endif
        @if(session('import_errors'))
        <div
            class="mx-7 mt-3 px-4 py-3 rounded-xl bg-yellow-500/10 border border-yellow-500/25 text-yellow-300 text-xs max-h-32 overflow-y-auto">
            <div class="font-semibold mb-1">Advertencias:</div>
            @foreach(session('import_errors') as $err)
            <div>• {{ $err }}</div>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('import.users') }}" enctype="multipart/form-data" class="px-7 py-6">
            @csrf

            {{-- Instrucciones según rol --}}
            <div class="bg-[#182236] border border-[#00C853]/15 rounded-xl p-4 mb-5 text-xs text-slate-400 space-y-1">
                <div class="font-semibold text-slate-300 mb-2">Estructura requerida del Excel:</div>
                <div>📄 Hoja <span class="text-emerald-400 font-mono">usuarios</span>:</div>
                <div class="font-mono pl-2">first_name, last_name, email, document,</div>
                <div class="font-mono pl-2">password, role, region_name, center_name, cohort_number</div>

                <div class="mt-2 pt-2 border-t border-white/5">
                    <div class="text-slate-300 font-semibold mb-1">Roles que puedes importar:</div>
                    @if($importer->role === 'ADMIN')
                    <div class="text-sky-400">ADMIN · REGIONAL_ADMIN · COORDINATOR · INSTRUCTOR · STUDENT</div>
                    @elseif($importer->role === 'REGIONAL_ADMIN')
                    <div class="text-sky-400">COORDINATOR · INSTRUCTOR · STUDENT</div>
                    <div class="text-yellow-400/80 mt-1">⚠ Solo usuarios de tu regional ({{ $importer->region->name ??
                        '' }})</div>
                    @else
                    <div class="text-sky-400">INSTRUCTOR · STUDENT</div>
                    <div class="text-yellow-400/80 mt-1">⚠ Solo usuarios de tu centro ({{ $importer->center->name ?? ''
                        }})</div>
                    @endif
                    <div class="text-yellow-400/80 mt-1">⚠ Si no se pone password se asigna <span
                            class="font-mono">12345678</span></div>
                </div>
            </div>

            {{-- Input file --}}
            <label
                class="flex flex-col items-center justify-center gap-3 border-2 border-dashed border-[#00C853]/20 rounded-xl p-6 cursor-pointer hover:border-[#00C853]/40 transition-all bg-[#182236]/50"
                x-data="{ fileName: '' }">
                <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                    <polyline points="17 8 12 3 7 8" />
                    <line x1="12" y1="3" x2="12" y2="15" />
                </svg>
                <span class="text-sm text-slate-400"
                    x-text="fileName || 'Haz clic para seleccionar el archivo .xlsx'"></span>
                <input type="file" name="file" accept=".xlsx,.xls" class="hidden"
                    @change="fileName = $event.target.files[0]?.name ?? ''">
            </label>

            <div class="flex justify-end gap-2.5 mt-5">
                <button type="button" @click="importUsersModal = false"
                    class="px-5 py-2.5 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-5 py-2.5 rounded-xl text-sm bg-emerald-500 text-slate-900 font-semibold hover:bg-emerald-400 transition-all">
                    Importar
                </button>
            </div>
        </form>
    </div>
</div>

@endif {{-- fin del @if en_array rol --}}