<?php declare(strict_types=1);

namespace App\Actions\Task;

use App\Models\Task;
use App\Repository\Task\TaskRepositoryInterface;

class UpdateTaskAction
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    public function __invoke(Task $task, array $data): Task
    {
        $this->taskRepository->update($data, $task->id);

        return $task->refresh();
    }
}
