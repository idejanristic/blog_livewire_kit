<?php

namespace App\Livewire\Components\Feedbacks;

use App\Models\Feedback;
use App\Repositories\FeedbackRepository;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Actions extends Component
{
    public Feedback $feedback;
    public array $actions = [
        ['name' => 'preview', 'route' => 'admin.feedbacks.show', 'title' => 'Preview', 'icon' => 'book-open'],
        ['name' => 'delete', 'route' => null, 'title' => 'Delete',  'icon' => 'trash'],
    ];

    public function delete()
    {
        $feedbackRepository = app(abstract: FeedbackRepository::class);

        $feedbackRepository->delete(feedback: $this->feedback);

        $previous = url()->previous();

        if (str_contains(haystack: $previous, needle: "admin/feedbacks/{$this->feedback->id}")) {
            return $this->redirectRoute(name: 'admin.feedbacks.index', navigate: true);
        }

        return $this->redirect(url: $previous, navigate: true);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.components.feedbacks.actions',
            data: [
                'actions' => $this->actions
            ]
        );
    }
}
