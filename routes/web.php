<?php

use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['can:accounts'])->group(function () {
        Route::resource('users', UsersController::class);
        Route::post('users/table', [UsersController::class, 'table'])->name('users.table');
        Route::post('users/assign/Role', [UsersController::class, 'assignRole'])->name('assign.role');
        Route::post('users/reset/pass', [UsersController::class, 'resetPass'])->name('users.reset.pass');
    });

    Route::middleware(['can:roles'])->group(function () {
        Route::resource('roles', RolesController::class);
        Route::post('roles/table', [RolesController::class, 'table'])->name('roles.table');
        Route::get('roles/abilities/{name}', [RolesController::class, 'abilities'])->name('roles.abilities');
        Route::post('roles/save/abiltiies', [RolesController::class, 'saveAbilities'])->name('abilities.save');
    });
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
