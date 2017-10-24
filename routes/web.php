<?php

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


Route::get('/', 'UserController@ind');

Auth::routes();

# USER ROUTES
Route::get('sign-in', 'SigninController@getLog')->name('accounts.sign-in');
Route::post('sign-in', 'SigninController@postLog');
# user reg
Route::get('sign-up', 'SignupController@getReg')->name('accounts.sign-up');
Route::post('sign-up', 'SignupController@postReg');
Route::get('new-post/create', 'HomeController@getNewPost')->name('gitblog.new-post');
Route::post('new-post/create', 'HomeController@submitNewPost');
Route::get('/posts/{posts}/', 'UserController@showPostByID');
Route::post('/posts/{post}/comments', 'UserController@storeComment')->name('comments');
Route::get('/posts/tags/{tags}/', 'TagController@indexByTags');
Route::get('/update-post/{id}/', 'HomeController@getEditNewPost')->name('gitblog.update-post');
Route::post('/update-post', [
		'uses' => 'HomeController@postEditNewPost',
		'as' => 'gitblog.update-post'
	]);

Route::get('delete-post/{id}', [
		'uses' => 'HomeController@PostDelete',
		'as' => 'gitblog.delete-post'
	]);

Route::get('/posts/{posts}/like', 'UserController@profileLike')->name('like');
Route::get('/posts/{posts}/unlike', 'UserController@profileUnLike')->name('unlike');


Route::get('/user-profile', 'HomeController@userProfile')->name('gitblog.user-profile');

# USER AND ADMIN ROUTES
Route::post('update-profile-picture', 'AdminController@profile_picture');


# ADMIN ROUTES
Route::get('profile', 'AdminController@profile')->name('admin.profile');
Route::get('create-post', 'AdminController@getCreatePost')->name('admin.create-post');
Route::post('create-post', 'AdminController@submitCreatePost');
Route::get('admin-register/werbrtyrsequew/ntui', 'AdminController@admin_reg')->name('auth.admin-register');
Route::post('admin-register/post-werbrtyrsequew/ntui', 'AdminController@p_admin_reg')->name('auth.a_register');
Route::get('admin-signin', 'AdminController@showLoginForm')->name('auth.signin');
Route::post('admin-signin', 'AdminController@login');
Route::get('manage-users', 'AdminController@manageUsers');
Route::get('post-delete/{id}', [
		'uses' => 'AdminController@DeletePost',
		'as' => 'admin.post-delete'
	]);
Route::get('/admin-update-post/{id}/', 'AdminController@getUpdatePost')->name('admin.admin-update-post');
Route::post('/admin-update-post', [
		'uses' => 'AdminController@postUpdatePost',
		'as' => 'admin.admin-update-post'
	]);
Route::get('delete-user/{id}', [
		'uses' => 'AdminController@deleteUser',
		'as' => 'admin.delete-user'
	]);



Route::get('/register', function () {
	return redirect()->to(url('/'));
});


Route::get('/login', ['as' => 'login', 'uses' => function () {
	return redirect()->to(url('/sign-in'))->with('danger', 'You must login to access the requested page');
}]);

