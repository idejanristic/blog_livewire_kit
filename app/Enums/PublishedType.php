<?php

namespace App\Enums;

enum PublishedType: string
{
    case ALL = 'all';
    case PUBLISHED = 'published';
    case UNPUBLISHED = 'unpublished';

    public function label(): string
    {
        return match ($this) {
            self::ALL => 'All',
            self::PUBLISHED => 'Published',
            self::UNPUBLISHED => 'Unpublished'
        };
    }

    public function isActive(string $publishedType): bool
    {
        return $this->value === $publishedType;
    }
}
