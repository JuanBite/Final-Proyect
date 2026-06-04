<?php

namespace App\Imports;

use App\Models\Center;
use App\Models\Region;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class CentrosSheetImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;

    protected ?User $importer;

    public function __construct(public array &$importWarnings, ?User $importer = null)
    {
        $this->importer = $importer;
    }

    public function model(array $row): ?Center
    {
        if (empty($row['name']) || empty($row['code'])) return null;

        $region = Region::where('name', trim($row['region_name']))
                        ->orWhere('code', strtoupper(trim($row['region_name'])))
                        ->first();

        if (!$region) {
            $this->importWarnings[] = "Centro '{$row['name']}': región '{$row['region_name']}' no encontrada.";
            return null;
        }

        // REGIONAL_ADMIN solo puede importar centros de su propia regional
        if ($this->importer && $this->importer->role === 'REGIONAL_ADMIN') {
            if ($region->id !== $this->importer->region_id) {
                $this->importWarnings[] = "Centro '{$row['name']}': no pertenece a tu regional, se omitió.";
                return null;
            }
        }

        return Center::firstOrCreate(
            ['code' => strtoupper(trim($row['code']))],
            [
                'name'      => trim($row['name']),
                'region_id' => $region->id,
            ]
        );
    }
}