<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientsController;

use App\Http\Controllers\UsersController;

Route::get('/users', [UsersController::class, 'index']);

Route::get('/users/{id}', [UsersController::class, 'show']);

Route::post('/users', [UsersController::class, 'store']);

Route::put('/users/{id}', [UsersController::class, 'update']);

Route::patch('/users/{id}', [UsersController::class, 'updatePartial']);

Route::delete('/users/{id}', [UsersController::class, 'destroy']);

Route::post('/userslogin', [UsersController::class, 'login']);
//

Route::get('/clients', [ClientsController::class, 'index']);

Route::get('/clients/{id}',[ClientsController::class, 'show']);

Route::post('/clients', [ClientsController::class, 'store']);

Route::put('/clients/{id}', [ClientsController::class, 'update']);

Route::patch('/clients/{id}', [ClientsController::class, 'updatePartial']);

Route::delete('/clients/{id}', [ClientsController::class, 'destroy']);