<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Proyectos - SIGPRO</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#07121c] min-h-screen text-white font-sans">

    {{-- Header --}}
    <header class="border-b border-white/5 px-8 py-5 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-green-500 flex items-center justify-center">
                <img src="{{ asset('images/logo-sena.png') }}" alt="Logo SENA">
            </div>
            <span class="text-base font-semibold tracking-widest text-gray-200">SIGPRO</span>
        </div>
        <a href="{{ route('login') }}"
            class="flex items-center gap-2 text-xs text-gray-400 hover:text-green-400 border border-white/10 hover:border-green-500/40 px-4 py-2 rounded-lg transition-all">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
            </svg>
            Volver al login
        </a>
    </header>

    {{-- Hero --}}
    <div class="px-8 pt-12 pb-6 max-w-5xl mx-auto">
        <span
            class="text-xs px-4 py-1 rounded-full border border-green-500 text-green-400 inline-flex items-center gap-1 mb-4">
            <span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span> PROYECTOS ACTIVOS
        </span>
        <h1 class="text-4xl font-extrabold leading-tight">
            Proyectos de <span class="text-green-400">Grado</span>
        </h1>
        <p class="text-gray-400 text-sm mt-3">
            Explora los proyectos registrados en el sistema.
        </p>

        {{-- Buscador --}}
        <div
            class="mt-6 flex items-center gap-2 bg-[#0d1f2d] border border-white/10 rounded-xl px-4 py-3 max-w-md mx-auto">
            <svg class="w-4 h-4 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8" stroke-width="2" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35" />
            </svg>
            <input type="text" id="search-input" placeholder="Buscar proyecto por nombre..."
                class="bg-transparent border-transparent outline-none text-sm text-gray-200 placeholder-gray-600 w-full">
            <button id="clear-btn" onclick="clearSearch()" class="text-gray-500 hover:text-white transition hidden">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Proyectos --}}
    <main class="px-8 pb-16 max-w-5xl mx-auto">

        @if($projects->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 gap-4 text-center">
            <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/8 flex items-center justify-center">
                <svg class="w-7 h-7 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7" />
                </svg>
            </div>
            <p class="text-sm font-bold text-slate-300">No hay proyectos registrados</p>
            <p class="text-xs text-slate-500">Aún no se han creado proyectos en el sistema.</p>
        </div>

        @else
        {{-- Grid --}}
        <div id="projects-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
            @foreach($projects as $project)
            <button data-name="{{ strtolower($project->name) }}"
                onclick="openModal('{{ addslashes($project->name) }}', '{{ addslashes($project->description ?? 'Sin descripción disponible.') }}')"
                class="project-card bg-[#0d1f2d] border border-white/8 rounded-xl p-5 hover:border-green-500/30 hover:bg-green-500/5 transition-all text-left w-full group">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-lg bg-green-500/10 border border-green-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-sm text-white truncate group-hover:text-green-400 transition-colors">
                            {{ $project->name }}
                        </p>
                        <p class="text-[11px] text-gray-500 mt-0.5">Click para ver descripción</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-600 group-hover:text-green-400 transition-colors shrink-0" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </button>
            @endforeach
        </div>

        {{-- Sin resultados de búsqueda --}}
        <div id="no-results" class="hidden flex-col items-center justify-center py-20 gap-4 text-center">
            <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/8 flex items-center justify-center">
                <svg class="w-7 h-7 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" stroke-width="1.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35" />
                </svg>
            </div>
            <p class="text-sm font-bold text-slate-300">Sin resultados</p>
            <p class="text-xs text-slate-500">No se encontró ningún proyecto con ese nombre.</p>
        </div>

        {{-- Paginador --}}
        <div id="paginator" class="flex items-center justify-between mt-8">
            <p id="page-info" class="text-xs text-gray-500"></p>
            <div class="flex items-center gap-2">
                <button id="prev-btn" onclick="changePage(-1)"
                    class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-white border border-white/10 hover:border-white/20 px-3 py-2 rounded-lg transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Anterior
                </button>
                <div id="page-numbers" class="flex items-center gap-1"></div>
                <button id="next-btn" onclick="changePage(1)"
                    class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-white border border-white/10 hover:border-white/20 px-3 py-2 rounded-lg transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                    Siguiente
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

    </main>

    <footer class="text-center text-xs text-gray-600 pb-8">
        SIGPRO - Sistema de Gestión de Proyectos · ADSO3063934
        By: Luis Miguel Muñoz, Juan David Quinchia, Sebastian Grajales
    </footer>

    {{-- Modal --}}
    <div id="project-modal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 hidden">
        <div class="bg-[#0d1f2d] border border-white/10 rounded-2xl w-full max-w-lg shadow-2xl">
            <div class="flex items-start justify-between gap-4 px-6 pt-6 pb-4 border-b border-white/5">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-lg bg-green-500/10 border border-green-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7" />
                        </svg>
                    </div>
                    <h2 id="modal-title" class="text-base font-bold text-white leading-snug"></h2>
                </div>
                <button onclick="closeModal()" class="text-gray-500 hover:text-white transition-colors mt-0.5 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="px-6 py-5">
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-2">Descripción</p>
                <p id="modal-description" class="text-sm text-gray-300 leading-relaxed break-all"></p>
            </div>
            <div class="px-6 pb-6 flex justify-end">
                <button onclick="closeModal()"
                    class="text-xs text-gray-400 hover:text-white border border-white/10 hover:border-white/20 px-4 py-2 rounded-lg transition-all">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <script>
        const PER_PAGE   = 9;
        let currentPage  = 1;
        let allCards     = [];
        let filtered     = [];

        document.addEventListener('DOMContentLoaded', () => {
            allCards = Array.from(document.querySelectorAll('.project-card'));
            filtered = allCards;
            render();
        });

        // Buscador en tiempo real
        document.getElementById('search-input').addEventListener('input', function () {
            const q = this.value.trim().toLowerCase();
            document.getElementById('clear-btn').classList.toggle('hidden', q === '');
            filtered     = allCards.filter(c => c.dataset.name.includes(q));
            currentPage  = 1;
            render();
        });

        function clearSearch() {
            document.getElementById('search-input').value = '';
            document.getElementById('clear-btn').classList.add('hidden');
            filtered    = allCards;
            currentPage = 1;
            render();
        }

        function render() {
            const totalPages = Math.ceil(filtered.length / PER_PAGE);
            const start      = (currentPage - 1) * PER_PAGE;
            const end        = start + PER_PAGE;
            const visible    = filtered.slice(start, end);

            // Ocultar todas
            allCards.forEach(c => c.classList.add('hidden'));

            // Mostrar las de esta página
            visible.forEach(c => c.classList.remove('hidden'));

            // Sin resultados
            const noResults = document.getElementById('no-results');
            if (filtered.length === 0) {
                noResults.classList.remove('hidden');
                noResults.classList.add('flex');
            } else {
                noResults.classList.add('hidden');
                noResults.classList.remove('flex');
            }

            // Info de página
            document.getElementById('page-info').textContent =
                filtered.length > 0
                    ? `Mostrando ${start + 1}–${Math.min(end, filtered.length)} de ${filtered.length} proyectos`
                    : '';

            // Botones anterior / siguiente
            document.getElementById('prev-btn').disabled = currentPage === 1;
            document.getElementById('next-btn').disabled = currentPage >= totalPages;

            // Números de página
            const pageNumbers = document.getElementById('page-numbers');
            pageNumbers.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement('button');
                btn.textContent = i;
                btn.onclick     = () => { currentPage = i; render(); };
                btn.className   = i === currentPage
                    ? 'w-7 h-7 rounded-lg text-xs font-bold bg-green-500 text-[#07121c]'
                    : 'w-7 h-7 rounded-lg text-xs text-gray-400 hover:text-white border border-white/10 hover:border-white/20 transition-all';
                pageNumbers.appendChild(btn);
            }

            // Ocultar paginador si no hay resultados
            document.getElementById('paginator').classList.toggle('hidden', filtered.length === 0);
        }

        function changePage(dir) {
            const totalPages = Math.ceil(filtered.length / PER_PAGE);
            currentPage = Math.min(Math.max(currentPage + dir, 1), totalPages);
            render();
        }

        // Modal
        function openModal(name, description) {
            document.getElementById('modal-title').textContent       = name;
            document.getElementById('modal-description').textContent = description;
            document.getElementById('project-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('project-modal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.getElementById('project-modal').addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });
    </script>

</body>

</html>