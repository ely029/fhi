<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaseManagementRegimentController extends Controller
{
    public function index()
    {
        return view('case-management.index');
    }
}
