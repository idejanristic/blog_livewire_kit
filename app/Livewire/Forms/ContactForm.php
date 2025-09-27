<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Feedback;
use App\Services\FeedbackService;
use Livewire\Attributes\Validate;
use App\Dtos\Feedbacks\FeedbackDto;

class ContactForm extends Form
{
    #[Validate(rule: 'required|min:3|max:255')]
    public string $name;
    #[Validate(rule: 'required|min:3|email')]
    public string $email;
    #[Validate(rule: 'nullable|regex:/^\(\d{3}\) \d{3}-\d{4}$/')]
    public string $phone;
    #[Validate(rule: 'required|min:3|max:2048')]
    public string $message;


    public function store(?int $user_id): Feedback
    {
        $validated =  $this->validate();

        $feedbackService = app(abstract: FeedbackService::class);

        return $feedbackService->create(
            dto: FeedbackDto::fromAppRequest(data: $validated),
            userId: $user_id
        );
    }

    public function update(Feedback $feedback): bool
    {
        $validated =  $this->validate();

        $feedbackService = app(abstract: FeedbackService::class);

        return $feedbackService->update(
            dto: FeedbackDto::fromAppRequest(data: $validated),
            feedback: $feedback
        );
    }
}
