<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

/**
 * Hoja vacía que simplemente ignora todo su contenido.
 * Se usa cuando un rol no tiene permiso para importar esa hoja.
 */
class SkipSheetImport implements ToArray
{
    public function array(array $array): void
    {
        // No hace nada, descarta todas las filas
    }
}