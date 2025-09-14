<?php

namespace App\Providers;

use App\View\Composer\AuthorComposer;
use App\View\Composer\TagsComposer;
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
            views: '*',
            callback: AuthorComposer::class
        );

        View::composer(
            views: ['*'],
            callback: TagsComposer::class
        );
    }
}
