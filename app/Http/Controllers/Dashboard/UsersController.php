<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Users\StoreRequest;
use App\Http\Requests\Dashboard\Users\UpdateRequest;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => User::where('role_id', 2)->orderBy('created_at', 'desc')->paginate(),
        ]);
    }

    public function create()
    {
        return view('dashboard.users.form', ['method' => 'POST']);
    }

    public function store(StoreRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => bcrypt($request->password),
        ]);

        $photo = $request->file('photo');

        if ($photo !== null) {
            $user->photo_alt = $request->photo_alt;
            $user->photo_extension = $photo->extension();
            $photo->storeAs(User::PATH_PREFIX, $user->photo_name);
        }

        $user->save();

        // @TB: This is an example.
        // Notification::send(User::all(), new UserCreated($user));

        return redirect("dashboard/users/{$user->id}/edit")->with([
            'alert.message' => 'New admin successfully created',
        ]);
    }

    public function show(User $user)
    {
        return view('dashboard.users.show')
            ->with('user', $user);
    }

    public function edit(User $user)
    {
        return view('dashboard.users.form', [
            'user' => $user,
            'method' => 'PATCH',
        ]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        // $user->photo_alt = $request->photo_alt;
        $photo = $request->file('photo');

        if ($photo !== null) {
            $user->photo_extension = $photo->extension();
            $photo->storeAs(User::PATH_PREFIX, $user->photo_name);
        }

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect("dashboard/users/{$user->id}/edit")->with([
            'alert.message' => 'Admin successfully updated',
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('dashboard/users')->with([
            'alert.context' => $context = 'warning',
            'alert.title' => trans("boilerplate.alert.{$context}.title"),
            'alert.message' => trans("boilerplate.alert.{$context}.message", [
                'action' => trans('boilerplate.actions.deleted'),
                'object' => trans('boilerplate.objects.user'),
            ]),
        ]);
    }
}
