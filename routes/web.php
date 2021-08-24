<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PostDislikeController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function(){
//     return view('home');
// })->name('home');




// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->name('dashboard');

 Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');
   
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
 Route::post('/', [PostController::class, 'store'])->name('post');
//  Route::post('/posts', [PostController::class, ''])->name('post');


Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Route::get('/comments', [CommentController::class, 'index'])->name('comments');
// Route::get('/posts/{post}/comments', [CommentController::class, 'index'])->name('comments.show');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('likes.destory');

Route::post('/posts/{post}/dislikes', [PostDislikeController::class, 'store'])->name('posts.dislikes');
Route::delete('/posts/{post}/dislikes', [PostDislikeController::class, 'destroy'])->name('dislikes.destory');


// 