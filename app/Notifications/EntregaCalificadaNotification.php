<?php

namespace App\Notifications;

use App\Models\Submission;
use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class EntregaCalificadaNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Submission $submission,
        public Project $project,
        public ProjectTask $task
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'        => 'entrega_calificada',
            'mensaje'     => "Tu entrega en '{$this->task->title}' fue calificada con {$this->submission->grade}/100",
            'proyecto_id' => $this->project->id,
            'tarea_id'    => $this->task->id,
            'entrega_id'  => $this->submission->id,
            'nota'        => $this->submission->grade,
            'feedback'    => $this->submission->feedback,
            'url'         => url("projects/{$this->project->id}"),
        ];
    }
}