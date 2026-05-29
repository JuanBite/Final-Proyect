<?php

namespace App\Notifications;

use App\Models\Submission;
use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class EntregaSubidaNotification extends Notification
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
            'type'        => 'entrega_subida',
            'mensaje'     => "Nueva entrega en '{$this->task->title}' — proyecto {$this->project->name}",
            'proyecto_id' => $this->project->id,
            'tarea_id'    => $this->task->id,
            'entrega_id'  => $this->submission->id,
            'archivo'     => $this->submission->original_filename,
            'url'         => url("projects/{$this->project->id}"),
        ];
    }
}