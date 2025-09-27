<?php

namespace App\Livewire\Admin\Feedbacks;

use App\Models\Feedback;
use App\Repositories\FeedbackRepository;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(
    name: 'components.layouts.admin',
    params: [
        'title' => 'Feedback',
        'description' => ''
    ]
)]
class Show extends Component
{
    public Feedback $feedback;

    public function mount(int $id)
    {
        $this->feedback = FeedbackRepository::find(id: $id);
    }

    public function render(): View
    {
        return view(
            view: 'livewire.admin.feedbacks.show',
            data: [
                'feedback' => $this->feedback
            ]
        );
    }
}
