<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {

        $this->middleware("auth");
    }

    /**
     * 
     * @throws AutorizationException
     */

    public function index()
    {

        try {

            $this->authorize("viewAny", User::class);

            $users = User::whereHas('roles', function ($q) {
                $q
                ->Where('name', 'Administrator')
                ->orWhere('name', 'Seller')
                ->orWhere('name', 'Compliance');
            })
            // ->where('active_status', 1)
            ->paginate(20);

            return Inertia::render("Users/Index", [
                "users" => $users
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store()
    {
        // $this->authorize('create', User::class);
        $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'rol' => ['required'],
        ]);
        
        try {
            $user = User::create(request([
                'name',
                'email',
                'password',
                'created_at' => date("Y-m-d H:i:s")
            ]));

            $user->roles()->attach(Role::where('name', request('rol'))->first());

            return redirect()->route('users.index')->with('success', 'User created!');
        } catch (\Throwable $th) {
            throw $th;
        }

        
        
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return "Can Show";
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return "Can Edit";
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        return "Can Update";
    }

    public function destroy(User $user)
    {
        // $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted!');
    }

    public function restore(int $id)
    {
        $user = User::withTrashed()->find($id);
        $this->authorize('restore', $user);
        return "Can Restore";
    }

}
