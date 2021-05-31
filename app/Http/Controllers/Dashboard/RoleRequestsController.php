<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Events\RoleRequestUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest\UpdateRequest;
use App\Models\Filters\RoleRequestFilters;
use App\Models\RoleRequest;
use Carbon\Carbon;
use DB;

class RoleRequestsController extends Controller
{
    public function index(RoleRequestFilters $filters)
    {
        $roleRequests = RoleRequest::with(['user','role'])->filter($filters)->orderBy('created_at', 'desc')->paginate();

        $roles = [4,5,6,7,8];
        $allCount = [];
        

        $allRoleRequests = DB::table('role_requests')
        ->select('role_id', DB::raw('count(*) as total'))
        ->groupBy('role_id')
        ->get()->keyBy('role_id');
    
        $total = 0;
        foreach ($roles as $role) {
            $count = isset($allRoleRequests[$role]) ? $allRoleRequests[$role]->total : 0;
            $allCount[$role] = $count;
            $total += $count;
        }
 
        $allCount['total'] = $total;
        return view('dashboard.role-requests.index', [
            'roleRequests' => $roleRequests,
            'allCount' => $allCount,
        ]);
    }

    public function show(RoleRequest $roleRequest)
    {
        return view('dashboard.role-requests.show', [
            'roleRequest' => $roleRequest,
        ]);
    }

    public function update(UpdateRequest $request, RoleRequest $roleRequest)
    {
        $roleRequest->status = $request->status;
        if ($request->status === 'approved') {
            $roleRequest->approved_by = auth()->user()->id;
            $roleRequest->date_approved = Carbon::now();
        }
        $roleRequest->remarks = request('remarks');
        $roleRequest->save();

        event(new RoleRequestUpdated($roleRequest));

        return redirect('dashboard/role-requests')->with([
            'alert.message' => 'Role Request '.$roleRequest->status.' successfully.',
        ]);

    }

}
