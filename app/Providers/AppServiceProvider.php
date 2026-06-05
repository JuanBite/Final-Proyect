<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\Project;
use App\Models\User;
use App\Policies\ProjectPolicy;
use App\Policies\UserPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\GanttGradeService::class);
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
{
    Gate::policy(Project::class, ProjectPolicy::class);
    Gate::policy(User::class, UserPolicy::class);
    Paginator::defaultView('vendor.pagination.tailwind');
}
}
