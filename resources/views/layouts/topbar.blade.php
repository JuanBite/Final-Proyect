<header x-data="{ modalLogout: false,
            openLogout() {
                this.modalLogout = true;
                document.getElementById('sidebar')?.classList.add('hidden');
            },
            closeLogout() {
                this.modalLogout = false;
                document.getElementById('sidebar')?.classList.remove('hidden');
            }
        }" class="h-16 bg-[#111D30] border-b border-[#00C853]/15 flex items-center justify-between px-8 sticky top-0 z-40">

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
{{-- CAMPANA DE NOTIFICACIONES --}}
<div x-data="{ open: false }" class="relative" @click.away="open = false">

    <button @click="open = !open"
        class="w-9 h-9 bg-[#182236] border border-[#00C853]/15 rounded-xl flex items-center justify-center text-[#8AAABB] hover:bg-[#00C853]/10 hover:border-[#00C853]/30 transition-all relative">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/>
        </svg>
        @php $unread = auth()->user()->unreadNotifications->count(); @endphp
        @if($unread > 0)
        <div class="absolute -top-1 -right-1 min-w-[16px] h-4 bg-[#00C853] rounded-full flex items-center justify-center px-1">
            <span class="text-[9px] font-bold text-black leading-none">{{ $unread > 9 ? '9+' : $unread }}</span>
        </div>
        @endif
    </button>

    {{-- DROPDOWN --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-1"
         class="absolute right-0 top-12 w-80 bg-[#111D30] border border-[#00C853]/15 rounded-2xl shadow-2xl overflow-hidden z-50"
         x-cloak>

        {{-- Header --}}
        <div class="flex items-center justify-between px-4 py-3 border-b border-[#00C853]/10">
            <p class="text-xs font-syne font-bold text-white">Notificaciones</p>
            @if($unread > 0)
            <form action="{{ route('notifications.readAll') }}" method="POST">
                @csrf
                <button type="submit" class="text-[10px] font-mono text-[#00C853] hover:text-[#00C853]/70 transition-colors cursor-pointer">
                    Marcar todas como leídas
                </button>
            </form>
            @endif
        </div>

        {{-- Lista --}}
        <div class="max-h-80 overflow-y-auto divide-y divide-white/[0.04]"
             style="scrollbar-width:thin; scrollbar-color:rgba(255,255,255,0.1) transparent">

            @forelse(auth()->user()->notifications()->latest()->take(15)->get() as $notification)
            @php
                $data    = $notification->data;
                $isRead  = !is_null($notification->read_at);
                $isEntrega     = ($data['type'] ?? '') === 'entrega_subida';
                $isCalificada  = ($data['type'] ?? '') === 'entrega_calificada';
                $iconBg  = $isEntrega ? 'bg-blue-500/15 text-blue-400' : 'bg-[#00C853]/15 text-[#00C853]';
            @endphp

            <div class="flex items-start gap-3 px-4 py-3 transition-colors {{ $isRead ? 'opacity-50' : 'bg-[#00C853]/[0.03]' }} hover:bg-white/[0.03]">

                {{-- Icono --}}
                <div class="w-8 h-8 rounded-lg {{ $iconBg }} flex items-center justify-center shrink-0 mt-0.5">
                    @if($isEntrega)
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                    </svg>
                    @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                    </svg>
                    @endif
                </div>

                {{-- Contenido --}}
                <div class="flex-1 min-w-0">
                    <p class="text-[12px] text-[#E8F4FF] leading-snug">{{ $data['mensaje'] ?? 'Nueva notificación' }}</p>
                    @if($isCalificada && isset($data['feedback']) && $data['feedback'])
                    <p class="text-[10px] text-gray-500 mt-0.5 truncate">💬 {{ $data['feedback'] }}</p>
                    @endif
                    <div class="flex items-center justify-between mt-1.5">
                        <span class="text-[10px] font-mono text-gray-600">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>
                        <div class="flex items-center gap-1.5">
                            @if(!$isRead)
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-[9px] font-mono text-[#00C853]/70 hover:text-[#00C853] transition-colors cursor-pointer">
                                    Leído
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[9px] font-mono text-red-400/50 hover:text-red-400 transition-colors cursor-pointer">
                                    ✕
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Punto de no leído --}}
                @if(!$isRead)
                <div class="w-1.5 h-1.5 rounded-full bg-[#00C853] shrink-0 mt-2"></div>
                @endif
            </div>

            @empty
            <div class="flex flex-col items-center justify-center py-10 gap-2">
                <div class="w-10 h-10 rounded-full bg-[#00C853]/10 border border-[#00C853]/20 flex items-center justify-center">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" class="text-[#00C853]">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/>
                    </svg>
                </div>
                <p class="text-[11px] font-mono text-gray-500">Sin notificaciones</p>
            </div>
            @endforelse
        </div>

        {{-- Footer --}}
        @if(auth()->user()->notifications()->count() > 15)
        <div class="px-4 py-2.5 border-t border-[#00C853]/10 text-center">
            <p class="text-[10px] font-mono text-gray-600">Mostrando las últimas 15 notificaciones</p>
        </div>
        @endif

    </div>
</div>
        
        <button type="button" @click="openLogout()" class="w-9 h-9 bg-[#182236] border border-[#cc0000]/30 rounded-xl flex items-center justify-center text-[#8AAABB] hover:bg-[#cc0000]/10 hover:border-[#cc0000]/30 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"/>
            </svg>
        </button>
    </div>

    <div x-show="modalLogout"
         @click.away="closeLogout()"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/70 backdrop-blur-sm z-[9999] flex items-center justify-center p-4"
         x-cloak>
        <div @click.stop
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-[#1C2A40] border border-red-500/20 rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h2 class="text-lg font-bold text-red-400 mb-2">Cerrar sesión</h2>
            <p class="text-sm text-slate-400 mb-6">¿Estás seguro de que deseas cerrar tu sesión?</p>
            <div class="flex justify-end gap-2">
                <button type="button" @click="closeLogout()"
                    class="px-4 py-2 rounded-xl text-sm bg-slate-800 text-slate-400 hover:text-white transition-all">Cancelar</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 rounded-xl text-sm bg-red-500 text-white hover:bg-red-600 transition-all">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</header>
