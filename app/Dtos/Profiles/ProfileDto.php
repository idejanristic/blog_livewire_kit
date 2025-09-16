<?php

namespace App\Dtos\Profiles;

class ProfileDto
{
    public function __construct(
        public readonly ?string $first_name = null,
        public readonly ?string $last_name = null,
        public readonly ?string $title = null,
        public readonly ?string $img_path = null,
    ) {}

    public static function fromAppRequest(array $data): self
    {
        return new self(
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            title: $data['title'],
            img_path: $data['img_path']
        );
    }
}
