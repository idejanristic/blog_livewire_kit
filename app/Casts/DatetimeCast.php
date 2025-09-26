<?php

namespace App\Casts;

use App\ValueObljects\DatetimeVO;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DatetimeCast implements CastsAttributes
{
    /**
     * Cast the given value.
     */
    public function get($model, string $key, $value, array $attributes): ?DatetimeVO
    {
        return $value !== null
            ? new DatetimeVO(value: new Carbon(time: $value))
            : null;
    }

    /**
     * Prepare the given value for storage.
     */
    public function set($model, string $key, $value, array $attributes): ?string
    {
        if ($value instanceof DatetimeVO) {
            return $value->toCarbon()->format('Y-m-d H:i:s');
        }

        if ($value instanceof Carbon) {
            return $value->format('Y-m-d H:i:s');
        }

        return $value;
    }
}
