<?php

use App\Http\Middleware\CheckPermission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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



Route::namespace('\Frontend')->group(function() {
    Route::get('/', 'PublicController@index');
});


Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

if(is_dir(app_path("/TrusCRUD/Core"))) {
    //UserManagement Routes
    require_once app_path("/TrusCRUD/Core/routes.php");
}

Route::middleware(['auth', CheckPermission::class])->group(function() {
    require_once __DIR__ . '/app.php';
});
