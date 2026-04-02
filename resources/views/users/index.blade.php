@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div x-data="{ createModalOpen: false, editModalOpen: false, deleteModalOpen: false, currentUserId: null }" x-init="
        window.createModalOpen = () => { createModalOpen = false };
        window.editModalOpen = () => { editModalOpen = false };
        window.deleteModalOpen = () => { deleteModalOpen = false };
     ">
    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif">6</div>
                <div class="text-xs text-slate-400 mt-1">Usuarios totales</div>
            </div>
        </div>
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-sky-400/15 text-sky-400 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                    <path d="M2 17l10 5 10-5" />
                    <path d="M2 12l10 5 10-5" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif">2</div>
                <div class="text-xs text-slate-400 mt-1">Líderes de proyecto</div>
            </div>
        </div>
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-yellow-400/15 text-yellow-400 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </div>
            <div>
                <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif">4</div>
                <div class="text-xs text-slate-400 mt-1">Miembros activos</div>
            </div>
        </div>
        <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl transition-all cursor-default">
            <div class="w-10 h-10 rounded-xl bg-red-400/15 text-red-400 flex items-center justify-center shrink-0">
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

    <!-- TABLE SECTION -->
    <div x-data="userManager()" x-init="init()">
        <div class=" flex items-center justify-between mb-4 flex-wrap gap-3">
            <h2 class="font-bold text-xl" style="font-family:'Syne',sans-serif">Gestión de <span class="text-emerald-400">Usuarios</span></h2>
            <div class="flex items-center gap-2 flex-wrap">
                <!-- Barra de búsqueda -->
                <div class="flex items-center gap-2 bg-slate-700 border border-emerald-500/20 rounded-xl px-3 py-2 opacity-70">
                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" />
                    </svg>
                    <input type="text" placeholder="Busqueda" class="border-none outline-none text-slate-400 text-sm placeholder-slate-500 w-44">
                </div>
                <!-- Filtros decorativos -->
                <div class="flex gap-1.5">
                    <span class="px-3 py-1.5 rounded-full text-xs font-medium border bg-emerald-500/15 text-emerald-400 border-emerald-500/30 cursor-default">Todos</span>
                    <span class="px-3 py-1.5 rounded-full text-xs font-medium border bg-slate-700 text-slate-400 border-emerald-500/15 cursor-default">Líderes</span>
                    <span class="px-3 py-1.5 rounded-full text-xs font-medium border bg-slate-700 text-slate-400 border-emerald-500/15 cursor-default">Miembros</span>
                </div>
                <!-- Botón agregar con Alpine.js -->
                <button @click="createModalOpen = true; document.body.style.overflow='hidden'" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 shadow-lg shadow-emerald-500/25 border-none hover:bg-emerald-400 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Agregar usuario
                </button>
            </div>
        </div>

        <!-- Tabla -->
        <div class="bg-[#1C2A40] border border-emerald-500/20 rounded-2xl overflow-hidden overflow-x-auto">
            <table class="w-full border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-emerald-500/5 border-b border-emerald-500/15">
                        <th class="text-left px-5 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium">Usuario</th>
                        <th class="text-left px-5 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium">Rol</th>
                        <th class="text-left px-5 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium">Proyectos asignados</th>
                        <th class="text-left px-5 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium">Estado</th>
                        <th class="text-left px-5 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium">Ingreso</th>
                        <th class="text-center px-5 py-3.5 text-xs uppercase tracking-widest text-slate-400 font-medium">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Usuario 1 - Luis Miguel Muñoz (Líder) -->
                    <tr class="border-b border-white/5 last:border-0 hover:bg-emerald-500/5 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-700 to-emerald-400 flex items-center justify-center font-black text-sm shrink-0 text-slate-900" style="font-family:'Syne',sans-serif">LM</div>
                                <div>
                                    <div class="text-sm font-semibold" style="font-family:'Syne',sans-serif">Luis Miguel Muñoz</div>
                                    <div class="text-xs text-slate-400 mt-0.5">luis.munoz@sigpro.edu.co</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/12 text-emerald-400 border border-emerald-500/25">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Líder de Proyecto
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex flex-wrap gap-1">
                                <span class="px-2 py-0.5 rounded-md text-xs bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 whitespace-nowrap">★ Sigpro Académico</span>
                                <span class="px-2 py-0.5 rounded-md text-xs bg-white/5 border border-white/10 text-slate-400 whitespace-nowrap">Portería Sigpro</span>
                                <span class="px-2 py-0.5 rounded-md text-xs bg-white/5 border border-white/10 text-slate-400 whitespace-nowrap">Emprender</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1.5 text-sm">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_0_3px_rgba(52,211,153,0.2)]"></span>
                                Activo
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-xs text-slate-400">12/02/2026</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-1.5">
                                <button @click="editModalOpen = true; currentUserId = 1; document.body.style.overflow='hidden'" class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-emerald-500/20 hover:text-emerald-400 transition-all cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </button>
                                <button @click="deleteModalOpen = true; currentUserId = 1; document.body.style.overflow='hidden'" class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-red-500/20 hover:text-red-400 transition-all cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                                        <path d="M10 11v6M14 11v6" />
                                        <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal de creación de usuario -->
        <div x-show="createModalOpen" @close-create-modal.window="createModalOpen=false" x-transition.opacity.duration.200ms class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" @click.away="createModalOpen=false; document.body.style.overflow=''" x-cloak>
            <div @click.stop>
                @include('modals.create.user')
            </div>
        </div>

        <!-- Modal de edición de usuario -->
        <div x-show="editModalOpen" @close-edit-modal.window="editModalOpen=false; currentUserId=null" x-transition.opacity.duration.200ms class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" @click.away="editModalOpen=false; document.body.style.overflow=''; currentUserId=null" x-cloak>
            <div @click.stop>
                @include('modals.edit.user')
            </div>
        </div>

        <!-- MODAL ELIMINAR -->
        <div x-show="deleteModalOpen" x-transition @click.away="deleteModalOpen=false; document.body.style.overflow=''; currentUserId=null" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center" x-cloak>
            <div @click.stop class="relative bg-[#1C2A40] border border-red-500/20 rounded-2xl p-6 w-full max-w-md shadow-2xl" x-transition.scale.origin.center>
                <h2 class="text-lg font-bold text-red-400 mb-2">
                    Eliminar Usuario
                </h2>
                <p class="text-sm text-slate-400 mb-6">
                    ¿Estás seguro de que deseas eliminar este Usuario? Esta acción no se puede deshacer.
                </p>
                <div class="flex justify-end gap-2">
                    <button @click="deleteModalOpen=false; document.body.style.overflow=''; currentUserId=null" class="px-4 py-2 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-sm bg-red-500 text-white hover:bg-red-600 transition-all">
                        Sí, eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
