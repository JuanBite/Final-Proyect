<header class="h-16 bg-[#111D30] border-b border-[#00C853]/15 flex items-center justify-between px-8 sticky top-0 z-40">

    <nav class="flex items-center gap-2">
        <a href="{{ url('dashboard') }}" class="text-[#8AAABB] hover:text-[#00C853] transition-colors duration-200 flex items-center">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
        </a>
        @yield('breadcrumbs')
    </nav>

    <div class="flex items-center gap-3">
        <button class="w-9 h-9 bg-[#182236] border border-[#00C853]/15 rounded-xl flex items-center justify-center text-[#8AAABB] hover:bg-[#00C853]/10 hover:border-[#00C853]/30 transition-all relative" id="btn-lupa" onclick="LupaMod.toggle() "
    title="Activar lupa (Alt+L)"
    class="w-9 h-9 rounded-xl bg-slate-700 border border-emerald-500/20 flex items-center justify-center text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/10 transition-all">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="11" cy="11" r="8"/>
        <path d="M21 21l-4.35-4.35"/>
        <circle cx="11" cy="11" r="3"/>
    </svg>
</button>
<button class="w-9 h-9 bg-[#182236] border border-[#00C853]/15 rounded-xl flex items-center justify-center text-[#8AAABB] hover:bg-[#00C853]/10 hover:border-[#00C853]/30 transition-all relative" id="btn-audio" onclick="AudioMod.toggle()"
    title="Activar audio (Alt+A)"
    class="w-9 h-9 rounded-xl bg-slate-700 border border-emerald-500/20 flex items-center justify-center text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/10 transition-all">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M11 5L6 9H2v6h4l5 4V5z"/>
        <path d="M19.07 4.93a10 10 0 010 14.14"/>
        <path d="M15.54 8.46a5 5 0 010 7.07"/>
    </svg>
</button>
        <button class="w-9 h-9 bg-[#182236] border border-[#00C853]/15 rounded-xl flex items-center justify-center text-[#8AAABB] hover:bg-[#00C853]/10 hover:border-[#00C853]/30 transition-all relative">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/>
            </svg>
            <div class="w-1.5 h-1.5 bg-[#00C853] rounded-full absolute top-1.5 right-1.5"></div>
        </button>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-9 h-9 bg-[#182236] border border-[#cc0000]/30 rounded-xl flex items-center justify-center text-[#8AAABB] hover:bg-[#cc0000]/10 hover:border-[#cc0000]/30 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"/>
                </svg>
            </button>
        </form>
    </div>
</header>
