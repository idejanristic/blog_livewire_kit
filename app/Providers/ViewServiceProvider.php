<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\View\Composer\AuthorComposer;
use App\View\Composer\AuthorRequestCounterComposer;
use App\View\Composer\TagsComposer;
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

        View::composer(
            views: ['components.layouts.admin.sidebar', 'components.layouts.admin.header'],
            callback: AuthorRequestCounterComposer::class
        );

        View::composer(
            views: 'livewire.public.*',
            callback: TagsComposer::class
        );
    }
}
