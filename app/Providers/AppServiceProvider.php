<?php

namespace App\Providers;

use App\Models\User;
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
        view()->composer(['layouts.users'], function ($view) {
            $allUsers = User::where('id', '!=', auth()->id())->get();
            $view->with('allUsers', $allUsers);
        });
    }
}
