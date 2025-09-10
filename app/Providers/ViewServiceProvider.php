<?php

namespace App\Providers;

use App\View\Composer\AuthorComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(
            views: 'components.layouts.*',
            callback: AuthorComposer::class
        );
    }
}
