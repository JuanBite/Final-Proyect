<aside class="fixed h-full z-50 flex flex-col bg-[#111D30] border-r border-[#00C853]/15 transition-[width] duration-150 ease-out"
    :class="sidebarOpen ? 'w-60' : 'w-16'">

    {{-- Header --}}
    <div class="border-b border-[#00C853]/15 flex items-center min-h-[72px] transition-all duration-300"
        :class="sidebarOpen ? 'px-4 justify-between' : 'px-0 justify-center'">

        {{-- Abierto: logo + texto + botón --}}
        <template x-if="sidebarOpen">
            <div class="flex items-center justify-between w-full px-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-[#00C853] rounded-xl flex items-center justify-center font-syne font-extrabold text-sm text-[#0A1628] shrink-0">
                        SP
                    </div>
                    <span class="font-syne font-extrabold text-lg tracking-[2px] text-[#E8F4FF]">SIGPRO</span>
                </div>
                <button @click="sidebarOpen = false"
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-[#8AAABB] hover:bg-[#00C853]/10 hover:text-[#00C853] transition-all">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
            </div>
        </template>

        {{-- Cerrado: solo botón hamburguesa centrado --}}
        <template x-if="!sidebarOpen">
            <button @click="sidebarOpen = true"
                class="w-9 h-9 flex items-center justify-center rounded-xl bg-[#00C853] text-[#0A1628] hover:brightness-110 transition-all font-syne font-extrabold text-sm">
                SP
            </button>
        </template>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 px-3 py-5 flex flex-col gap-1 overflow-hidden">

        <span x-show="sidebarOpen" x-transition.opacity
            class="text-[9px] tracking-[2px] uppercase text-[#8AAABB] px-2 py-1 mt-2">Principal</span>

        <a href="{{ url('dashboard') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13.5px] border transition-all
            {{ request()->is('dashboard') ? 'text-[#00C853] bg-[#00C853]/12 border-[#00C853]/25' : 'text-[#8AAABB] border-transparent hover:bg-[#00C853]/6 hover:text-[#E8F4FF] hover:border-[#00C853]/15' }}"
            :class="sidebarOpen ? '' : 'justify-center px-0'">
            <svg class="shrink-0" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            <span x-show="sidebarOpen" class="whitespace-nowrap">Inicio</span>
        </a>

        <a href="{{ url('projects') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13.5px] border transition-all
            {{ request()->is('projects*') ? 'text-[#00C853] bg-[#00C853]/12 border-[#00C853]/25' : 'text-[#8AAABB] border-transparent hover:bg-[#00C853]/6 hover:text-[#E8F4FF] hover:border-[#00C853]/15' }}"
            :class="sidebarOpen ? '' : 'justify-center px-0'">
            <svg class="shrink-0" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>
            </svg>
            <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap">Proyectos</span>
        </a>

        <span x-show="sidebarOpen" x-transition.opacity
            class="text-[9px] tracking-[2px] uppercase text-[#8AAABB] px-2 py-1 mt-4">Admin</span>

        <a href="{{ url('gestion') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13.5px] border transition-all
            {{ request()->is('gestion*') ? 'text-[#00C853] bg-[#00C853]/12 border-[#00C853]/25' : 'text-[#8AAABB] border-transparent hover:bg-[#00C853]/6 hover:text-[#E8F4FF] hover:border-[#00C853]/15' }}"
            :class="sidebarOpen ? '' : 'justify-center px-0'">
            <svg class="shrink-0 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
            </svg>
            <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap">Gestión</span>
        </a>

        <a href="{{ url('users') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13.5px] border transition-all
            {{ request()->is('users') ? 'text-[#00C853] bg-[#00C853]/12 border-[#00C853]/25' : 'text-[#8AAABB] border-transparent hover:bg-[#00C853]/6 hover:text-[#E8F4FF] hover:border-[#00C853]/15' }}"
            :class="sidebarOpen ? '' : 'justify-center px-0'">
            <svg class="shrink-0" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap">Usuarios</span>
        </a>
    </nav>

    {{-- User --}}
    <div class="p-3 border-t border-green-500/20">
        <a href="{{ route('users.show', auth()->user()) }}">
            <div class="flex items-center gap-3 bg-[#182236] border border-[#00C853]/20 p-3 rounded-lg hover:border-[#00C853]/40 transition-all overflow-hidden"
                :class="sidebarOpen ? '' : 'justify-center border-none'"> 
                <div class="w-9 h-9 bg-gradient-to-br from-[#00C853] to-[#00A040] rounded-lg flex items-center justify-center text-[#0A1628] font-bold text-xs font-syne shrink-0">
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1)) }}
                </div>
                <div x-show="sidebarOpen" x-transition.opacity class="flex-1 min-w-0 overflow-hidden">
                    <div class="text-xs font-medium text-[#E8F4FF] truncate">
                        {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                    </div>
                    <div class="text-[10px] text-[#8AAABB] mt-1">
                        @if(auth()->user()->role === 'ADMIN')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-red-500/12 text-red-400 border border-red-500/25">
                                <span class="w-1 h-1 rounded-full bg-red-400"></span>Admin
                            </span>
                        @elseif(auth()->user()->role === 'INSTRUCTOR')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-blue-500/12 text-blue-400 border border-blue-500/25">
                                <span class="w-1 h-1 rounded-full bg-blue-400"></span>Instructor
                            </span>
                        @elseif(auth()->user()->role === 'STUDENT')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-[#00C853]/12 text-[#00C853] border border-[#00C853]/25">
                                <span class="w-1 h-1 rounded-full bg-[#00C853]"></span>Estudiante
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </a>
    </div>
</aside>