<?php

namespace App\Policies;

use App\Policies\Traits\HandlesOwnership;

class CategoryPolicy
{
    use HandlesOwnership;

    private array $actionMessages = [
        'view' => 'Unauthorized access to category.',
        'update' => 'Unauthorized update attempt.',
        'delete' => 'Unauthorized deletion attempt.',
    ];

    public function __call(string $method, array $arguments)
    {
        if (array_key_exists($method, $this->actionMessages)) {
            [$user, $category] = $arguments;

            return $this->authorizeOwnership(
                $category->user_id,
                $this->actionMessages[$method]
            );
        }

        throw new \BadMethodCallException("Method {$method} does not exist.");
    }
}
