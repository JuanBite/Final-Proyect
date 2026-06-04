<?php

namespace App\Imports;

use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class RegionesSheetImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;

    public function __construct(public array &$importWarnings) {}

    public function model(array $row): ?Region
    {
        if (empty($row['name']) || empty($row['code'])) return null;

        return Region::firstOrCreate(
            ['code' => strtoupper(trim($row['code']))],
            ['name' => trim($row['name'])]
        );
    }
}