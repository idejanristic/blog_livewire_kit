<?php

namespace App\View\Composer;

use App\Repositories\UserRepository;
use Illuminate\View\View;

class AuthorRequestCounterComposer
{
    public function compose(View $view): void
    {
        $view->with(
            key: 'totalAuthroRequest',
            value: UserRepository::totalAuthorRequest()
        );
    }
}
