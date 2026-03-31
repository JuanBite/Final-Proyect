@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
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
@endsection
