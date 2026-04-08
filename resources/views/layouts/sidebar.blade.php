<aside class="w-60 min-h-screen bg-[#111D30] border-r border-[#00C853]/15 flex flex-col fixed h-full z-50">

    <!-- Logo -->
    <div class="px-6 pt-7 pb-6 border-b border-[#00C853]/15">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-[#00C853] rounded-xl flex items-center justify-center font-syne font-extrabold text-sm text-[#0A1628]">
                SP</div>
            <span class="font-syne font-extrabold text-lg tracking-[2px] text-[#E8F4FF]">SIGPRO</span>
        </div>
    </div>


    <!-- Nav -->
    <nav class="flex-1 px-4 py-5 flex flex-col gap-1">
        <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB] px-2 py-1 mt-2">Principal</span>
        <a href="{{ url('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13.5px] border transition-all {{ request()->is('dashboard') ? 'text-[#00C853] bg-[#00C853]/12 border-[#00C853]/25' : 'text-[#8AAABB] border-transparent hover:bg-[#00C853]/6 hover:text-[#E8F4FF] hover:border-[#00C853]/15' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
            Inicio
        </a>
        <a href="{{ url('projects') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13.5px] border transition-all {{ request()->is('projects*') ? 'text-[#00C853] bg-[#00C853]/12 border-[#00C853]/25' : 'text-[#8AAABB] border-transparent hover:bg-[#00C853]/6 hover:text-[#E8F4FF] hover:border-[#00C853]/15' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
            </svg>
            Proyectos
        </a>
        <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB] px-2 py-1 mt-4">Admin</span>

        <a href="{{ url('gestion') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13.5px] border transition-all {{ request()->is('gestion*') ? 'text-[#00C853] bg-[#00C853]/12 border-[#00C853]/25' : 'text-[#8AAABB] border-transparent hover:bg-[#00C853]/6 hover:text-[#E8F4FF] hover:border-[#00C853]/15' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
            </svg>
            Gestión
        </a>

        <a href="{{ url('users') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[13.5px] border transition-all {{ request()->is('users') ? 'text-[#00C853] bg-[#00C853]/12 border-[#00C853]/25' : 'text-[#8AAABB] border-transparent hover:bg-[#00C853]/6 hover:text-[#E8F4FF] hover:border-[#00C853]/15' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            Usuarios
        </a>
    </nav>

    <!-- User -->
    <div class="p-4 border-t border-green-500/20">
        <a href="{{ url('users/detail/{id}') }}">
            <div class="flex items-center gap-3 bg-[#182236] border border-green-500/20 p-2 rounded-lg">
                <div class="w-8 h-8 bg-gradient-to-br from-green-600 to-green-400 rounded flex items-center justify-center text-black font-bold text-xs">
                    LM</div>
                <div>
                    <div class="text-xs">Luis Miguel</div>
                    <div class="text-[10px] text-gray-400">Líder de Proyecto</div>
                </div>
            </div>
        </a>
    </div>
</aside>
