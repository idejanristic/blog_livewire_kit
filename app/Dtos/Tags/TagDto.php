<?php

namespace App\Dtos\Tags;

use App\Enums\TagSource;

class TagDto
{
    public function __construct(
        public readonly string $name,
        public readonly TagSource $source,
    ) {}

    public static function apply(array $data): self
    {
        return new self(
            name: $data['name'],
            source: $data['source']
        );
    }
}
