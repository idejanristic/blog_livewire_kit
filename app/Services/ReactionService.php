<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class ReactionService
{
    public function toggleLike(Model $model, int $userId): void
    {
        $this->toggle(type: 'like', model: $model, userId: $userId);
    }

    public function toggleDislike(Model $model, int $userId): void
    {
        $this->toggle(type: 'dislike', model: $model, userId: $userId);
    }

    private function toggle(string $type, Model $model, int $userId)
    {
        $column = $type . '_count';
        $relation = $type . 's';

        $reaction = $model->$relation()->where(column: 'user_id', operator: $userId);

        if ($reaction->exists()) {
            $reaction->delete();

            $model->decrement(column: $column);
        } else {
            $model->$relation()->create(attributes: ['user_id' => $userId]);

            $model->increment(column: $column);
        }
    }
}
