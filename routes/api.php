<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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

// Route::get('/posts', [PostController::class, 'index'] );
// Route::post('/posts/{}', [PostController::class, 'store'] );

// Route::resource('users', UserPostController::class);

// Route::get('/users/search/{name}', [UserPostController::class, 'search']);



//Public routes
Route::post('/register', [RegisterController::class, 'store'] );
Route::get('/users', [UserController::class, 'index'] );
Route::get('/users/{id}', [UserController::class, 'show'] );
Route::get('/users/search/{name}', [UserController::class, 'search']);
Route::post('/login', [LoginController::class, 'store'] );
Route::get('/posts', [PostController::class, 'show']);
Route::post('/login', [LoginController::class, 'store'] );
Route::post('/users/{user:username}/posts', [UserPostController::class, 'store']);




//Protected routes

Route::post('/users', [UserController::class, 'store'] );
Route::put('/users/{id}', [UserController::class, 'update'] );
Route::delete('/users/{id}', [UserController::class, 'destroy'] );
Route::post('/logout', [LogoutController::class, 'store'] );
// Route::group(['middleware' => ['auth:sanctum']], function() {
// });




// Route::post('/users', function () {
//     return User::create([
//         'name' => 'Sebahattin',
//         'email' => 'sebahattinyarici@gmail.com',
//         'password' => '123456',
//         'username' => 'desmoines',
//     ]);
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
