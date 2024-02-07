<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->authorize();
    }

    protected function authorize()
    {
        Gate::define('viewAdmin', function ($user) {
            return config('admin.enabled') && $user->can('view-admin');
        });

        Gate::check('viewAdmin', [request()->user()]);

        Gate::define('viewAccessControl', function ($user) {
            return config('access-control.enabled') && $user->can('view-access-control');
        });

        Gate::check('viewAccessControl', [request()->user()]);
    }
}
