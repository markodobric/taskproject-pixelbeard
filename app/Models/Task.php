<?php declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\UserAuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property boolean $completed
 * @property User $createdBy
 * @property User|null $updatedBy
 */
class Task extends Model
{
    use UserAuditTrait;

    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'completed',
        'created_by_id',
        'updated_by_id',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
