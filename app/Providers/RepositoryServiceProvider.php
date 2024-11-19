<?php declare(strict_types=1);

namespace App\Providers;

use App\Repository\Task\TaskRepository;
use App\Repository\Task\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    public function boot(): void
    {
    }
}
