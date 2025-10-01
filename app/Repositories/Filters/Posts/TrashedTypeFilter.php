<?php

namespace App\Repositories\Filters\Posts;

use App\Enums\TrashedType;
use Illuminate\Database\Eloquent\Builder;

class TrashedTypeFilter
{
    public function __construct(
        private TrashedType $trashedType = TrashedType::ALL
    ) {}

    public function __invoke(Builder $query): void
    {
        $query->when(
            value: $this->trashedType !== '',
            callback: function (Builder $query): void {
                switch ($this->trashedType) {
                    case TrashedType::ALL:
                        $query->withTrashed();
                        break;
                    case TrashedType::TRASHED:
                        $query->onlyTrashed();
                        break;

                    case TrashedType::UNTRASHED:
                        # code...
                        break;
                    default:
                        # code...
                        break;
                }
            }
        );
    }
}
