<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\User;

class LogSuccessfulLogout
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        $user = $event->user instanceof User ? $event->user : null;

        if ($user) {
            activity()
                ->causedBy($user)
                ->withProperties([
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ])
                ->log("User {$user->name} berhasil logout");
        }
    }
}
