<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\RoleRequest;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RoleRequestUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $roleRequest;

    public function __construct(RoleRequest $roleRequest)
    {
        $this->roleRequest = $roleRequest;
    }
}
