<?php

namespace App\Livewire\Components\Posts;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Actions extends Component
{
    public Post $post;
    public array $actions = [
        ['name' => 'preview', 'route' => 'posts.show', 'title' => 'Preview', 'ability' => null, 'icon' => 'book-open'],
        ['name' => 'publish', 'route' => 'posts.publish', 'title' => 'Publish', 'ability' => 'publish', 'icon' => 'clipboard-document-check'],
        ['name' => 'edit', 'route' => 'user.posts.edit', 'title' => 'Edit', 'ability' => 'update', 'icon' => 'pencil-square'],
        ['name' => 'delete', 'route' => null, 'title' => 'Delete', 'ability' => 'delete', 'icon' => 'trash'],
    ];

    public function isAllowed(array $action, Post $post): bool
    {
        if (!isset($action['ability'])) {
            return true;
        }

        return Auth::user()->can(
            abilities: $action['ability'],
            arguments: $post
        );
    }

    public function delete()
    {
        $this->authorize(
            ability: "delete",
            arguments: $this->post
        );

        $postRepository = app(abstract: PostRepository::class);

        $postRepository->delete(post: $this->post);

        $previous = url()->previous();

        if (str_contains(haystack: $previous, needle: "/posts/{$this->post->id}")) {
            return $this->redirectRoute(name: 'posts.index', navigate: true);
        }

        return $this->redirect(url: $previous, navigate: true);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.posts.actions',
            data: [
                'model' => $this->post,
                'actions' => $this->actions
            ]
        );
    }
}
