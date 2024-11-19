<?php declare(strict_types=1);

namespace App\Actions\Task;

use App\Models\Task;
use App\Repository\Task\TaskRepositoryInterface;

class DeleteTaskAction
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    public function __invoke(Task $task): void
    {
        $this->taskRepository->delete($task->id);
    }
}
