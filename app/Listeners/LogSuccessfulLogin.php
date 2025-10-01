<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\User;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user instanceof User ? $event->user : null;

        if ($user) {
            activity()
                ->causedBy($user)
                ->withProperties([
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ])
                ->log("User {$user->name} berhasil login");
        }
    }
}
