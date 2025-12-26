<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/services', [MainController::class, 'services'])->name('services'); 
Route::get('/404', [MainController::class, 'notFound'])->name('notFound'); 
Route::get('/testimonial', [MainController::class, 'testimonial'])->name('testimonial'); 
Route::get('/team', [MainController::class, 'team'])->name('team'); 
Route::get('/feature', [MainController::class, 'feature'])->name('feature'); 

Route::middleware('auth')->group(function () {
    // Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);

    Route::resource('users', UserController::class);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/generate-token', function () {
        $user = \App\Models\User::find(1);
        $token = $user->createToken('MyToken')->plainTextToken;
        return response()->json(['token' => $token]);
    });


});

require __DIR__ . '/auth.php';
