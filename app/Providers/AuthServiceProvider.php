<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Task;
use Illuminate\Auth\Access\Response;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-task', function (User $user, Task $task) {
        //     return $user->id === $task->eng_id;
        // });

        Gate::define('write-report', function (User $user, Task $task) {
            return $user->id === $task->eng_id   ? Response::allow()
            : Response::deny('You must be an administrator.');
        });
    }
}