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

        $this->authorize("viewAny", Store::class);

        if (!session()->has("search")) {
            session()->put("search", null);
            session()->put("state", null);
        }

        try {

            $stores = Store::orderByDesc('created_at')
                ->filter(request()->only("search", "state"))
                ->paginate(20);

            return Inertia::render("Stores/Index", [
                "stores" => $stores,
                "filters" => session()->only(["search", "state"]),
            ]);

            // return Inertia::render("Stores/Index", [
            //     "stores" => Store::paginate(10)
            // ]);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    
    }

    public function create()
    {
        $this->authorize('create', Store::class);
        return Inertia::render('Stores/Create', [
            
        ]);
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
        $store->delete();
        return redirect()->route('stores.index')->with('success', 'Store deleted!');
    }

    public function restore(int $id)
    {
        $store = Store::withTrashed()->find($id);
        $this->authorize('restore', $store);
        return "Can Restore";
    }
}
