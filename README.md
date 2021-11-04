# Laravel 8 Blog Example

The purpose of this repository is to show practices on Laravel 8 to build up a basic blog system. This system presents some features for users as:
- Register
- Login
- Post
    - Comment
    - Like/Dislike
    - Edit

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
    $ npm install
    $ php artisan vendor:publish
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
### Database

- After adjusting the database setting, we can run the migrations to create the tables.
```
$ php artisan migrate:fresh
```
   - 'migrate:refresh' reset and re-run all migrations to avoid the overlap datas.
**Before seeding**    
   ![](https://raw.githubusercontent.com/desmoines99/laraveldeneme/main/before%20seeding.png)
    

Seeding the database:
```
$ php artisan db:seed
```
Now our database is filled with fake 9 users, 100 articles and images randomly.In database we have a specific user  to experience the site via [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login "http://127.0.0.1:8000/login") with the informations where a enter on the below:

![](https://raw.githubusercontent.com/desmoines99/laraveldeneme/main/loginPage.png)

Of course you can register with your own information via [http://127.0.0.1:8000/register](http://127.0.0.1:8000/register "http://127.0.0.1:8000/register")

![](https://raw.githubusercontent.com/desmoines99/laraveldeneme/main/registerPage.png)

We can see all of them at the home page:

**After seeding as a guest** 
    ![](https://raw.githubusercontent.com/desmoines99/laraveldeneme/main/afterseedingAsAGuest.png)

### Screen Shots-What the user sees

**Home Page**![](http://127.0.0.1:8000/)
![](https://raw.githubusercontent.com/desmoines99/laraveldeneme/main/homepageAsUser.png)
    - At this page, user can write an article and it can upload any image about it.

**User Page**![](http://127.0.0.1:8000/users/{user:username}/posts)
![](https://raw.githubusercontent.com/desmoines99/laraveldeneme/main/userPage.png)
    - User/guest can be viewed the all article of any user and the interactions on this page. Just user is allowed to comment, like and dislike. 

**Post Page**![](http://127.0.0.1:8000/posts/{post:slug})
![](https://raw.githubusercontent.com/desmoines99/laraveldeneme/main/postPage.png)
    - This page can be reached by 'Read More' link, any visitor can be viewed the page.

**Edit Page**![](http://127.0.0.1:8000//posts/{post:slug}/edit)
![](https://raw.githubusercontent.com/desmoines99/laraveldeneme/main/editPage.png)
    - This page can be reached by 'Edit' link where it is below the article, only user has access the link and can see.



### Permissions
- Author/User
	- Can post a article with image, title and composition.
	- Can comment, like and dislike for all posts.
	- Can delete the  own actions what it can do on the above.
	- Can see the all posts with their interactions.
- Guest
	- Can see the all posts with their interactions.

### Web Routes
| Method of Route  | URl  | Controller  |  Method of Controller |
| ------------ | ------------ | ------------ | ------------ |
| get  | /users/{user:username}/posts  | UserPostController  | index  |
| post  | /logout  | LogoutController  | store  |
|  get | /login  | LoginController  | index  |
| post  | /login  | LoginController  | store  |
|  get | /register  | RegisterController  | index  |
| post  | /register  | RegisterController  | store  |
| get  | /  | PostController  | index  |
| get  | /posts/{post:slug}  | PostController  | show  |
| post  | /  | PostController  | post  |
| get  | /posts/{post:slug}/edit  | PostController  | edit  |
| put  | /posts/{post:slug}  | PostController  | update  |
| delete  | /posts/{post}  | PostController  | destroy  |
| post  | /posts/{post}/comments  | CommentController  | store  |
| delete  | /comments/{comment}  | CommentController  | destroy  |
| post |  /posts/{post}/likes | PostLikeController  | store  |
| delete  | /posts/{post}/likes  | PostLikeController  | destroy  |
| post | /posts/{post}/dislikes  | PostDislikeController | store |
| delete  |  /posts/{post}/dislikes | PostDislikeController  | destroy  |



### Rest API Applications
- In the code, there is some API functions to ready to use. Postman can send request and receive responses by HTTP protocol methos like GET, POST, PUT and DELETE. I got good results with Postman but you can use another applications.

#### Public Routes
| Method of Route  | URl  | Controller  |  Method of Controller |
| ------------ | ------------ | ------------ | ------------ |
| post | /register  | ApiController  | register  |
| get | /users  | UserController  | index  |
| get | /users/{id} |  UserController | show  |
| get |  /users/search/{name} | UserController  | search  |
| get | /posts  | ApiController  | posts  |
| post | /login  | ApiController  |  login |
| post | /users/{user:username}/posts | UserPostController | store  |


##### Protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {

| Method of Route  | URl  | Controller  |  Method of Controller |
| ------------ | ------------ | ------------ | ------------ |
| post | /users/{user:id}/posts  | UserPostController:  | store  |
| post | /posts/{post}/comments  | UserPostController:  | comment  |
| post | /users |  UserController | store  |
| put |  /users/{id | UserController  | update  |
| put | /posts/{id} | ApiController  | updatepost  |
| delete | /users/{id}  | ApiController  | destroy |
| post | /logout | ApiControllerr | logout  |


As we can see on the above some routes are protected and it means, other users cannot send request instead of others. REST API using auth tokens with Laravel Sanctum ,which is package and you can reach more infos via [https://laravel.com/docs/8.x/sanctum](https://laravel.com/docs/8.x/sanctum), in protected routes. 


### Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
