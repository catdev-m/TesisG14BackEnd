<?php
use Illuminate\Support\Facades\Route;
use Memories\Organization\Application\Controllers\FacultyController;

Route::prefix('/faculties')->group(function(){
    Route::get('',[FacultyController::class,'fetchFaculties']);
    Route::post('',[FacultyController::class,'createFaculty']);
    Route::post('/{facultyId}',[FacultyController::class,'updateFaculty']);
});
