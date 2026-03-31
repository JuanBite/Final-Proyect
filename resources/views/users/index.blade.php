@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- STATS -->
<div class="grid grid-cols-4 gap-4">
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30 transition-all cursor-pointer">
        <div class="w-10 h-10 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" /></svg>
        </div>
        <div>
            <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif" id="stat-total">6</div>
            <div class="text-xs text-slate-400 mt-1">Usuarios totales</div>
        </div>
    </div>
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl h">
        <div class="w-10 h-10 rounded-xl bg-sky-400/15 text-sky-400 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5z" />
                <path d="M2 17l10 5 10-5" />
                <path d="M2 12l10 5 10-5" /></svg>
        </div>
        <div>
            <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif" id="stat-lideres">2</div>
            <div class="text-xs text-slate-400 mt-1">Líderes de proyecto</div>
        </div>
    </div>
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl h">
        <div class="w-10 h-10 rounded-xl bg-yellow-400/15 text-yellow-400 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" /></svg>
        </div>
        <div>
            <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif" id="stat-miembros">4</div>
            <div class="text-xs text-slate-400 mt-1">Miembros activos</div>
        </div>
    </div>
    <div class="bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl px-4 py-4 flex items-center gap-3 hover:-translate-y-0.5 hover:border-[#00C853]/35 hover:shadow-2xl h">
        <div class="w-10 h-10 rounded-xl bg-red-400/15 text-red-400 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" /></svg>
        </div>
        <div>
            <div class="font-black text-2xl leading-none" style="font-family:'Syne',sans-serif" id="stat-proyectos">5</div>
            <div class="text-xs text-slate-400 mt-1">Proyectos activos</div>
        </div>
    </div>
</div>

<!-- TABLE SECTION -->
<div>
    <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
        <h2 class="font-bold text-xl" style="font-family:'Syne',sans-serif">Gestión de <span class="text-emerald-400">Usuarios</span></h2>
        <div class="flex items-center gap-2 flex-wrap">
            <!-- Search -->
            <div class="flex items-center gap-2 bg-slate-700 border border-emerald-500/20 rounded-xl px-3 py-2 focus-within:border-emerald-500/50 transition-colors">
                <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" /></svg>
                <input type="text" placeholder="Buscar usuario..." id="searchInput" oninput="filterUsers()" class="bg-transparent border-none outline-none text-slate-100 text-sm placeholder-slate-500 w-44">
            </div>
            <!-- Filter chips -->
            <div class="flex gap-1.5">
                <button onclick="setFilter('todos', this)" class="chip-btn px-3 py-1.5 rounded-full text-xs font-medium border cursor-pointer transition-all bg-emerald-500/15 text-emerald-400 border-emerald-500/30">Todos</button>
                <button onclick="setFilter('Líder', this)" class="chip-btn px-3 py-1.5 rounded-full text-xs font-medium border cursor-pointer transition-all bg-slate-700 text-slate-400 border-emerald-500/15 hover:border-emerald-500/30 hover:text-slate-100">Líderes</button>
                <button onclick="setFilter('Miembro', this)" class="chip-btn px-3 py-1.5 rounded-full text-xs font-medium border cursor-pointer transition-all bg-slate-700 text-slate-400 border-emerald-500/15 hover:border-emerald-500/30 hover:text-slate-100">Miembros</button>
            </div>
            <!-- Add user -->
            <button onclick="openAddModal()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 hover:bg-emerald-400 hover:-translate-y-px transition-all shadow-lg shadow-emerald-500/25 cursor-pointer border-none">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" /></svg>
                Agregar usuario
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-slate-700 border border-emerald-500/20 rounded-2xl overflow-hidden">
        <table class="w-full border-collapse">
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
            <tbody class="card-hover bg-[#1C2A40] border border-[#00C853]/15 rounded-2xl overflow-hidden cursor-pointer hover:border-[#00C853]/35 hover:shadow-2xl hover:shadow-black/30" id="usersTableBody"></tbody>
        </table>
    </div>
</div>

</div>
</main>
</div>
<!-- ADD / EDIT MODAL -->
<div id="userModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-200">
    <div id="userModalBox" class="bg-slate-800 border border-emerald-500/20 rounded-2xl p-8 w-[480px] max-w-[95vw] relative translate-y-5 scale-[0.97] transition-all duration-200">
        <button onclick="closeModal('userModal')" class="absolute top-5 right-5 w-8 h-8 bg-slate-700 border border-emerald-500/20 rounded-lg flex items-center justify-center cursor-pointer text-slate-400 hover:text-red-400 hover:border-red-400/30 transition-all">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
        <h3 class="font-black text-xl mb-1" style="font-family:'Syne',sans-serif" id="modalTitle">Agregar <span class="text-emerald-400">Usuario</span></h3>
        <p class="text-sm text-slate-400 mb-6" id="modalSub">Completa los datos del nuevo usuario del sistema.</p>
        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col gap-1.5">
                <label class="text-xs uppercase tracking-widest text-slate-400">Nombre</label>
                <input id="f-nombre" type="text" placeholder="Ej: Luis Miguel" class="bg-slate-700 border border-emerald-500/20 rounded-xl px-3.5 py-2.5 text-sm text-slate-100 outline-none focus:border-emerald-500/50 transition-colors placeholder-slate-500">
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="text-xs uppercase tracking-widest text-slate-400">Apellido</label>
                <input id="f-apellido" type="text" placeholder="Ej: Muñoz" class="bg-slate-700 border border-emerald-500/20 rounded-xl px-3.5 py-2.5 text-sm text-slate-100 outline-none focus:border-emerald-500/50 transition-colors placeholder-slate-500">
            </div>
            <div class="flex flex-col gap-1.5 col-span-2">
                <label class="text-xs uppercase tracking-widest text-slate-400">Correo electrónico</label>
                <input id="f-email" type="email" placeholder="usuario@correo.com" class="bg-slate-700 border border-emerald-500/20 rounded-xl px-3.5 py-2.5 text-sm text-slate-100 outline-none focus:border-emerald-500/50 transition-colors placeholder-slate-500">
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="text-xs uppercase tracking-widest text-slate-400">Rol</label>
                <select id="f-rol" class="bg-slate-700 border border-emerald-500/20 rounded-xl px-3.5 py-2.5 text-sm text-slate-100 outline-none focus:border-emerald-500/50 transition-colors cursor-pointer">
                    <option value="Líder" style="background:#1e293b">Líder de Proyecto</option>
                    <option value="Miembro" style="background:#1e293b">Miembro</option>
                    <option value="Admin" style="background:#1e293b">Administrador</option>
                </select>
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="text-xs uppercase tracking-widest text-slate-400">Estado</label>
                <select id="f-estado" class="bg-slate-700 border border-emerald-500/20 rounded-xl px-3.5 py-2.5 text-sm text-slate-100 outline-none focus:border-emerald-500/50 transition-colors cursor-pointer">
                    <option value="Activo" style="background:#1e293b">Activo</option>
                    <option value="Inactivo" style="background:#1e293b">Inactivo</option>
                </select>
            </div>
            <div class="flex flex-col gap-1.5 col-span-2">
                <label class="text-xs uppercase tracking-widest text-slate-400">Proyectos asignados</label>
                <input id="f-proyectos" type="text" placeholder="Ej: Sigpro Académico, Parking Sigpro" class="bg-slate-700 border border-emerald-500/20 rounded-xl px-3.5 py-2.5 text-sm text-slate-100 outline-none focus:border-emerald-500/50 transition-colors placeholder-slate-500">
            </div>
        </div>
        <div class="flex justify-end gap-2.5 mt-6 pt-5 border-t border-emerald-500/15">
            <button onclick="closeModal('userModal')" class="px-4 py-2 rounded-xl text-sm font-medium bg-slate-700 text-slate-400 border border-emerald-500/20 hover:text-slate-100 hover:border-emerald-500/40 cursor-pointer transition-all">Cancelar</button>
            <button onclick="saveUser()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 hover:bg-emerald-400 cursor-pointer transition-all border-none">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12" /></svg>
                Guardar
            </button>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-200">
    <div id="deleteModalBox" class="bg-slate-800 border border-emerald-500/20 rounded-2xl p-8 w-[380px] max-w-[95vw] text-center translate-y-5 scale-[0.97] transition-all duration-200">
        <div class="w-14 h-14 bg-red-500/10 border border-red-500/25 rounded-2xl flex items-center justify-center mx-auto mb-4 text-red-400">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="3 6 5 6 21 6" />
                <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                <path d="M10 11v6M14 11v6" />
                <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2" /></svg>
        </div>
        <h3 class="font-black text-xl mb-2" style="font-family:'Syne',sans-serif">Eliminar usuario</h3>
        <p class="text-sm text-slate-400 leading-relaxed" id="delSubText">¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.</p>
        <div class="flex justify-center gap-2.5 mt-6 pt-5 border-t border-emerald-500/15">
            <button onclick="closeModal('deleteModal')" class="px-4 py-2 rounded-xl text-sm font-medium bg-slate-700 text-slate-400 border border-emerald-500/20 hover:text-slate-100 hover:border-emerald-500/40 cursor-pointer transition-all">Cancelar</button>
            <button onclick="confirmDelete()" class="px-4 py-2 rounded-xl text-sm font-medium bg-red-500/15 text-red-400 border border-red-500/30 hover:bg-red-500 hover:text-white cursor-pointer transition-all">Sí, eliminar</button>
        </div>
    </div>
</div>

<!-- TOAST -->
<div id="toast" class="fixed bottom-6 right-6 flex items-center gap-2.5 bg-slate-700 border border-emerald-500/30 rounded-xl px-4 py-3 text-sm shadow-2xl z-50 translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
    <span class="w-2 h-2 bg-emerald-400 rounded-full shrink-0"></span>
    <span id="toast-msg">Acción realizada</span>
</div>

<script>
    const avGradients = [
        'from-emerald-700 to-emerald-400'
        , 'from-sky-700 to-sky-400'
        , 'from-violet-700 to-violet-400'
        , 'from-orange-600 to-amber-400'
        , 'from-teal-700 to-teal-400'
        , 'from-red-700 to-red-400'
    , ];
    const avTextColors = ['text-slate-900', 'text-slate-900', 'text-white', 'text-white', 'text-white', 'text-white'];

    let users = [{
            id: 1
            , nombre: 'Luis Miguel'
            , apellido: 'Muñoz'
            , email: 'luis.munoz@sigpro.edu.co'
            , rol: 'Líder'
            , estado: 'Activo'
            , proyectos: ['Sigpro Académico', 'Portería Sigpro', 'Emprender']
            , ingreso: '12/02/2026'
            , av: 0
        }
        , {
            id: 2
            , nombre: 'Sebastián'
            , apellido: 'Grijalva'
            , email: 'sebastian.grijalva@sigpro.edu.co'
            , rol: 'Líder'
            , estado: 'Activo'
            , proyectos: ['Gimnasio', 'Parking Sigpro']
            , ingreso: '13/02/2026'
            , av: 1
        }
        , {
            id: 3
            , nombre: 'Juan David'
            , apellido: 'Quinchia'
            , email: 'jd.quinchia@sigpro.edu.co'
            , rol: 'Miembro'
            , estado: 'Activo'
            , proyectos: ['Sigpro Académico', 'Gimnasio', 'Parking Sigpro']
            , ingreso: '12/02/2026'
            , av: 2
        }
        , {
            id: 4
            , nombre: 'Sara'
            , apellido: 'Martínez'
            , email: 'sara.martinez@sigpro.edu.co'
            , rol: 'Miembro'
            , estado: 'Activo'
            , proyectos: ['Emprender']
            , ingreso: '14/02/2026'
            , av: 3
        }
        , {
            id: 5
            , nombre: 'Camilo'
            , apellido: 'Restrepo'
            , email: 'camilo.restrepo@sigpro.edu.co'
            , rol: 'Miembro'
            , estado: 'Inactivo'
            , proyectos: ['Portería Sigpro']
            , ingreso: '15/02/2026'
            , av: 4
        }
        , {
            id: 6
            , nombre: 'Daniela'
            , apellido: 'Ospina'
            , email: 'daniela.ospina@sigpro.edu.co'
            , rol: 'Miembro'
            , estado: 'Activo'
            , proyectos: ['Parking Sigpro', 'Sigpro Académico']
            , ingreso: '12/02/2026'
            , av: 5
        }
    , ];

    let editingId = null
        , deletingId = null
        , currentFilter = 'todos';

    function initials(u) {
        return (u.nombre[0] + u.apellido[0]).toUpperCase();
    }

    function roleBadge(rol) {
        if (rol === 'Líder') return `<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/12 text-emerald-400 border border-emerald-500/25"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Líder de Proyecto</span>`;
        if (rol === 'Admin') return `<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-yellow-400/12 text-yellow-400 border border-yellow-400/25"><span class="w-1.5 h-1.5 rounded-full bg-yellow-400"></span>Administrador</span>`;
        return `<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-sky-400/12 text-sky-400 border border-sky-400/25"><span class="w-1.5 h-1.5 rounded-full bg-sky-400"></span>Miembro</span>`;
    }

    function proyectosCell(proyectos, rol) {
        return proyectos.map((p, i) => {
            const isLead = i === 0 && rol === 'Líder';
            const cls = isLead ?
                'px-2 py-0.5 rounded-md text-xs bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 whitespace-nowrap' :
                'px-2 py-0.5 rounded-md text-xs bg-white/5 border border-white/10 text-slate-400 whitespace-nowrap hover:bg-emerald-500/8 hover:border-emerald-500/20 hover:text-slate-200 transition-all cursor-default';
            return `<span class="${cls}">${isLead?'★ ':''}${p}</span>`;
        }).join('');
    }

    function renderTable() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const tbody = document.getElementById('usersTableBody');
        const filtered = users.filter(u => {
            const matchFilter = currentFilter === 'todos' || u.rol === currentFilter;
            const matchSearch = `${u.nombre} ${u.apellido} ${u.email}`.toLowerCase().includes(search);
            return matchFilter && matchSearch;
        });

        if (filtered.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="py-12 text-center text-slate-500">
        <svg class="w-10 h-10 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
        <p class="text-sm">No se encontraron usuarios</p></td></tr>`;
            updateStats();
            return;
        }

        tbody.innerHTML = filtered.map(u => {
            const idx = u.av % avGradients.length;
            const grad = avGradients[idx];
            const txtC = avTextColors[idx];
            return `
      <tr class="border-b border-white/5 last:border-0 hover:bg-emerald-500/5 transition-colors">
        <td class="px-5 py-3.5">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br ${grad} flex items-center justify-center font-black text-sm shrink-0 ${txtC}" style="font-family:'Syne',sans-serif">${initials(u)}</div>
            <div>
              <div class="text-sm font-semibold" style="font-family:'Syne',sans-serif">${u.nombre} ${u.apellido}</div>
              <div class="text-xs text-slate-400 mt-0.5">${u.email}</div>
            </div>
          </div>
        </td>
        <td class="px-5 py-3.5">${roleBadge(u.rol)}</td>
        <td class="px-5 py-3.5"><div class="flex flex-wrap gap-1">${proyectosCell(u.proyectos, u.rol)}</div></td>
        <td class="px-5 py-3.5">
          <span class="inline-flex items-center gap-1.5 text-sm">
            <span class="w-2 h-2 rounded-full ${u.estado==='Activo' ? 'bg-emerald-400 shadow-[0_0_0_3px_rgba(52,211,153,0.2)]' : 'bg-slate-500'}"></span>
            ${u.estado}
          </span>
        </td>
        <td class="px-5 py-3.5 text-xs text-slate-400">${u.ingreso}</td>
        <td class="px-5 py-3.5">
          <div class="flex items-center justify-center gap-1.5">
            <button onclick="openEditModal(${u.id})" title="Editar"
              class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-emerald-500/15 hover:border-emerald-500/30 hover:text-emerald-400 cursor-pointer transition-all">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </button>
            <button onclick="openDeleteModal(${u.id})" title="Eliminar"
              class="w-8 h-8 rounded-lg bg-slate-600 border border-emerald-500/15 flex items-center justify-center text-slate-400 hover:bg-red-500/15 hover:border-red-500/30 hover:text-red-400 cursor-pointer transition-all">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
            </button>
          </div>
        </td>
      </tr>`;
        }).join('');

        updateStats();
    }

    function updateStats() {
        document.getElementById('stat-total').textContent = users.length;
        document.getElementById('stat-lideres').textContent = users.filter(u => u.rol === 'Líder').length;
        document.getElementById('stat-miembros').textContent = users.filter(u => u.rol === 'Miembro').length;
    }

    function setFilter(f, el) {
        currentFilter = f;
        document.querySelectorAll('.chip-btn').forEach(c => {
            c.className = 'chip-btn px-3 py-1.5 rounded-full text-xs font-medium border cursor-pointer transition-all bg-slate-700 text-slate-400 border-emerald-500/15 hover:border-emerald-500/30 hover:text-slate-100';
        });
        el.className = 'chip-btn px-3 py-1.5 rounded-full text-xs font-medium border cursor-pointer transition-all bg-emerald-500/15 text-emerald-400 border-emerald-500/30';
        renderTable();
    }

    function filterUsers() {
        renderTable();
    }

    function openModal(id) {
        const overlay = document.getElementById(id);
        const box = document.getElementById(id + 'Box');
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100');
        box.classList.remove('translate-y-5', 'scale-[0.97]');
        box.classList.add('translate-y-0', 'scale-100');
    }

    function closeModal(id) {
        const overlay = document.getElementById(id);
        const box = document.getElementById(id + 'Box');
        overlay.classList.add('opacity-0', 'pointer-events-none');
        overlay.classList.remove('opacity-100');
        box.classList.add('translate-y-5', 'scale-[0.97]');
        box.classList.remove('translate-y-0', 'scale-100');
    }

    function openAddModal() {
        editingId = null;
        document.getElementById('modalTitle').innerHTML = 'Agregar <span class="text-emerald-400">Usuario</span>';
        document.getElementById('modalSub').textContent = 'Completa los datos del nuevo usuario del sistema.';
        ['f-nombre', 'f-apellido', 'f-email', 'f-proyectos'].forEach(id => document.getElementById(id).value = '');
        document.getElementById('f-rol').value = 'Miembro';
        document.getElementById('f-estado').value = 'Activo';
        openModal('userModal');
    }

    function openEditModal(id) {
        const u = users.find(x => x.id === id);
        if (!u) return;
        editingId = id;
        document.getElementById('modalTitle').innerHTML = 'Editar <span class="text-emerald-400">Usuario</span>';
        document.getElementById('modalSub').textContent = 'Modifica los datos del usuario seleccionado.';
        document.getElementById('f-nombre').value = u.nombre;
        document.getElementById('f-apellido').value = u.apellido;
        document.getElementById('f-email').value = u.email;
        document.getElementById('f-rol').value = u.rol;
        document.getElementById('f-estado').value = u.estado;
        document.getElementById('f-proyectos').value = u.proyectos.join(', ');
        openModal('userModal');
    }

    function saveUser() {
        const nombre = document.getElementById('f-nombre').value.trim();
        const apellido = document.getElementById('f-apellido').value.trim();
        const email = document.getElementById('f-email').value.trim();
        const rol = document.getElementById('f-rol').value;
        const estado = document.getElementById('f-estado').value;
        const proyectos = document.getElementById('f-proyectos').value.split(',').map(p => p.trim()).filter(Boolean);

        if (!nombre || !apellido || !email) {
            showToast('⚠ Completa los campos requeridos');
            return;
        }

        if (editingId) {
            Object.assign(users.find(x => x.id === editingId), {
                nombre
                , apellido
                , email
                , rol
                , estado
                , proyectos
            });
            showToast('✓ Usuario actualizado correctamente');
        } else {
            const newId = Math.max(...users.map(u => u.id)) + 1;
            users.push({
                id: newId
                , nombre
                , apellido
                , email
                , rol
                , estado
                , proyectos
                , ingreso: new Date().toLocaleDateString('es-CO')
                , av: newId
            });
            showToast('✓ Usuario agregado correctamente');
        }
        closeModal('userModal');
        renderTable();
    }

    function openDeleteModal(id) {
        deletingId = id;
        const u = users.find(x => x.id === id);
        document.getElementById('delSubText').textContent =
            `¿Estás seguro de que deseas eliminar a ${u.nombre} ${u.apellido}? Esta acción no se puede deshacer.`;
        openModal('deleteModal');
    }

    function confirmDelete() {
        users = users.filter(u => u.id !== deletingId);
        closeModal('deleteModal');
        renderTable();
        showToast('Usuario eliminado');
    }

    function showToast(msg) {
        const t = document.getElementById('toast');
        document.getElementById('toast-msg').textContent = msg;
        t.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
        t.classList.add('translate-y-0', 'opacity-100');
        setTimeout(() => {
            t.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
            t.classList.remove('translate-y-0', 'opacity-100');
        }, 2800);
    }

    document.querySelectorAll('#userModal,#deleteModal').forEach(overlay => {
        overlay.addEventListener('click', e => {
            if (e.target === overlay) overlay.id === 'userModal' ? closeModal('userModal') : closeModal('deleteModal');
        });
    });

    renderTable();

</script>
@endsection
