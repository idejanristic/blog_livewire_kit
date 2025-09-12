<?php

namespace App\Services;

use App\Dtos\FeedbackDto;
use App\Models\Feedback;
use App\Repositories\FeedbackRepository;

class FeedbackService
{
    public function __construct(
        private FeedbackRepository $feedbackRepository
    ) {}

    /**
     * @param \App\Dtos\FeedbackDto $dto
     * @param int $userId
     * @return Feedback
     */
    public function create(FeedbackDto $dto, ?int $userId): Feedback
    {
        return $this->feedbackRepository
            ->create(dto: $dto, userId: $userId);
    }

    /**
     * @param \App\Dtos\FeedbackDto $dto
     * @param \App\Models\Feedback $feedback
     * @return bool
     */
    public function update(FeedbackDto $dto, Feedback $feedback): bool
    {
        return $this->feedbackRepository
            ->update(dto: $dto, feedback: $feedback);
    }
}
