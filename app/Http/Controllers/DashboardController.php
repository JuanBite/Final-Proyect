<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Enums\EnumStatus;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::with(['leader', 'members'])
            ->orderByRaw("
                CASE status 
                    WHEN '" . EnumStatus::DELAYED->value . "' THEN 1
                    WHEN '" . EnumStatus::IN_PROGRESS->value . "' THEN 2
                    WHEN '" . EnumStatus::COMPLETED->value . "' THEN 3
                END
            ")
            ->orderBy('due_date')
            ->get();

        $stats = [
            'total'        => $projects->count(),
            'en_progreso'  => $projects->where('status', EnumStatus::IN_PROGRESS->value)->count(),
            'con_retraso'  => $projects->where('status', EnumStatus::DELAYED->value)->count(),
            'completados'  => $projects->where('status', EnumStatus::COMPLETED->value)->count(),
            'avg_progress' => $projects->count() ? round($projects->avg('progress')) : 0,
        ];

        $statusConfig = [
            EnumStatus::IN_PROGRESS->value => [
                'label' => 'En Progreso',
                'color' => '#facc15',
                'bg'    => 'bg-yellow-400/10',
                'text'  => 'text-yellow-400',
                'count' => $stats['en_progreso'],
            ],
            EnumStatus::COMPLETED->value => [
                'label' => 'Completado',
                'color' => '#4ade80',
                'bg'    => 'bg-green-400/10',
                'text'  => 'text-green-400',
                'count' => $stats['completados'],
            ],
            EnumStatus::DELAYED->value => [
                'label' => 'Con Retraso',
                'color' => '#f87171',
                'bg'    => 'bg-red-400/10',
                'text'  => 'text-red-400',
                'count' => $stats['con_retraso'],
            ],
        ];

        $today = now()->startOfDay();
        $avg = $stats['avg_progress'];
        $avgColor = $avg >= 70 ? '#4ade80' : ($avg >= 40 ? '#facc15' : '#f87171');

        $chartData = [
            'labels' => ['En Progreso', 'Completados', 'Con Retraso'],
            'values' => [$stats['en_progreso'], $stats['completados'], $stats['con_retraso']],
            'backgroundColor' => ['#facc15', '#4ade80', '#f87171'],
        ];

        $at_risk = $projects->filter(function ($p) use ($today) {
            if (!$p->due_date) {
                return false;
            }

            $dueDate = $p->due_date->copy()->startOfDay();
            $daysLeft = $today->diffInDays($dueDate, false);

            return $daysLeft >= 0
                && $daysLeft <= 14
                && $p->status !== EnumStatus::COMPLETED->value;
        })->map(function ($p) {
            if ($p->leader) {
                $p->leader_name = trim($p->leader->first_name . ' ' . $p->leader->last_name);
            } else {
                $p->leader_name = '—';
            }
            return $p;
        })->sortBy('due_date')->take(5);

        $upcoming = $projects
            ->filter(fn ($p) => $p->due_date && $p->status !== EnumStatus::COMPLETED->value)
            ->sortBy('due_date')
            ->take(7);

        $deliveryColors = ['#60a5fa', '#4ade80', '#facc15', '#f87171', '#a78bfa', '#fb923c', '#2dd4bf'];

        return view('dashboard', compact(
            'projects',
            'stats',
            'at_risk',
            'statusConfig',
            'chartData',
            'today',
            'avg',
            'avgColor',
            'upcoming',
            'deliveryColors'
        ));
    }
}