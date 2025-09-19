<?php

namespace App\Livewire\Backend\Infos;

use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class InfoList extends Component
{
    #[Computed]
    public function users(): int
    {
        $userRepository = app(abstract: UserRepository::class);

        return $userRepository->total();
    }

    public function posts(): int
    {
        $postRepository = app(abstract: PostRepository::class);

        return $postRepository->total();
    }

    public function comments(): int
    {
        $commentRepository = app(abstract: CommentRepository::class);

        return $commentRepository->total();
    }

    public function render(): View
    {
        return view(view: 'livewire.backend.infos.info-list');
    }
}
