<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts')

</head>
<body class="bg-[#0A1628] text-[#E8F4FF]">

    @include('layouts.sidebar')

    <div id="main-content" class="ml-16 transition-all duration-200">
        @include('layouts.topbar')
        <main class="p-8 flex flex-col gap-6 flex-1">
            @yield('content')
        </main>
    </div>

    {{-- Toast --}}
    <div id="toast" class="fixed top-6 right-6 z-50 hidden" style="min-width: 320px;">
        <div id="toast-inner" class="flex items-center gap-3 px-5 py-3 rounded-xl shadow-lg border-l-4 border border-white/5 bg-[#0f1f38]">
            <div id="toast-icon" class="shrink-0"></div>
            <span id="toast-message" class="text-sm flex-1"></span>
            <button onclick="hideToast()" id="toast-close" class="shrink-0 opacity-50 hover:opacity-100 ml-2">
               
            </button>
        </div>
    </div>
    {{-- Pasar valores de sesión a JS de forma segura --}}
    @php
    $firstError = $errors->any() ? $errors->first() : null;
    @endphp

    <script>
        const _sessionSuccess = @json(session('success'));
        const _sessionError = @json(session('error'));
        const _sessionWarning = @json(session('warning'));
        const _sessionInfo = @json(session('info'));
        const _sessionErrors = @json($firstError);

    </script>

    <script>
        // ─── Toast ───────────────────────────────────────────────
        const toastTypes = {
            success: {
                borderColor: '#00C853'
                , textColor: '#00C853'
                , icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00C853" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>`
            }
            , error: {
                borderColor: '#ef4444'
                , textColor: '#ef4444'
                , icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ef4444" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>`
            }
            , warning: {
                borderColor: '#f59e0b'
                , textColor: '#f59e0b'
                , icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#f59e0b" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>`
            }
            , info: {
                borderColor: '#3b82f6'
                , textColor: '#3b82f6'
                , icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#3b82f6" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>`
            }
        };

        function showToast(message, type) {
            type = type || 'info';
            const cfg = toastTypes[type] || toastTypes.info;
            const toast = document.getElementById('toast');
            const inner = document.getElementById('toast-inner');
            const iconEl = document.getElementById('toast-icon');
            const messageEl = document.getElementById('toast-message');
            const closeBtn = document.getElementById('toast-close');

            messageEl.textContent = message;
            messageEl.style.color = cfg.textColor;
            iconEl.innerHTML = cfg.icon;
            closeBtn.style.color = cfg.textColor;
            inner.style.borderLeftColor = cfg.borderColor;

            toast.classList.remove('hidden');
            setTimeout(hideToast, 4000);
        }

        function hideToast() {
            document.getElementById('toast').classList.add('hidden');
        }

        if (_sessionSuccess) showToast(_sessionSuccess, 'success');
        if (_sessionError) showToast(_sessionError, 'error');
        if (_sessionErrors) showToast(_sessionErrors, 'error');
        if (_sessionWarning) showToast(_sessionWarning, 'warning');
        if (_sessionInfo) showToast(_sessionInfo, 'info');
        // ─── Sidebar ─────────────────────────────────────────────
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');

        function initSidebar() {
            const isOpen = localStorage.getItem('sidebarOpen') === 'true';
            applySidebar(isOpen);
        }

        function toggleSidebar() {
            const isOpen = sidebar.classList.contains('w-60');
            localStorage.setItem('sidebarOpen', String(!isOpen));
            applySidebar(!isOpen);
        }

        function applySidebar(isOpen) {
            sidebar.classList.toggle('w-60', isOpen);
            sidebar.classList.toggle('w-16', !isOpen);
            main.classList.toggle('ml-60', isOpen);
            main.classList.toggle('ml-16', !isOpen);

            document.getElementById('logo-open').style.display = isOpen ? 'flex' : 'none';
            document.getElementById('logo-closed').style.display = isOpen ? 'none' : 'flex';

            ['label-principal', 'label-admin', 'user-info'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el) el.classList.toggle('hidden', !isOpen);
            });

            document.querySelectorAll('.sidebar-text').forEach(function(el) {
                el.classList.toggle('hidden', !isOpen);
            });

            document.querySelectorAll('.sidebar-link').forEach(function(el) {
                el.classList.toggle('px-3', isOpen);
                el.classList.toggle('px-0', !isOpen);
                el.classList.toggle('justify-center', !isOpen);
            });
        }

        initSidebar();

    </script>

    @stack('page-scripts')
</body>
</html>
