<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ReportAndFeedbacks;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login()
    {
        // Super admin login
        if (Auth::attempt(['email' => request('email'), 'password' => request('password'), 'role_id' => 1], )) {
            return redirect('/dashboard/users');
        }
        // Admin login
        if (Auth::attempt(['email' => request('email'), 'password' => request('password'), 'role_id' => 2], )) {
            return redirect('/dashboard');
        }

        return redirect()->back()
            ->withInput(request()->only('email'))
            ->withErrors([
                'email' => 'Invalid credentials',
            ]);
    }

    public function feedbackDashboard()
    {
        $feedbacks = ReportAndFeedbacks::with(['submittedBy', 'roles'])->get();
        return view('feedbacks.index')
            ->with('feedback', $feedbacks);
    }

    public function viewFeedbacks(ReportAndFeedbacks $reportAndFeedbacks)
    {
        $feedbacks = $reportAndFeedbacks->load(['submittedBy', 'roles']);
        return view('feedbacks.view')
            ->with('feedback', $feedbacks);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
