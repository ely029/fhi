<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\RoleRequestUpdated;
use App\Notifications\MailRoleRequestNotification;

class SendRoleRequestNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    /**
     * Handle the event.
     *
     * @param  RoleRequestUpdated  $event
     * @return void
     */
    public function handle(RoleRequestUpdated $event)
    {
        $roleRequest = $event->roleRequest;
        $user = $roleRequest->user;
        if ($roleRequest->status === 'approved') {
            $user->update([
                'role_id' => $roleRequest->role_id,
            ]);
        } else {
            $user->update([
                'has_chosen_role' => false,
            ]);
        }
        $user->notify(new MailRoleRequestNotification($roleRequest));
    }
}
