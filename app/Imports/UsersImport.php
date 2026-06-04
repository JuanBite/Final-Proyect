<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Center;
use App\Models\Cohort;
use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class UsersImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;

    public array $importWarnings = [];

    const VALID_ROLES = ['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR', 'INSTRUCTOR', 'STUDENT'];

    protected array $regionCache = [];
    protected array $centerCache = [];
    protected array $cohortCache = [];

    // El usuario que está haciendo la importación
    protected User $importer;

    public function __construct(User $importer)
    {
        $this->importer = $importer;
    }

    /**
     * Roles que el importador tiene permitido crear.
     */
    protected function allowedRoles(): array
    {
        return match ($this->importer->role) {
            'ADMIN'          => ['ADMIN', 'REGIONAL_ADMIN', 'COORDINATOR', 'INSTRUCTOR', 'STUDENT'],
            'REGIONAL_ADMIN' => ['COORDINATOR'],
            'COORDINATOR'    => ['INSTRUCTOR', 'STUDENT'],
            default          => [],
        };
    }

    public function model(array $row): ?User
    {
        if (empty($row['email']) || empty($row['first_name'])) return null;

        $email = strtolower(trim($row['email']));
        $role  = strtoupper(trim($row['role'] ?? 'STUDENT'));

        // ── Validar rol ─────────────────────────────────────────────
        if (!in_array($role, self::VALID_ROLES)) {
            $this->importWarnings[] = "'{$email}': rol '{$role}' no válido, se omitió.";
            return null;
        }

        // ── Validar que el importador puede crear ese rol ────────────
        if (!in_array($role, $this->allowedRoles())) {
            $this->importWarnings[] = "'{$email}': no tienes permiso para crear usuarios con rol '{$role}', se omitió.";
            return null;
        }

        // ── Resolver region_id ──────────────────────────────────────
        $regionId = null;
        if (!empty($row['region_name'])) {
            $regionName = trim($row['region_name']);
            if (!isset($this->regionCache[$regionName])) {
                $this->regionCache[$regionName] = Region::where('name', $regionName)
                    ->orWhere('code', strtoupper($regionName))
                    ->value('id');
            }
            $regionId = $this->regionCache[$regionName];
            if (!$regionId) {
                $this->importWarnings[] = "'{$email}': región '{$regionName}' no encontrada.";
            }
        }

        // ── Validar que REGIONAL_ADMIN solo importa su propia regional ──
        if ($this->importer->role === 'REGIONAL_ADMIN') {
            if (!$regionId || $regionId !== $this->importer->region_id) {
                $this->importWarnings[] = "'{$email}': no pertenece a tu regional, se omitió.";
                return null;
            }
        }

        // ── Resolver center_id ──────────────────────────────────────
        $centerId = null;
        if (!empty($row['center_name'])) {
            $centerName = trim($row['center_name']);
            if (!isset($this->centerCache[$centerName])) {
                $this->centerCache[$centerName] = Center::where('name', $centerName)
                    ->orWhere('code', strtoupper($centerName))
                    ->value('id');
            }
            $centerId = $this->centerCache[$centerName];
            if (!$centerId) {
                $this->importWarnings[] = "'{$email}': centro '{$centerName}' no encontrado.";
            }
        }

        // ── Validar que COORDINATOR solo importa su propio centro ────
        if ($this->importer->role === 'COORDINATOR') {
            if (!$centerId || $centerId !== $this->importer->center_id) {
                $this->importWarnings[] = "'{$email}': no pertenece a tu centro, se omitió.";
                return null;
            }
        }

        // ── Resolver cohort ─────────────────────────────────────────
        $cohort = null;
        if (!empty($row['cohort_number'])) {
            $cohortNumber = trim($row['cohort_number']);
            if (!isset($this->cohortCache[$cohortNumber])) {
                $this->cohortCache[$cohortNumber] = Cohort::where('cohort_number', $cohortNumber)->first();
            }
            $cohort = $this->cohortCache[$cohortNumber];
            if (!$cohort) {
                $this->importWarnings[] = "'{$email}': ficha '{$cohortNumber}' no encontrada.";
            }
        }

        // ── INSTRUCTOR: si ya existe, solo agregar la ficha al pivot ─
        if ($role === 'INSTRUCTOR') {
            $document = trim($row['document'] ?? '');
            $existing = User::where('email', $email)
                ->orWhere('document', $document)
                ->first();

            if ($existing) {
                if ($cohort) {
                    $existing->cohorts()->syncWithoutDetaching([$cohort->id]);
                }
                return null;
            }
        }

        // ── Para otros roles: verificar duplicados ──────────────────
        if ($role !== 'INSTRUCTOR') {
            if (User::where('email', $email)->exists()) {
                $this->importWarnings[] = "'{$email}' ya existe (email duplicado), se omitió.";
                return null;
            }
            $document = trim($row['document'] ?? '');
            if ($document && User::where('document', $document)->exists()) {
                $this->importWarnings[] = "'{$email}': documento '{$document}' duplicado, se omitió.";
                return null;
            }
        }

        $user = User::create([
            'first_name' => trim($row['first_name']),
            'last_name'  => trim($row['last_name']  ?? ''),
            'email'      => $email,
            'document'   => trim($row['document']   ?? ''),
            'password'   => bcrypt($row['password'] ?? '12345678'),
            'role'       => $role,
            'status'     => 1,
            'region_id'  => $regionId,
            'center_id'  => in_array($role, ['ADMIN', 'REGIONAL_ADMIN']) ? null : $centerId,
            'cohort_id'  => $role === 'STUDENT' ? $cohort?->id : null,
        ]);

        if ($role === 'INSTRUCTOR' && $cohort) {
            $user->cohorts()->sync([$cohort->id]);
        }

        return $user;
    }
}
