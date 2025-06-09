<?php

namespace App\Policies;

use App\Policies\Traits\HandlesOwnership;

class TaskPolicy
{
    use HandlesOwnership;

    private array $actionMessages = [
        'view' => 'Unauthorized access to task.',
        'update' => 'Unauthorized update attempt.',
        'delete' => 'Unauthorized deletion attempt.',
    ];

    public function __call(string $method, array $arguments)
    {
        if (array_key_exists($method, $this->actionMessages)) {
            [$user, $task] = $arguments;

            return $this->authorizeOwnership(
                $task->user_id,
                $this->actionMessages[$method]
            );
        }

        throw new \BadMethodCallException("Method {$method} does not exist.");
    }
}
