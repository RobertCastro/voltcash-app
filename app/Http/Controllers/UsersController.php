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

        if (!session()->has("search")) {
            session()->put("search", null);
            session()->put("roles", null);
        }

        try {

            // $this->authorize("viewAny", User::class);

            $users = User::whereHas('roles', function ($q) {
                $q
                ->Where('name', 'Administrator')
                ->orWhere('name', 'Seller')
                ->orWhere('name', 'Compliance');
            })
            // ->where('active_status', 1)
            ->orderByDesc("id")
            ->filter(request()->only("search", "roles"))
            ->paginate(20);

            return Inertia::render("Users/Index", [
                "users" => $users,
                "filters" => session()->only(["search", "roles"]),
            ]);

            // return Inertia::render("Projects/Index", [
            //     "filters" => session()->only(["search", "trashed"]),
            //     "users" => Project::with("user")
            //     ->orderByDesc("id")
            //     ->filter(request()->only("search", "trashed"))
            //     ->paginate(5),
            // ]);

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
            'phone' => ['required', 'numeric', 'min:8'],
            'password' => ['required', 'string', 'min:8'],
            'rol' => ['required'],
        ]);
        
        try {
            $user = User::create(request([
                'name',
                'email',
                'phone',
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
        // $this->authorize('view', $user);
        return "Can Show";
    }

    public function edit(User $user)
    {
        
    }

    public function update(Request $request, User $user)
    {
        // $this->authorize('update', $user);
        $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric', 'min:8'],
            'password' => ['nullable', 'string', 'min:8'],
            'rol' => ['required'],
        ]);


        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->password != '') {
            $user->password = $request->password;
        }

        $user->save();
        // $user->roles()->attach(1);

        return redirect()->route('users.index')->with('success', 'User update');

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
