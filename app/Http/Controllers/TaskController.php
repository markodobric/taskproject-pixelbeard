<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Task\CreateTaskAction;
use App\Actions\Task\DeleteTaskAction;
use App\Actions\Task\ListAllTasksAction;
use App\Actions\Task\UpdateTaskAction;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskController extends Controller
{
    public function index(ListAllTasksAction $action): AnonymousResourceCollection
    {
        return TaskResource::collection(call_user_func($action));
    }

    public function create(CreateTaskRequest $request, CreateTaskAction $action): JsonResource
    {
        return TaskResource::make(call_user_func($action, $request->all()));
    }

    public function show(Task $task)
    {
        return TaskResource::make($task);
    }

    public function update(UpdateTaskRequest $request, Task $task, UpdateTaskAction $action): JsonResource
    {
        return TaskResource::make(call_user_func($action, $task, $request->all()));
    }

    public function delete(Task $task, DeleteTaskAction $action): JsonResponse
    {
        call_user_func($action, $task);

        return response()->json(status: 204);
    }
}
