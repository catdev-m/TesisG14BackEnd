<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('auth')->group(base_path('src\Auth\Application\Routes\Auth.php'));
Route::prefix('admin')->group(base_path('src\Management\Application\Routes\Management.php'));
Route::prefix('org')->group(base_path('src\Organization\Application\Routes\Organization.php'));

