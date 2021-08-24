# Laravel 8 Blog Example

The purpose of this repository is to show practices on Laravel 8 to build up a basic blog system. This system presents some features for users as ;
- Register
- Login
- Post
- Comment

### Installation

Firstly you should download xampp via [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html).

While running the appplication, I recommend to Run as Administrator. In the app, start the Apache and MySQL modules .


- Setting up your development environment on your local machine :
	1.  Go to htdocs folder in the xampp.
	2.  Open the powershell via **shift+right click** and click to Open PowerShell window here.
	3. Then enter the commands on the below:
    ```	
    $ git clone https://github.com/desmoines99/laraveldeneme.git
    $ cd laraveldeneme
    $ composer install 
    $ php artisan serve
    ```

- After following commands you can access the website via [http://localhost:8000](http://localhost:8000).

- Setup your database settings in the .env file 

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laraveldeneme
DB_USERNAME=root
DB_PASSWORD=
```
###Database

- After adjusting the database setting, we can run the migrations to create the tables.
```
$ php artisan migrate:fresh
```
'migrate:refresh ' reset and re-run all migrations to avoid the overlap datas.

###Permissions
- Author/User
	- Can post a article with image, title and composition
	- Can comment, like and dislike for all posts
	- Can delete the actions what it can do on the above
- Guest
	- Can see the all posts with their interactions.

###Rest Api Applications
- In the code, there is some API functions to ready to use. Postman can send request and receive responses by HTTP protocol methos like GET, POST, PUT and DELETE. I got good results with Postman but you can use another applications.

```
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
```
As we can see on the above some routes are protected and it means, other users cannot send request instead of others. REST API using auth tokens with Laravel Sanctum ,which is package and you can reach more infos via [http://https://laravel.com/docs/8.x/sanctum](http://https://laravel.com/docs/8.x/sanctum), in protected routes. 


## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
