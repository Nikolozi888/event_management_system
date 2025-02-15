<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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

        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });


        Gate::define('user', function (User $user) {
            return $user->role === 'user';
        });

        Blade::if('user', function () {
            return request()->user()?->can('user');
        });
    }
}
