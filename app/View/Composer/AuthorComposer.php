<?php

namespace App\View\Composer;

use Illuminate\View\View;

class AuthorComposer
{
    public function compose(View $view): void
    {
        $view->with(
            key: 'author',
            value: 'Dejan Ristić'
        );
    }
}
