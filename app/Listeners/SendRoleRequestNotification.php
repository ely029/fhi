<?php

namespace App\Listeners;

use App\Events\RoleRequestUpdated;
use App\Notifications\MailRoleRequestNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRoleRequestNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

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
        }
        $user->notify(new MailRoleRequestNotification($roleRequest));

    }
}
