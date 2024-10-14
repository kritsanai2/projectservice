<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;

/*
|-------------------------------------------------------------------------- 
| API Routes 
|-------------------------------------------------------------------------- 
| 
| Here is where you can register API routes for your application. These 
| routes are loaded by the RouteServiceProvider within a group which 
| is assigned the "api" middleware group. Enjoy building your API! 
| 
*/

// Routes for Movie resource (public access)
Route::get('/movies', [MovieController::class, 'index']); // Get all movies
Route::post('/movies', [MovieController::class, 'store']); // Create a new movie
Route::get('/movies/{id}', [MovieController::class, 'show']); // Get a specific movie by ID
Route::put('/movies/{id}', [MovieController::class, 'update']); // Update a specific movie by ID
Route::delete('/movies/{id}', [MovieController::class, 'destroy']); // Delete a specific movie by ID

// Route for login
Route::post('login', [AuthController::class, 'login']);

// Protected routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    }); // Route for getting the authenticated user
    Route::resource('movies', MovieController::class)->except(['index', 'store', 'show']); // Only use resource methods that require authentication
    Route::post('logout', [AuthController::class, 'logout']); // Logout route
});
