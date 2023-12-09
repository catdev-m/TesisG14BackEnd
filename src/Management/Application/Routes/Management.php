<?php

use Illuminate\Support\Facades\Route;
use Memories\Management\Application\Controllers\MenuController;
use Memories\Management\Application\Controllers\PermissionController;
use Memories\Management\Application\Controllers\RolController;
use Memories\Management\Application\Controllers\UserController;

Route::get('/roles',[RolController::class,'listRoles']);
Route::post('/roles',[RolController::class,'createRol']);
Route::post('/roles/{rolId}',[RolController::class,'updateRol']);
Route::get('/roles/{rolId}/menus',[MenuController::class,'getMenusByRol']);
Route::post('/roles/{rolId}/menus',[RolController::class,'addMenuForRol']);
Route::delete('/roles/{rolId}/menus',[RolController::class,'removeMenuForRol']);

Route::get('/menus',[MenuController::class,'getAll']);
Route::get('/permissions',[PermissionController::class,'fetchAll']);

Route::get('/roles/{rolCode}/permissions',[PermissionController::class,'searchRolPermissions']);
Route::post('/roles/{rolCode}/permissions',[PermissionController::class,'addPermissionToRol']);
Route::delete('/roles/{rolCode}/permissions',[PermissionController::class,'removePermissionFromRol']);

Route::prefix('/users')->group(function(){
    Route::get('',[UserController::class,'fetchAllUsers']);
    Route::post('',[UserController::class,'fetchAllUsers']);
    Route::get('/{userId}',[UserController::class,'getUser']);
    Route::post('/{userId}',[UserController::class,'updateUser']);

    Route::post('/{userId}/roles',[UserController::class,'addRolToUser']);
    Route::delete('/{userId}/roles',[UserController::class,'removeRolOfUser']);
    Route::get('/{userId}/roles',[UserController::class,'fetchRolesByUser']);
});
