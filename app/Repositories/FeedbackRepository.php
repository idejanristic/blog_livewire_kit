<?php

namespace App\Repositories;

use App\Dtos\FeedbackDto;
use App\Models\Feedback;

class FeedbackRepository
{
    /**
     * @param \App\Dtos\FeedbackDto $dto
     * @param int $userId
     * @return Feedback
     */
    public function create(FeedbackDto $dto, ?int $userId): Feedback
    {
        return Feedback::create(
            attributes: [
                'name' => $dto->name,
                'email' => $dto->email,
                'message' => $dto->message,
                'phone' => $dto->phone,
                'user_id' => $userId ?? null
            ]
        );
    }

    /**
     * @param \App\Dtos\FeedbackDto $dto
     * @param \App\Models\Feedback $feedback
     * @return bool
     */
    public function update(FeedbackDto $dto, Feedback $feedback): bool
    {
        return $feedback->update(
            attributes: [
                'name' => $dto->name,
                'email' => $dto->email,
                'message' => $dto->message,
                'phone' => $dto->phone
            ]
        );
    }

    /**
     * @param \App\Models\Feedback $feedback
     * @return bool|null
     */
    public function delete(Feedback $feedback): bool
    {
        return $feedback->delete();
    }
}
