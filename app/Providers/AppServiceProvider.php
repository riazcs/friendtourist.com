<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Inertia::share([
            'roles' => [
                'admin'=>User::Roles['Admin'],
                'hotel'=>User::Roles['Hotel Admin'],
                'user'=>User::Roles['User'],
            ],
        ]);
    }
}
