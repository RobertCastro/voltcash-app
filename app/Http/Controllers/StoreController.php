<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function __construct() {

        $this->middleware("auth");

    }

    /**
     * 
     * @throws AutorizationException
     */

    public function index() {

        try {

            $this->authorize("viewAny", Store::class);
            return Inertia::render("Stores/Index", [
                "stores" => Store::withTrashed()->paginate(10)
            ]);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    
    }

    public function create()
    {
        $this->authorize('create', Store::class);
        return "Can Create";
    }

    public function show(Store $store)
    {
        $this->authorize('view', $store);
        return "Can Show";
    }

    public function edit(Store $store)
    {
        $this->authorize('update', $store);
        return "Can Edit";
    }

    public function update(Request $request, Store $store)
    {
        $this->authorize('update', $store);
        return "Can Update";
    }

    public function destroy(Store $store)
    {
        $this->authorize('delete', $store);
        return "Can Delete";
    }

    public function restore(int $id)
    {
        $store = Store::withTrashed()->find($id);
        $this->authorize('restore', $store);
        return "Can Restore";
    }
}
