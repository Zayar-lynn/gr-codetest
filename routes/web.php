<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MenuController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('login', [AuthController::class, 'login']);
Route::middleware('admin')->group(function(){
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('/', [Controller::class, 'dashboard']);

    Route::resource('menu', MenuController::class);
    Route::post('menu_update', [MenuController::class, 'update']);
});

Route::get('/login', ['middleware' => 'guest', function(){
    return view('admin.auth.login');
}]);