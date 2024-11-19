<?php declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\User;

/**
 * @property int $created_by_id
 * @property int|null $updated_by_id
 */
trait UserAuditTrait
{
    public static function bootUserAuditTrait(): void
    {
        static::creating(function (self $model) {
            // this should be authenticated user (like auth()->user())
            $user = User::first();

            if ($user && !$model->isDirty('created_by_id')) {
                $model->created_by_id = $user->id;
            }
        });

        static::updating(function (self $model) {
            // this should be authenticated user (like auth()->user())
            $user = User::first();

            if ($user && !$model->isDirty('updated_by_id')) {
                $model->updated_by_id = $user->id;
            }
        });
    }
}
