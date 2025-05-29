<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
                // Implicitly grant "Super-Admin" role all permission checks using can()
        Gate::before(function ($user, $ability) {

            if ($user->hasRole('admin')) {

                return true;

            }

        });
    }
}
