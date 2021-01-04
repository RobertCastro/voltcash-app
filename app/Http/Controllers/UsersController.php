<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
            return Inertia::render("Users/Index", [
                "users" => User::paginate(10)
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create()
    {
        $this->authorize('create', User::class);
        return "Can Create";
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
        $this->authorize('delete', $user);
        return "Can Delete";
    }

    public function restore(int $id)
    {
        $user = User::withTrashed()->find($id);
        $this->authorize('restore', $user);
        return "Can Restore";
    }
}
