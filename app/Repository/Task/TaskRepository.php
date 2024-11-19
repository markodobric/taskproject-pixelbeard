<?php declare(strict_types=1);

namespace App\Repository\Task;

use App\Models\Task;
use App\Repository\BaseRepository;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }
}
