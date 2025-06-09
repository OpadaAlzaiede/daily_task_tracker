<?php

namespace App\Policies;

use App\Models\User;
use App\Policies\Traits\HandlesOwnership;

class RecurringTaskPolicy
{
    use HandlesOwnership;

    private array $actionMessages = [
        'view' => 'Unauthorized access to recurring task.',
        'update' => 'Unauthorized update attempt.',
        'delete' => 'Unauthorized deletion attempt.',
    ];

    public function __call(string $method, array $arguments)
    {
        if (array_key_exists($method, $this->actionMessages)) {
            [$user, $recurringTask] = $arguments;
            return $this->authorizeOwnership(
                $recurringTask->user_id,
                $this->actionMessages[$method]
            );
        }

        throw new \BadMethodCallException("Method {$method} does not exist.");
    }
}
