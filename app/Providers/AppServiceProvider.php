<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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
        Paginator::useBootstrap();
        // for production use
        Livewire::setScriptRoute(function ($handle) {
            return Route::get('projects/tsolar/livewire/livewire.js', $handle);
        });
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('projects/tsolar/livewire/update', $handle);
        });
    }
}
