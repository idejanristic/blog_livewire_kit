<?php

namespace App\Services;

use App\Enums\UserAcivityType;
use App\Models\UserActivity;

class UserActivityService
{

    /**
     * Summary of log
     * @param object $model
     * @param string $content
     * @param string $ip
     * @return void
     */
    public static function log(object $model, UserAcivityType $type, ?string $content, ?string $ip): void
    {
        if (auth()->user()) {
            UserActivity::create(attributes: [
                'ip_address' => $ip ?? null,
                'user_id' => auth()->user()->id,
                'type' => $type,
                'model' => class_basename(class: $model),
                'model_id' => $model->id,
                'content' => $content
            ]);
        }
    }
}
