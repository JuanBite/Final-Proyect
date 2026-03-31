<div class="bg-[#111D30] border border-green-500/20 rounded-3xl w-[560px] max-w-full shadow-2xl overflow-hidden">

    <!-- HEADER -->
    <div class="relative flex items-center gap-4 p-7 border-b border-green-500/20 bg-green-500/5">

        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-green-500 to-blue-400"></div>

        <div class="w-12 h-12 rounded-xl bg-green-500/10 border border-green-500/30 flex items-center justify-center text-green-400">
            ✏️
        </div>

        <div>
            <div class="font-syne text-xl font-extrabold">
                Editar <span class="text-green-400">Usuario</span>
            </div>
            <div class="text-sm text-gray-400">Modifica el perfil y permisos del usuario</div>
        </div>

        <div class="ml-auto mr-10 flex items-center gap-2 bg-green-500/10 border border-green-500/30 px-3 py-1 rounded text-xs text-green-400">
            ● Modo edición
        </div>

        <div class="absolute top-5 right-5 w-8 h-8 bg-[#182236] border border-green-500/20 rounded flex items-center justify-center text-gray-400 cursor-pointer">
            ✕
        </div>
    </div>

    <!-- BODY -->
    <div class="p-6">

        <!-- PROFILE -->
        <div class="flex items-center gap-4 bg-green-500/10 border border-green-500/30 rounded-xl p-4 mb-6">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl font-bold bg-gradient-to-br from-green-700 to-green-400 text-black">
                LM
            </div>
            <div class="flex-1">
                <div class="font-syne font-bold">Luis Miguel Muñoz</div>
                <div class="text-xs text-gray-400">luis.munoz@sigpro.edu.co</div>
            </div>
            <div class="text-xs bg-green-500/10 text-green-400 px-3 py-1 rounded-full border border-green-500/30">
                ● Líder de Proyecto
            </div>
        </div>

        <!-- DATOS -->
        <div class="text-[10px] uppercase tracking-widest text-gray-400 mb-3 flex items-center gap-2">
            Datos personales <div class="flex-1 h-px bg-green-500/20"></div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <input class="col-span-1 bg-[#182236] border border-green-500/20 rounded-lg p-3 text-sm" value="Luis Miguel">
            <input class="col-span-1 bg-[#182236] border border-green-500/20 rounded-lg p-3 text-sm" value="Muñoz">
            <input class="col-span-2 bg-[#182236] border border-green-500/20 rounded-lg p-3 text-sm" value="luis.munoz@sigpro.edu.co">
            <input class="bg-[#182236] border border-green-500/20 rounded-lg p-3 text-sm" value="1234567890">
            <input class="bg-[#182236] border border-green-500/20 rounded-lg p-3 text-sm" type="date" value="2026-02-12">
        </div>

        <!-- ESTADO -->
        <div class="text-[10px] uppercase tracking-widest text-gray-400 mb-3 flex items-center gap-2">
            Estado de la cuenta <div class="flex-1 h-px bg-green-500/20"></div>
        </div>

        <div class="flex gap-2 mb-6">
            <div class="flex-1 text-center p-2 rounded-lg border border-green-500/30 bg-green-500/10 text-green-400">
                ● Activo
            </div>
            <div class="flex-1 text-center p-2 rounded-lg border border-green-500/20 bg-[#182236] text-gray-400">
                ○ Inactivo
            </div>
        </div>

        <!-- ROLES -->
        <div class="text-[10px] uppercase tracking-widest text-gray-400 mb-3 flex items-center gap-2">
            Rol en el sistema <div class="flex-1 h-px bg-green-500/20"></div>
        </div>

        <div class="grid grid-cols-3 gap-2 mb-6">
            <div class="text-center p-3 rounded-xl border border-green-500/30 bg-green-500/10">
                🎯
                <div class="font-syne text-sm text-green-400">Líder</div>
                <div class="text-xs text-gray-400">Gestiona</div>
            </div>
            <div class="text-center p-3 rounded-xl border border-green-500/20 bg-[#182236]">
                👤
                <div class="font-syne text-sm text-blue-400">Miembro</div>
                <div class="text-xs text-gray-400">Participa</div>
            </div>
            <div class="text-center p-3 rounded-xl border border-green-500/20 bg-[#182236]">
                ⚙️
                <div class="font-syne text-sm text-yellow-400">Admin</div>
                <div class="text-xs text-gray-400">Administra</div>
            </div>
        </div>

        <!-- PROYECTOS -->
        <div class="text-[10px] uppercase tracking-widest text-gray-400 mb-3 flex items-center gap-2">
            Proyectos asignados <div class="flex-1 h-px bg-green-500/20"></div>
        </div>

        <div class="flex flex-col gap-2">
            <div class="flex items-center gap-3 p-3 rounded-lg bg-green-500/10 border border-green-500/30">
                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                <span class="flex-1 text-sm">Sigpro Académico</span>
                <span class="text-xs text-green-400">Líder</span>
            </div>

            <div class="flex items-center gap-3 p-3 rounded-lg bg-green-500/10 border border-green-500/30">
                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                <span class="flex-1 text-sm">Portería Sigpro</span>
                <span class="text-xs text-green-400">Líder</span>
            </div>

            <div class="flex items-center gap-3 p-3 rounded-lg bg-green-500/10 border border-green-500/30">
                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                <span class="flex-1 text-sm">Emprender</span>
            </div>

            <div class="flex items-center gap-3 p-3 rounded-lg bg-[#182236] border border-green-500/20">
                <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                <span class="flex-1 text-sm">Parking Sigpro</span>
            </div>

            <div class="flex items-center gap-3 p-3 rounded-lg bg-[#182236] border border-green-500/20">
                <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                <span class="flex-1 text-sm">Gimnasio</span>
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="flex justify-between items-center p-6 border-t border-green-500/20">
        <div class="text-xs text-gray-400">
            ID: <b>#001</b> · Ingresó: <b>12/02/2026</b>
        </div>

        <div class="flex gap-2">
            <button class="px-4 py-2 rounded-lg border border-green-500/20 bg-[#182236] text-gray-400">Cancelar</button>
            <button class="px-4 py-2 rounded-lg border border-red-400/30 bg-red-500/10 text-red-400">Eliminar</button>
            <button class="px-5 py-2 rounded-lg bg-green-400 text-black font-medium">Guardar</button>
        </div>
    </div>

</div>

