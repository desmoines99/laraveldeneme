<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\ApiController;
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
Route::post('/register', [ApiController::class, 'register'] );
Route::get('/users', [UserController::class, 'index'] );
Route::get('/users/{id}', [UserController::class, 'show'] );
Route::get('/users/search/{name}', [UserController::class, 'search']);
Route::get('/posts', [ApiController::class, 'posts']);
Route::post('/login', [ApiController::class, 'login'] );
Route::post('/users/{user:username}/posts', [UserPostController::class, 'store']);




//Protected routes


Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/users/{user:id}/posts', [UserPostController::class, 'store']);
    Route::post('/posts/{post}/comments', [UserPostController::class, 'comment']);
    Route::post('/users', [UserController::class, 'store'] );
    Route::put('/users/{id}', [UserController::class, 'update'] );
    Route::put('/posts/{id}', [ApiController::class, 'updatepost']);
    Route::delete('/users/{id}', [ApiController::class, 'destroy'] );
    Route::post('/logout', [ApiController::class, 'logout'] );
});




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
