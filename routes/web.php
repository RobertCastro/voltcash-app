<?php

use App\Http\Controllers\StoreController;
use App\Http\Controllers\UsersController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("/login");
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia\Inertia::render('Dashboard');
// })->name('dashboard');

Route::group(["middleware" => ['auth:sanctum', 'verified']], function () {

    Route::put("stores/{store}/restore", [StoreController::class, "restore"])->name("stores.restore");;
    Route::resource("stores", StoreController::class);

    Route::resource("users", UsersController::class);
    
});


