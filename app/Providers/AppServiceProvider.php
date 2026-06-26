<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Gate untuk Admin (Bisa semuanya)
        Gate::define('admin-only', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk User (Hanya terbatas)
        Gate::define('user-only', function (User $user) {
            return $user->role === 'user';
        });
    }
}