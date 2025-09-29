<?php

namespace App\Dtos\Activities;

use App\Enums\UserAcivityType;

class ActivityDto
{
    public function __construct(
        public readonly object $model,
        public readonly UserAcivityType $type,
        public readonly ?string $content = null,
        public readonly ?string $ip = null
    ) {}

    public static function apply(array $data): self
    {
        return new self(
            model: $data['model'],
            type: $data['type'],
            content: $data['content'],
            ip: $data['ip']
        );
    }
}
