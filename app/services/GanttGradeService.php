<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\Submission;

class GanttGradeService
{
    public function recalculateProject(Project $project): float
    {
        $tasks = $project->projectTasks()->get();

        if ($tasks->isEmpty()) {
            $project->update(['progress' => 0]);
            $project->recalculateStatus(); // ← NUEVO
            return 0;
        }

        $taskWeight    = 100 / $tasks->count();
        $totalProgress = 0;

        foreach ($tasks as $task) {
            $taskGrade      = $this->calculateTaskGrade($task);
            $totalProgress += ($taskWeight / 100) * $taskGrade;
        }

        $progress = round($totalProgress, 2);
        $project->update(['progress' => $progress]);
        $project->recalculateStatus(); // ← NUEVO

        return $progress;
    }

    public function calculateTaskGrade(ProjectTask $task): float
    {
        $months = $this->getActiveMonths($task);

        if (empty($months)) {
            return 0;
        }

        $monthWeight = 100 / count($months);
        $taskGrade   = 0;

        foreach ($months as [$year, $month]) {
            $monthGrade = $this->calculateMonthGrade($task, $year, $month);
            $taskGrade += ($monthWeight / 100) * $monthGrade;
        }

        return round($taskGrade, 2);
    }

    public function calculateMonthGrade(ProjectTask $task, int $year, int $month): float
    {
        $allByWeek = Submission::where('task_id', $task->id)
            ->where('submission_year',  $year)
            ->where('submission_month', $month)
            ->get()
            ->groupBy('week_number');

        $activeWeeks = $allByWeek->count();

        if ($activeWeeks === 0) {
            return 0;
        }

        $weekWeight = 100 / $activeWeeks;
        $monthGrade = 0;

        foreach ($allByWeek as $weekNumber => $submissions) {
            $weekGrade   = $this->calculateWeekGrade($submissions->all());
            $monthGrade += ($weekWeight / 100) * $weekGrade;
        }

        return round($monthGrade, 2);
    }

    public function calculateWeekGrade(array $submissions): float
    {
        $count = count($submissions);

        if ($count === 0) {
            return 0;
        }

        $submissionWeight = 100 / $count;
        $weekGrade        = 0;

        foreach ($submissions as $submission) {
            $grade      = (float) ($submission->grade ?? 0);
            $weekGrade += ($submissionWeight / 100) * $grade;
        }

        return round($weekGrade, 2);
    }

    public function getTaskBreakdown(ProjectTask $task): array
    {
        $months = $this->getActiveMonths($task);

        if (empty($months)) {
            return ['task_id' => $task->id, 'task_grade' => 0, 'months' => []];
        }

        $monthWeight = 100 / count($months);
        $taskGrade   = 0;
        $monthsData  = [];

        foreach ($months as [$year, $month]) {
            $allByWeek = Submission::where('task_id', $task->id)
                ->where('submission_year',  $year)
                ->where('submission_month', $month)
                ->get()
                ->groupBy('week_number');

            $activeWeeks = $allByWeek->count();
            $weekWeight  = $activeWeeks > 0 ? 100 / $activeWeeks : 0;
            $monthGrade  = 0;
            $weeksData   = [];

            foreach ($allByWeek as $weekNumber => $submissions) {
                $subWeight       = 100 / $submissions->count();
                $weekGrade       = 0;
                $allGraded       = true;
                $submissionsData = [];

                foreach ($submissions as $sub) {
                    $grade      = (float) ($sub->grade ?? 0);
                    $weekGrade += ($subWeight / 100) * $grade;

                    if (is_null($sub->grade)) {
                        $allGraded = false;
                    }

                    $submissionsData[] = [
                        'id'     => $sub->id,
                        'name'   => $sub->original_filename,
                        'grade'  => $sub->grade,
                        'weight' => round($subWeight, 2),
                    ];
                }

                $weekGrade   = round($weekGrade, 2);
                $monthGrade += ($weekWeight / 100) * $weekGrade;

                $weeksData[] = [
                    'week'        => $weekNumber,
                    'weight'      => round($weekWeight, 2),
                    'grade'       => $weekGrade,
                    'status'      => $allGraded ? 'graded' : 'pending',
                    'submissions' => $submissionsData,
                ];
            }

            $monthGrade  = round($monthGrade, 2);
            $taskGrade  += ($monthWeight / 100) * $monthGrade;

            $monthsData[] = [
                'year'   => $year,
                'month'  => $month,
                'weight' => round($monthWeight, 2),
                'grade'  => $monthGrade,
                'weeks'  => $weeksData,
            ];
        }

        return [
            'task_id'    => $task->id,
            'task_grade' => round($taskGrade, 2),
            'months'     => $monthsData,
        ];
    }

    private function getActiveMonths(ProjectTask $task): array
    {
        $rows = Submission::where('task_id', $task->id)
            ->selectRaw('DISTINCT submission_year, submission_month')
            ->orderBy('submission_year')
            ->orderBy('submission_month')
            ->get();

        return $rows->map(fn($r) => [(int)$r->submission_year, (int)$r->submission_month])->toArray();
    }

    private function getMonthsInRange($startDate, $dueDate): array
    {
        $start  = \Carbon\Carbon::parse($startDate)->startOfMonth();
        $end    = \Carbon\Carbon::parse($dueDate)->startOfMonth();
        $months = [];

        while ($start->lte($end)) {
            $months[] = [$start->year, $start->month];
            $start->addMonth();
        }

        return $months;
    }
}