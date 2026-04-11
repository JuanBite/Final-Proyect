@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@section('breadcrumbs')
<span class="text-[#00C853]/30">›</span>
<span class="font-syne font-bold text-sm text-[#E8F4FF]">Perfil</span>
@endsection

<div x-data="{ editModalOpen: false, currentUserId: null }" x-init="window.editModalOpen = () => { editModalOpen = false };" class="flex flex-col gap-6">
    <!-- HERO CARD -->
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 transition-all relative">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-500 to-sky-400 rounded-t-2xl"></div>

        <!-- Body -->
        <div class="px-8 pb-7 flex items-end gap-6 -mt-9 relative z-10">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-700 to-emerald-400 border-4 border-[#1C2A40] flex items-center justify-center font-black text-3xl text-slate-900 shrink-0 shadow-xl shadow-emerald-500/20"
                style="font-family:'Syne',sans-serif">{{ strtoupper(substr($user->first_name,0,1)) }}{{
                strtoupper(substr($user->last_name,0,1)) }}</div>
            <div class="flex-1 pt-11">
                <h1 class="font-black text-3xl leading-tight" style="font-family:'Syne',sans-serif">{{
                    Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h1>
                <p class="text-sm text-slate-400 mt-1">{{ Auth::user()->email }}</p>
                <div class="flex gap-2 mt-2.5 flex-wrap items-center">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium
                         {{ $user->status 
                          ? 'bg-emerald-500/12 text-emerald-400 border border-emerald-500/25' 
                         : 'bg-red-500/12 text-red-400 border border-red-500/25' }}">
                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        {{ $user->status ? 'Activo' : 'Inactivo' }}
                    </span>
                    <span @if($user->role === 'ADMIN')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-yellow-500/12 text-yellow-400 border border-yellow-500/25">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            Admin
                        </span>
                        @elseif($user->role === 'INSTRUCTOR')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/12 text-emerald-400 border border-emerald-500/25">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                <path d="M2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                            Instructor
                        </span>
                        @else
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-sky-400/12 text-sky-400 border border-sky-400/25">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                            </svg>
                            Estudiante
                        </span>
                        @endif
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-sky-400/12 text-sky-400 border border-sky-400/25">
                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                        {{ Auth::user()->created_at}}
                    </span>
                </div>
            </div>
            <div class="flex gap-2 pt-12 shrink-0">
                <button<button @click="editModalOpen = true; currentUserId = 1; document.body.style.overflow='hidden'"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-[#182236] text-slate-400 border border-[#00C853]/20 hover:text-slate-100 hover:border-[#00C853]/40 cursor-pointer transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                    Editar perfil
                    </button>
            </div>
        </div>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-4 gap-4">
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-5 py-4 relative overflow-hidden hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-lg hover:shadow-black/30 transition-all">
            <div class="absolute top-0 left-0 right-0 h-0.5 bg-emerald-500 rounded-t-2xl"></div>
            <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" />
                </svg>
            </div>
            <div class="font-black text-3xl leading-none" style="font-family:'Syne',sans-serif">{{
                $assignedProjects->count() }}</div>
            <div class="text-xs text-slate-400 mt-1 uppercase tracking-wider">Proyectos asignados</div>
        </div>

        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-5 py-4 relative overflow-hidden hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-lg hover:shadow-black/30 transition-all">
            <div class="absolute top-0 left-0 right-0 h-0.5 bg-yellow-400 rounded-t-2xl"></div>
            <div class="w-9 h-9 rounded-xl bg-yellow-400/10 text-yellow-400 flex items-center justify-center mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                    <path d="M2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
            </div>
            <div class="font-black text-3xl leading-none" style="font-family:'Syne',sans-serif">{{ $ledProjects->count()
                }}</div>
            <div class="text-xs text-slate-400 mt-1 uppercase tracking-wider">Proyectos liderados</div>
        </div>

        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-5 py-4 relative overflow-hidden hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-lg hover:shadow-black/30 transition-all">
            <div class="absolute top-0 left-0 right-0 h-0.5 bg-sky-400 rounded-t-2xl"></div>
            <div class="w-9 h-9 rounded-xl bg-sky-400/10 text-sky-400 flex items-center justify-center mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                </svg>
            </div>
            <div class="font-black text-3xl leading-none" style="font-family:'Syne',sans-serif">{{ $teammates->count()
                }}</div>
            <div class="text-xs text-slate-400 mt-1 uppercase tracking-wider">Compañeros de equipo</div>
        </div>

        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-5 py-4 relative overflow-hidden hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-lg hover:shadow-black/30 transition-all">
            <div class="absolute top-0 left-0 right-0 h-0.5 bg-emerald-500 rounded-t-2xl"></div>
            <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                </svg>
            </div>
            <div class="font-black text-3xl leading-none" style="font-family:'Syne',sans-serif">
                {{ $assignedProjects->avg('progress') > 0 ? number_format($assignedProjects->avg('progress'), 0) : 0 }}
                <span class="text-base font-semibold text-slate-400">%</span>
            </div>
            <div class="text-xs text-slate-400 mt-1 uppercase tracking-wider">Avance promedio</div>
        </div>
    </div>

    <!-- MAIN GRID -->
    <div class="grid gap-5" style="grid-template-columns:340px 1fr">

        <!-- LEFT COL -->
        <div class="flex flex-col gap-5">

            <!-- Datos personales -->
            <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/25 transition-all">
                <div class="px-5 py-4 border-b border-[#00C853]/10 bg-[#111D30]/60 flex items-center gap-2">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400"
                        style="font-family:'Syne',sans-serif">Datos <span class="text-emerald-400">Personales</span>
                    </h3>
                </div>
                <div class="p-5 flex flex-col">

                    <div class="flex items-start gap-3.5 py-3 border-b border-[#2b2b2b]">
                        <div class="w-8 h-8 rounded-lg bg-[#182236] border border-[#00C853]/15 flex items-center justify-center text-slate-400 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-widest text-slate-500">Nombre completo</p>
                            <p class="text-sm font-medium mt-0.5">{{ Auth::user()->first_name . ' ' .
                                Auth::user()->last_name }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5 py-3 border-b border-[#2b2b2b]">
                        <div class="w-8 h-8 rounded-lg bg-[#182236] border border-[#00C853]/15 flex items-center justify-center text-slate-400 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-widest text-slate-500">Correo electrónico</p>
                            <p class="text-sm font-medium mt-0.5">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5 py-3 border-b border-[#2b2b2b]">
                        <div class="w-8 h-8 rounded-lg bg-[#182236] border border-[#00C853]/15 flex items-center justify-center text-slate-400 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-widest text-slate-500">Fecha de ingreso</p>
                            <p class="text-sm font-medium mt-0.5">{{ Auth::user()->created_at}}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5 py-3 border-b border-[#2b2b2b]">
                        <div class="w-8 h-8 rounded-lg bg-[#182236] border border-[#00C853]/15 flex items-center justify-center text-slate-400 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-widest text-slate-500">Documento</p>
                            <p class="text-sm font-medium mt-0.5">{{ Auth::user()->document}}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5 pt-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-[#182236] border border-[#00C853]/15 flex items-center justify-center text-slate-400 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-widest text-slate-500">Estado de la cuenta</p>
                            <span
                                class="inline-flex items-center gap-1.5 mt-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/12 text-emerald-400 border border-emerald-500/25">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                {{ auth()->user()->status ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Rol y permisos -->
            <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden hover:border-[#00C853]/25 transition-all">
                <div class="px-5 py-4 border-b border-[#00C853]/10 bg-[#111D30]/60">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400"
                        style="font-family:'Syne',sans-serif">Rol y <span class="text-emerald-400">Permisos</span></h3>
                </div>
                <div class="p-5">
                    <!-- Role box -->
                    @if($user->role === 'ADMIN')
                    <div class="bg-yellow-500/8 border border-yellow-500/20 rounded-xl p-4 flex items-center gap-3.5 mb-4">
                        <div
                            class="w-11 h-11 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center text-yellow-400 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M6 20v-2a4 4 0 018 0v2" />
                                <path d="M18 8l2 2-4 4" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-yellow-400" style="font-family:'Syne',sans-serif">Administrador</p>
                            <p class="text-xs text-slate-400 mt-0.5">Acceso total al sistema</p>
                        </div>
                    </div>
                    @elseif($user->role === 'INSTRUCTOR')
                    <div class="bg-emerald-500/8 border border-emerald-500/20 rounded-xl p-4 flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M6 20v-2a4 4 0 018 0v2" />
                                <path d="M18 8l2 2-4 4" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-emerald-400" style="font-family:'Syne',sans-serif">Instructor</p>
                            <p class="text-xs text-slate-400 mt-0.5">Gestión completa de proyectos asignados</p>
                        </div>
                    </div>
                    @else
                    <div class="bg-sky-400/8 border border-sky-400/20 rounded-xl p-4 flex items-center gap-3.5 mb-4">
                        <div class="w-11 h-11 rounded-xl bg-sky-400/10 border border-sky-400/20 flex items-center justify-center text-sky-400 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M6 20v-2a4 4 0 018 0v2" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-sky-400" style="font-family:'Syne',sans-serif">Estudiante</p>
                            <p class="text-xs text-slate-400 mt-0.5">Participación en proyectos asignados</p>
                        </div>
                    </div>
                    @endif

                    <!-- Permisos -->
                    @php
                    $can = [
                    'Crear y editar proyectos' => in_array($user->role, ['ADMIN', 'INSTRUCTOR']),
                    'Asignar miembros al equipo' => in_array($user->role, ['ADMIN', 'INSTRUCTOR']),
                    'Actualizar avance del Gantt'=> in_array($user->role, ['ADMIN', 'INSTRUCTOR', 'STUDENT']),
                    'Administrar usuarios' => $user->role === 'ADMIN',
                    ];
                    @endphp

                    <div class="flex flex-col gap-2.5">
                        @foreach($can as $permiso => $tiene)
                        <div class="flex items-center gap-2.5 text-sm {{ $tiene ? '' : 'text-slate-500' }}">
                            <div class="w-5 h-5 rounded-md flex items-center justify-center shrink-0
                    {{ $tiene
                        ? 'bg-emerald-500/10 border border-emerald-500/20'
                        : 'bg-[#182236] border border-[#2b2b2b]' }}">
                                @if($tiene)
                                <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                                @else
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                                @endif
                            </div>
                            {{ $permiso }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COL -->
        <div class="max-h-[720px] overflow-y-auto pr-2
    [&::-webkit-scrollbar]:w-1.5
    [&::-webkit-scrollbar-track]:bg-transparent
    [&::-webkit-scrollbar-thumb]:bg-white/10
    [&::-webkit-scrollbar-thumb]:rounded-full">

            <div class="flex flex-col gap-5">

                <!-- Proyectos asignados -->
                @foreach($assignedProjects as $project)
                @php
                $role = $project->pivot->project_role;
                $isLeader = $role === 'LEADER';
                @endphp
                <div class="bg-[#182236] border border-[#00C853]/15 rounded-xl hover:border-[#00C853]/30 hover:bg-emerald-500/5 transition-all overflow-hidden">

                    {{-- Cabecera del proyecto --}}
                    <div class="flex items-center gap-3.5 px-4 py-3.5">
                        <div class="w-1 h-10 rounded shrink-0 {{ $isLeader ? 'bg-emerald-400' : 'bg-sky-400' }}"></div>
                        <div class="flex-1">
                            <p class="font-bold text-sm" style="font-family:'Syne',sans-serif">{{ $project->name }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $project->description ?? 'Sin descripción' }}
                            </p>
                        </div>
                        <div class="flex flex-col items-end gap-1.5">
                            <span class="px-2 py-0.5 rounded-md text-xs font-semibold uppercase tracking-wide
                        {{ $isLeader
                            ? 'bg-emerald-500/12 text-emerald-400 border border-emerald-500/20'
                            : 'bg-sky-400/12 text-sky-400 border border-sky-400/20' }}">
                                {{ $isLeader ? 'Líder' : 'Miembro' }}
                            </span>
                            <span class="font-black text-sm {{ $isLeader ? 'text-emerald-400' : 'text-sky-400' }}"
                                style="font-family:'Syne',sans-serif">
                                {{ number_format($project->progress, 0) }}%
                            </span>
                            <div class="w-20 h-1 bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full rounded-full {{ $isLeader ? 'bg-emerald-400' : 'bg-sky-400' }}"
                                    style="width:{{ $project->progress }}%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Miembros del proyecto --}}
                    @if($project->members->count() > 0)
                    <div class="border-t border-white/5 px-4 py-3">
                        <div class="flex flex-wrap gap-2 max-h-24 overflow-y-auto pr-1
                    [&::-webkit-scrollbar]:w-1
                    [&::-webkit-scrollbar-track]:bg-transparent
                    [&::-webkit-scrollbar-thumb]:bg-white/10
                    [&::-webkit-scrollbar-thumb]:rounded-full">
                            @foreach($project->members as $member)
                            @php $mIsLeader = $member->pivot->project_role === 'LEADER'; @endphp
                            <div class="flex items-center gap-2 bg-[#1C2A40] border border-white/5 rounded-lg px-2.5 py-1.5">
                                <div class="w-6 h-6 rounded-md bg-gradient-to-br {{ $mIsLeader ? 'from-emerald-700 to-emerald-400' : 'from-sky-700 to-sky-400' }} flex items-center justify-center font-black text-[10px] text-white shrink-0"
                                    style="font-family:'Syne',sans-serif">
                                    {{ strtoupper(substr($member->first_name,0,1)) }}{{
                                    strtoupper(substr($member->last_name,0,1)) }}
                                </div>
                                <span class="text-xs text-slate-300">{{ $member->first_name }} {{ $member->last_name
                                    }}</span>
                                @if($mIsLeader)
                                <span class="text-[10px] text-emerald-400 font-semibold">Líder</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach

                <!-- Modal -->
                <div x-show="editModalOpen" @close-edit-modal.window="editModalOpen=false; currentUserId=null"
                    x-transition.opacity.duration.200ms
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
                    @click.away="editModalOpen=false; document.body.style.overflow=''; currentUserId=null" x-cloak>
                    <div @click.stop>
                        @include('modals.edit.user')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection