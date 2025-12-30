<?php

use App\Http\Controllers\AboutBigImageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\HeaderImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {

    Route::get('lang/{locale}', function ($locale) {
        if (! in_array($locale, ['en', 'uz', 'ru'])) {
            abort(400);
        }

        session(['locale' => $locale]);

        return redirect()->back();
    })->name('lang.switch');
});

Route::get('/', function () {
    if (auth()->check()) {
        return app(HomeController::class)->index();
    }

    return app(MainController::class)->index();
})->name('index');

// Route::get('/', [MainController::class, 'index'])->name('index');
Route::resource('abouts', AboutController::class);
Route::resource('services', ServiceController::class);
Route::resource('notfounds', NotFoundController::class);
Route::resource('testimonials', TestimonialController::class);
Route::resource('teams', TeamController::class);
Route::resource('features', FeatureController::class);
Route::resource('projects', ProjectController::class);
Route::resource('contacts', ContactController::class);

Route::middleware('auth')->group(function () {
    // Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);

    Route::resource('users', UserController::class);
    Route::resource('pages', PageController::class);
    Route::resource('headerimages', HeaderImageController::class);
    Route::resource('aboutbigimages', AboutBigImageController::class);


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
