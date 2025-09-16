<?php

namespace  App\Livewire\Frontend\Settings;

use App\Livewire\Actions\Logout;
use App\Services\TagService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.fronend.app',
    params: [
        'title' => 'Delete User From',
        'description' => ''
    ]
)]
class DeleteUserForm extends Component
{
    public string $password = '';

    public $allTags = [];
    public int $tagId = 0;

    /**
     * Mount the component.
     */
    public function mount(TagService $tagService): void
    {
        $this->allTags = $tagService->getAllTags();
        $this->tagId = (int) request()->query('tag', 0);
    }

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}
