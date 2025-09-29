<?php

namespace App\Repositories\Filters\Posts;

use App\Enums\PublishedType;
use Carbon\Carbon;
use GuzzleHttp\Psr7\PumpStream;
use Illuminate\Database\Eloquent\Builder;

class PublishedFilter
{
    public function __construct(
        private PublishedType $publishedType
    ) {}


    public function __invoke(Builder $query): void
    {
        $query->when(
            value: $this->publishedType !== '',
            callback: function (Builder $query): void {
                switch ($this->publishedType->value) {
                    case PublishedType::PUBLISHED->value:
                        $query->where(
                            column: 'published_at',
                            operator: '<=',
                            value: Carbon::now()->format('Y-m-d')
                        );
                        break;
                    case PublishedType::UNPUBLISHED->value:
                        $query->where(column: function (Builder $q): void {
                            $q->where(
                                column: 'published_at',
                                operator: '>',
                                value: Carbon::now()->format('Y-m-d')
                            )
                                ->orWhereNull(column: 'published_at');
                        });
                        break;
                    default:
                        break;
                }
            }
        );
    }
}
