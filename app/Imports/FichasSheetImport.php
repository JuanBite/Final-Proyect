<?php

namespace App\Imports;

use App\Models\Cohort;
use App\Models\Center;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class FichasSheetImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;

    protected ?User $importer;

    public function __construct(public array &$importWarnings, ?User $importer = null)
    {
        $this->importer = $importer;
    }

    public function model(array $row): ?Cohort
    {
        if (empty($row['cohort_number'])) return null;

        $center = Center::where('name', trim($row['center_name']))
                        ->orWhere('code', strtoupper(trim($row['center_name'])))
                        ->first();

        if (!$center) {
            $this->importWarnings[] = "Ficha '{$row['cohort_number']}': centro '{$row['center_name']}' no encontrado.";
            return null;
        }

        // COORDINATOR: solo puede importar fichas de su propio centro
        if ($this->importer && $this->importer->role === 'COORDINATOR') {
            if ($center->id !== $this->importer->center_id) {
                $this->importWarnings[] = "Ficha '{$row['cohort_number']}': no pertenece a tu centro, se omitió.";
                return null;
            }
        }

        // REGIONAL_ADMIN: solo puede importar fichas de centros de su regional
        if ($this->importer && $this->importer->role === 'REGIONAL_ADMIN') {
            if ($center->region_id !== $this->importer->region_id) {
                $this->importWarnings[] = "Ficha '{$row['cohort_number']}': el centro '{$row['center_name']}' no pertenece a tu regional, se omitió.";
                return null;
            }
        }

        return Cohort::firstOrCreate(
            ['cohort_number' => trim($row['cohort_number'])],
            [
                'program_name' => trim($row['program_name'] ?? ''),
                'center_id'    => $center->id,
                'start_date'   => !empty($row['start_date']) ? \Carbon\Carbon::parse($row['start_date']) : null,
                'end_date'     => !empty($row['end_date'])   ? \Carbon\Carbon::parse($row['end_date'])   : null,
            ]
        );
    }
}