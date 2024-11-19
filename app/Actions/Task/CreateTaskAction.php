<?php declare(strict_types=1);

namespace App\Actions\Task;

use App\Models\Task;
use App\Repository\Task\TaskRepositoryInterface;

class CreateTaskAction
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    public function __invoke(array $data): Task
    {
        return $this->taskRepository->create($data);
    }
}
