<?php

namespace App\Http\Controllers;

use App\Imports\GestionImport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function importGestion(Request $request)
    {
        $user = auth()->user();
    

        // Solo ADMIN, REGIONAL_ADMIN y COORDINATOR pueden importar gestión
        if (!in_array($user->role, ['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR'])) {
            return back()->with('error', 'No tienes permiso para importar gestión.');
        }

        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls', 'max:5120'],
        ]);

        $import = new GestionImport($user);

        try {
            Excel::import($import, $request->file('file'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el archivo: ' . $e->getMessage());
        }

        $msg = 'Importación de gestión completada.';

        if (!empty($import->importWarnings)) {
            return back()
                ->with('warning', $msg)
                ->with('import_errors', $import->importWarnings);
        }

        return back()->with('success', $msg);
    }

    public function importUsers(Request $request)
    {
        $user = auth()->user();

        // Solo ADMIN, REGIONAL_ADMIN y COORDINATOR pueden importar usuarios
        if (!in_array($user->role, ['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR'])) {
            return back()->with('error', 'No tienes permiso para importar usuarios.');
        }

        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls', 'max:5120'],
        ]);

        $import = new UsersImport($user);

        try {
            Excel::import($import, $request->file('file'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el archivo: ' . $e->getMessage());
        }

        $msg = 'Importación de usuarios completada.';

        if (!empty($import->importWarnings)) {
            return back()
                ->with('warning', $msg)
                ->with('import_errors', $import->importWarnings);
        }

        return back()->with('success', $msg);
    }
}