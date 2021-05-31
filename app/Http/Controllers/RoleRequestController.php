<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest\StoreRequest;
use App\Models\RoleRequest;

class RoleRequestController extends Controller
{
    public function index()
    {
        return view('role-request.index');
    }

    public function store(StoreRequest $request)
    {
        // no need approval on health care worker
        if ($request->role_id === '3') {
            auth()->user()->update([
                'role_id' => 3,
                'has_chosen_role' => true,
            ]);
            return redirect('enrollments');
        }

        // get already approved roles
        $approvedRoles = RoleRequest::where('user_id', auth()->user()->id)
            ->where('status', 'approved')
            ->pluck('role_id')->toArray();

        // if selected role is one of already approved roles, let them pass
        if ($approvedRoles && in_array($request->role_id, $approvedRoles)) {
            return redirect('enrollments');
        }

        auth()->user()->roleRequests()->create([
            'role_id' => $request->role_id,
        ]);

        return redirect('role/request/pending');
    }

    public function pending()
    {
        return view('role-request.pending');
    }
}
