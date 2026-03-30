<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIGPRO — Inicio</title>
     @vite('resources/css/app.css')
</head>

<body class="bg-[#0A1628] text-[#E8F4FF]">

  <div class="flex min-h-screen">

  <!-- Sidebar -->
  <aside class="w-60 min-h-screen bg-[#111D30] border-r border-[#00C853]/15 flex flex-col fixed h-full z-50">

    <!-- Logo -->
    <div class="px-6 pt-7 pb-6 border-b border-[#00C853]/15">
      <div class="flex items-center gap-3">
        <div
          class="w-9 h-9 bg-[#00C853] rounded-xl flex items-center justify-center font-syne font-extrabold text-sm text-[#0A1628]">
          SP</div>
        <span class="font-syne font-extrabold text-lg tracking-[2px] text-[#E8F4FF]">SIGPRO</span>
      </div>
    </div>

    <!-- Nav -->
    <nav class="flex-1 px-4 py-5 flex flex-col gap-1">
      <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB] px-2 py-1 mt-2">Principal</span>
      <a href="sigpro-inicio.html"
        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[#00C853] text-[13.5px] font-medium bg-[#00C853]/12 border border-[#00C853]/25">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
          <polyline points="9 22 9 12 15 12 15 22" />
        </svg>
        Inicio
      </a>
      <a href="sigpro-tarjetas.html"
        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[#8AAABB] text-[13.5px] border border-transparent hover:bg-[#00C853]/6 hover:text-[#E8F4FF] hover:border-[#00C853]/15 transition-all">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <rect x="3" y="3" width="7" height="7" />
          <rect x="14" y="3" width="7" height="7" />
          <rect x="14" y="14" width="7" height="7" />
          <rect x="3" y="14" width="7" height="7" />
        </svg>
        Proyectos
      </a>
      <a href="sigpro-estadisticas.html"
        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[#8AAABB] text-[13.5px] border border-transparent hover:bg-[#00C853]/6 hover:text-[#E8F4FF] hover:border-[#00C853]/15 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
        </svg>

        Estadísticas
      </a>

      <span class="text-[9px] tracking-[2px] uppercase text-[#8AAABB] px-2 py-1 mt-4">Admin</span>
      <a href="sigpro-usuarios.html"
        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[#8AAABB] text-[13.5px] border border-transparent hover:bg-[#00C853]/6 hover:text-[#E8F4FF] hover:border-[#00C853]/15 transition-all">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
          <circle cx="12" cy="7" r="4" />
        </svg>
        Usuarios
      </a>
    </nav>

    <!-- User -->
    <div class="p-4 border-t border-green-500/20">
      <a href="sigpro-perfil-usuario.html">
        <div class="flex items-center gap-3 bg-[#182236] border border-green-500/20 p-2 rounded-lg">
          <div
            class="w-8 h-8 bg-gradient-to-br from-green-600 to-green-400 rounded flex items-center justify-center text-black font-bold text-xs">
            LM</div>
          <div>
            <div class="text-xs">Luis Miguel</div>
            <div class="text-[10px] text-gray-400">Líder de Proyecto</div>
          </div>
        </div>
      </a>
    </div>
  </aside>

  <!-- Main -->
  <div class="ml-60 flex-1 flex flex-col min-h-screen">

    <!-- Topbar -->
    <header
      class="h-16 bg-[#111D30] border-b border-[#00C853]/15 flex items-center justify-between px-8 sticky top-0 z-40">
      <div class="flex items-center gap-2">
        <span class="text-[11px] uppercase tracking-[1.5px] text-[#8AAABB]">Seguimiento</span>
        <span class="text-[#00C853]/30 text-lg">/</span>
        <span class="font-syne font-bold text-lg text-[#E8F4FF]">Tarjetas</span>
      </div>
      <div class="flex items-center gap-3">
        <button
          class="w-9 h-9 bg-[#182236] border border-[#00C853]/15 rounded-xl flex items-center justify-center text-[#8AAABB] hover:bg-[#00C853]/10 hover:border-[#00C853]/30 transition-all relative">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
          </svg>
          <div class="w-1.5 h-1.5 bg-[#00C853] rounded-full absolute top-1.5 right-1.5"></div>
        </button>
        <button
          class="w-9 h-9 bg-[#182236] border border-[#00C853]/15 rounded-xl flex items-center justify-center text-[#8AAABB] hover:bg-[#00C853]/10 hover:border-[#00C853]/30 transition-all">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8" />
            <path d="M21 21l-4.35-4.35" />
          </svg>
        </button>
      </div>
    </header>
      <!-- CONTENT -->
      <div class="p-8">

        <div class="font-syne text-3xl font-extrabold">
          ¡Bienvenido,<br><span class="text-green-400">Luis Miguel!</span> 👋
        </div>

        <div class="text-gray-400 mt-2 mb-6">
          Panel de control para tu proyecto de grado — Todo va bien.
        </div>

        <!-- STATS -->
        <div class="grid grid-cols-4 gap-4 mb-6">

          <div class="bg-[#1C2A40] border border-green-500/20 rounded-xl p-5">
            <div class="text-xs text-gray-400 uppercase">Proyectos Totales</div>
            <div class="font-syne text-3xl font-extrabold">5</div>
            <div class="text-sm text-gray-400"><span class="text-green-400">+2</span> este semestre</div>
          </div>

          <div class="bg-[#1C2A40] border border-yellow-400/30 rounded-xl p-5">
            <div class="text-xs text-gray-400 uppercase">En Progreso</div>
            <div class="font-syne text-3xl font-extrabold">3</div>
            <div class="text-sm text-yellow-400">60% del total</div>
          </div>

          <div class="bg-[#1C2A40] border border-red-400/30 rounded-xl p-5">
            <div class="text-xs text-gray-400 uppercase">Con Retraso</div>
            <div class="font-syne text-3xl font-extrabold">1</div>
            <div class="text-sm text-red-400">Atención requerida</div>
          </div>

          <div class="bg-[#1C2A40] border border-blue-400/30 rounded-xl p-5">
            <div class="text-xs text-gray-400 uppercase">Completados</div>
            <div class="font-syne text-3xl font-extrabold">1</div>
            <div class="text-sm text-blue-400">20% tasa éxito</div>
          </div>

        </div>

        <!-- GRID -->
        <div class="grid grid-cols-2 gap-5">

          <!-- ACTIVIDAD -->
          <div class="bg-[#1C2A40] border border-green-500/20 rounded-xl p-5">
            <div class="text-xs text-gray-400 uppercase mb-4 font-syne">Actividad Reciente</div>

            <div class="space-y-3 text-sm">

              <div class="flex gap-3">
                <div class="w-2 h-2 bg-green-400 rounded-full mt-2"></div>
                <div>
                  Proyecto <b>Sigpro Académico</b> actualizó su avance a 50%
                  <div class="text-xs text-gray-400">Hace 2 horas</div>
                </div>
              </div>

              <div class="flex gap-3">
                <div class="w-2 h-2 bg-yellow-400 rounded-full mt-2"></div>
                <div>
                  Sebastián Grijalva subió un nuevo entregable
                  <div class="text-xs text-gray-400">Hace 5 horas</div>
                </div>
              </div>

              <div class="flex gap-3">
                <div class="w-2 h-2 bg-blue-400 rounded-full mt-2"></div>
                <div>
                  Reunión de seguimiento programada
                  <div class="text-xs text-gray-400">Ayer</div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>

    </main>

  </div>

</body>

</html>