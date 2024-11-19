<?php declare(strict_types=1);

namespace App\Actions\Task;

use App\Repository\Task\TaskRepositoryInterface;
use Illuminate\Support\Collection;

class ListAllTasksAction
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    public function __invoke(): Collection
    {
        return $this->taskRepository
            ->all()
            ->load('createdBy');
    }
}
