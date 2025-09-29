<?php

namespace App\Traits;

use App\Enums\UserAcivityType;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

trait UserActivitiable
{
    private function log(object $model, UserAcivityType $type, ?string $content, ?string $ip): void
    {
        if (Auth::user()) {
            UserActivity::create(
                attributes: [
                    'ip_address' => $ip ?? null,
                    'user_id' => Auth::user()->id,
                    'type' => $type,
                    'model' => class_basename(class: $model),
                    'model_id' => $model->id,
                    'content' => $content
                ]
            );
        }
    }

    public function activity(object $model, UserAcivityType $type, ?string $content = ''): void
    {
        $ip = request()->ip();

        $this->log($model, $type, $content, $ip);
    }
}
