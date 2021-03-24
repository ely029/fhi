<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $view = view('dashboard.index');

        // User
        $view->with('userCount', User::count());

        // Role
        $view->with('roleCount', Role::count());

        return $view;
    }
}
