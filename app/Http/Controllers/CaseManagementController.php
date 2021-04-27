<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaseManagementController extends Controller
{
    public function index()
    {
        return view('case-management.index');
    }

    public function create()
    {
        return view('case-management.create.form');
    }
}
