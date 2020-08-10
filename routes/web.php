<?php

use Illuminate\Support\Facades\Route;

use App\User;
use App\Role;
use App\Category;
use App\Post;
use App\Company;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Events\PusherCommentApprovedEvent;
use Illuminate\Support\Facades\URL;

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

Route::get('/', 'HomeController@index' )->name('home');

//get all posts
Route::get('/posts', 'HomeController@posts' )->name('home.posts');
//single post
Route::get('/post/{post:slug}', 'HomeController@post' )->name('home.post');
//get post under category
Route::get('/category/{category:name}/post', 'HomeController@category' )->name('home.category');
//get post under author
Route::get('/user/{user}/post', 'HomeController@user_post' )->name('home.user.post');
//get post under TAG
Route::get('/tag/{tag:name}/post', 'HomeController@tag' )->name('home.tag');

//get all company
Route::get('/companies', 'CompanyController@index' )->name('home.companies');
//view single company
Route::get('/company/{company}', 'CompanyController@show' )->name('home.companies.show');

//get all news
Route::get('/news', 'HomeController@news' )->name('home.news');

//get single news
Route::get('/news/{news:slug}', 'HomeController@news_show' )->name('home.news.show');

//get all tips
Route::get('/tips', 'HomeController@tips' )->name('home.tips');

Route::get('/gallery', 'HomeController@gallery' )->name('home.gallery');
Route::get('/video', 'HomeController@video' )->name('home.video');



//handle search query
Route::get('/search', 'HomeController@search' )->name('home.search');




Route::get('/ajax/search', 'HomeController@ajax_search' )->name('home.ajax_search');

Route::get('/test', function(){



});

Route::get('/test2', function(){

echo  phpinfo();  

});


// user route
Route::get('/user/register', 'UserController@create_register')->name('create_register');
Route::post('/user/register', 'UserController@store_register')->name('store_register');


Route::get('/validation/{user}', 'UserController@verify')->name('verify');


Route::get('/user/login', 'UserController@login')->name('login');
Route::post('/user/login_process', 'UserController@login_process')->name('login_process');

Route::post('/user/require_verification', 'UserController@resend_veirification_email')
->name('user.resend_veirification_email');

////////////////////////////////////////////////////////////RESET PASSWORD////////////////////////////
 Route::middleware(['guest'])->group(function () {

	Route::get('/user/forgetpassword', 'UserController@forget_password')->name('user.forget_password');
	Route::POST('/user/resetpassword', 'UserController@reset_password')->name('user.reset_password');
	Route::get('/user/password_verify/{token}/{email}', 'UserController@password_verify')->name('user.password_verify');
	Route::PATCH('/user/reset_user_password', 'UserController@reset_user_password')->name('user.reset_user_password');
});
///////////////////////////////////////////////////////////RESET PASSWORD////////////////////////////



Route::middleware(['auth'])->group(function () {

	Route::get('/user/logout', 'UserController@logout')->name('logout');
	Route::get('/user', 'UserController@index')->name('user_profile');
	Route::PATCH('/user/update/{user}', 'UserController@update')->name('update_user_profile');
	Route::PATCH('/user/update_pss/{user}', 'UserController@update_user_password')->name('update_user_password');


	Route::POST('/user/company/store', 'CompanyController@store')->name('user.company.store');

	Route::GET('/user/notification/markAllAsRead', 'UserController@markAllAsRead')->name('user.notification.markAllAsRead');

	Route::GET('/user/notification/{id}/markAsRead', 'UserController@markAsRead')->name('user.notification.markAsRead');

	Route::POST('/post/{post:slug}/comment/store', 'CommentController@store')->name('post.comment.store');
	Route::delete('/post/comment/{comment}', 'CommentController@destroy')->name('post.comment.destroy');
	Route::PATCH('/post/comment/{comment}', 'CommentController@update')->name('post.comment.update');


	Route::get('/home-post', 'PostController@index')->name('home.post.all');
	Route::get('/home-post/create', 'PostController@create')->name('home.post.create');
	Route::get('/home-post/edit/{post}', 'PostController@edit')->name('home.post.edit');
	Route::POST('/home-post/store', 'PostController@store')->name('home.post.store');
	Route::PATCH('/home-post/update/{post}', 'PostController@update')->name('home.post.update');

	Route::POST('/post2/create/upload_image', 'AdminPostController@upload_image')->name('post.upload_image');

});



Route::middleware(['auth','baseUserNotAllow'])->group(function () {

	Route::get('superadmin/dashboard','AdminDashboardController@index')->name('admin_dashboard');
	Route::get('superadmin/comment','CommentController@index')->name('admin_comment');
    Route::resource('superadmin/admin_user','AdminUserController');
	Route::resource('superadmin/news','NewsController');
	Route::resource('superadmin/category','CategoryController');
	Route::resource('superadmin/tip','TipController');
	Route::resource('superadmin/post','AdminPostController');
	Route::get('superadmin/admin_trash_post','AdminPostController@trash_post')->name('admin_trash_post');
	Route::delete('superadmin/delete_trash_post/{id}','AdminPostController@force_destroy')->name('delete_trash_post');
	Route::put('superadmin/restore_trash_post/{id}','AdminPostController@restore_trash_post')->name('restore_trash_post');

	Route::resource('superadmin/gallery','AdminGalleryController');
	Route::resource('superadmin/video','VideoController');

	Route::post('superadmin/approval','AdminApprovalController@index')->name('admin_approval_action');

	Route::get('superadmin/page/home', 'PageController@editHome' )->name('page.home.edit');
	Route::PATCH('superadmin/page/home/{HomePage}', 'PageController@updateHome' )->name('page.home.update');

	Route::PATCH('superadmin/page/home/changetodefaultimage/{HomePage}', 'PageController@ChangeHomeImage' )->name('page.home.changetodefaultimage');

	Route::get('superadmin/company/admin_create','CompanyController@admin_create')->name('admin.company.create');
	Route::post('superadmin/company/admin_store','CompanyController@admin_store')->name('admin.company.store');

	Route::get('superadmin/company/admin_edit/{company}','CompanyController@admin_edit')->name('admin.company.edit');
	Route::patch('superadmin/company/admin_update/{company}','CompanyController@admin_update')->name('admin.company.update');

	Route::get('superadmin/company','CompanyController@all_company')->name('admin.company.all_company');
	Route::delete('superadmin/company/{company}','CompanyController@destroy')->name('admin.company.destroy');

	//preview unapproved post
	Route::get('/preview/{post:slug}', 'PreviewController@post' )->name('preview.post');
});






//Auth::routes(['verify' => true]);
//Route::get('/home', 'HomeController@index')->name('home');
