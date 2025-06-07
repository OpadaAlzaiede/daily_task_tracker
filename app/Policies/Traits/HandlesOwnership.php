<?php

namespace App\Policies\Traits;

use Illuminate\Support\Facades\Auth;

trait HandlesOwnership
{
    protected function authorizeOwnership($ownerId, string $message): bool
    {
        if (Auth::id() === $ownerId) {
            return true;
        }

        Auth::logout();
        abort(redirect()->route('login')->with('error', $message));
    }
}
