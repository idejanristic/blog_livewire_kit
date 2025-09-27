<?php

namespace App\Dtos\Feedbacks;

class FeedbackDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $message,
        public readonly ?string $phone,
    ) {}

    public static function fromAppRequest(array $data): FeedbackDto
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            message: $data['message'],
            phone: $data['phone'] ?? null
        );
    }
}
