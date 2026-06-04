<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GestionImport implements WithMultipleSheets
{
    public array $importWarnings = [];

    protected User $importer;

    public function __construct(User $importer)
    {
        $this->importer = $importer;
    }

    public function sheets(): array
    {
        $role = $this->importer->role;

        // ADMIN: importa todo (regiones, centros, fichas)
        if ($role === 'ADMIN') {
            return [
                0 => new RegionesSheetImport($this->importWarnings),
                1 => new CentrosSheetImport($this->importWarnings),
                2 => new FichasSheetImport($this->importWarnings),
            ];
        }

        // REGIONAL_ADMIN: solo centros 
        if ($role === 'REGIONAL_ADMIN') {
            return [
                0 => new SkipSheetImport(),
                1 => new CentrosSheetImport($this->importWarnings, $this->importer),
                2 => new SkipSheetImport(), 
            ];
        }

        // COORDINATOR: solo fichas de su centro
        if ($role === 'COORDINATOR') {
            return [
                0 => new SkipSheetImport(),  // salta regiones
                1 => new SkipSheetImport(),  // salta centros
                2 => new FichasSheetImport($this->importWarnings, $this->importer),
            ];
        }

        // Otros roles: no importan nada
        return [];
    }
}
