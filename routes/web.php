<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\AdminCategoryController;
use App\Http\Controllers\admin\AdminTagController;
use App\Http\Controllers\admin\AdminPostController;
use App\Http\Controllers\author\AuthorPostController;
use App\Http\Controllers\author\AuthorProfileController;
use App\Http\Controllers\SubscriberController;

//Useing Route
/* Route::get('/', function () {
    return view('welcome');
})->name('homepage'); */

//User
Route::get('/', [UserController::class, 'index'])->name('homepage');
Route::get('/single-blog/{id}', [UserController::class, 'singleBlog'])->name('user.single-blog');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('auth/login', [LoginController::class, 'login'])->name('login.custom');

Route::group(['middleware' => ['auth']], function () {

    //Redirect Dashboard
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/superadmin', [LoginController::class, 'superAdminDashboard'])->name('superadmin.dashboard');
        Route::get('/admin', [LoginController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/author', [LoginController::class, 'authorDashboard'])->name('author.dashboard');
        Route::get('/user', [LoginController::class, 'userDashboard'])->name('user.dashboard');
    });

    //admin
    Route::prefix('admin')->group(function () {
        //admin category
        Route::get('/category', [AdminCategoryController::class, 'index1'])->name('admin.category.all');
        Route::get('/category/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/category/create', [AdminCategoryController::class, 'createPost'])->name('admin.category.create');
        Route::get('/category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/category/edit/{id}', [AdminCategoryController::class, 'editPost'])->name('admin.category.edit');
        Route::post('/category/delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
        Route::get('/category/details/{id}', [AdminCategoryController::class, 'details'])->name('admin.category.details');
        //admin Tag
        Route::get('/tag', [AdminTagController::class, 'index'])->name('admin.tags.all');
        Route::get('/tag/create', [AdminTagController::class, 'create'])->name('admin.tag.create');
        Route::post('/tag/create', [AdminTagController::class, 'createPost'])->name('admin.tag.create');
        Route::get('/tag/edit/{id}', [AdminTagController::class, 'edit'])->name('admin.tag.edit');
        Route::post('/tag/edit/{id}', [AdminTagController::class, 'editPost'])->name('admin.tag.edit');
        Route::post('/tag/delete/{id}', [AdminTagController::class, 'delete'])->name('admin.tag.delete');
        Route::get('/tag/details/{id}', [AdminTagController::class, 'details'])->name('admin.tag.details');
        //admin post
        Route::get('/posts', [AdminPostController::class, 'index'])->name('admin.posts.all');
        Route::get('/post/create', [AdminPostController::class, 'create'])->name('admin.post.create');
        Route::post('/post/create', [AdminPostController::class, 'createPost'])->name('admin.post.create');
        Route::get('/post/edit/{id}', [AdminPostController::class, 'edit'])->name('admin.post.edit');
        Route::post('/post/edit/{id}', [AdminPostController::class, 'editPost'])->name('admin.post.edit');
        Route::post('/post/delete/{id}', [AdminPostController::class, 'delete'])->name('admin.post.delete');
        Route::get('/post/details/{id}', [AdminPostController::class, 'details'])->name('admin.post.details');
    });


    //Super Admin
    Route::prefix('superadmin')->group(function () {

        //Categories
        Route::resource('category', CategoryController::class);
        Route::get('/categories/unpublished', [CategoryController::class, 'unpublishedCategory'])->name('category.unpublished');
        Route::get('/category/publish/{id}', [CategoryController::class, 'publish'])->name('category.publish');
        Route::get('/category/hide/{id}', [CategoryController::class, 'hide'])->name('category.hide');
        
        //Posts
        Route::resource('post', PostController::class);
        Route::get('/destroy/{id}', [PostController::class, 'destroy'])->name('post.delete');
        Route::get('/publish/{id}', [PostController::class, 'publish'])->name('post.publish');
        Route::get('/hide/{id}', [PostController::class, 'hide'])->name('post.hide');
        Route::post('/content/file', [PostController::class, 'fileUpload'])->name('post.content_file');
        Route::get('/posts/singleuser', [PostController::class, 'getAllPostBySuperAdmin'])->name('superadmin.post.singleuser');

        //Profile
        Route::prefix('profile')->group(function () {
            Route::resource('user', SuperAdminController::class);
            Route::post('/profile', [SuperAdminController::class, 'updateProfile']);
            Route::get('/superadmin/password/change', [SuperAdminController::class, 'getPassword'])->name('profile.passChange');
            Route::post('/superadmin/password/change', [SuperAdminController::class, 'updatePassword'])->name('password.update');
        });

        //User Manage
        Route::prefix('user')->group(function () {
            Route::resource('manage', UserManageController::class);
            Route::get('/role/manage', [UserManageController::class, 'getAllRoles'])->name('role.manage');
            Route::get('/deactive', [UserManageController::class, 'getAllDeactiveUsers'])->name('user.deactive');
            Route::get('/change/deactive/{id}', [UserManageController::class, 'activeToDeactive'])->name('activeuser.deactive');
            Route::get('/change/active/{id}', [UserManageController::class, 'deactiveToActive'])->name('deactiveuser.active');

            //request
            Route::get('/request', [UserManageController::class, 'requestUserHandle'])->name('request.user');
            Route::get('/request/show/{id}', [UserManageController::class, 'requestDetailsShow'])->name('user.request.show');
            Route::get('/request/accept/{id}', [UserManageController::class, 'requestUserAccept'])->name('user.request.accept');
        });

        //Subscriber
        Route::prefix('manage')->group(function(){ 
            Route::resource('subscriber', SubscriberController::class);
        });
    });
	
	  
	  
	   //Author Area
    Route::prefix('author')->group( function () {

        //Author Profile
        Route::get('/profile',[AuthorProfileController::class,'view_profile'])->name('AuthorProfileController.view_profile');
        Route::post('/profile',[AuthorProfileController::class,'save_profile'])->name('AuthorProfileController.save_profile');
        Route::get('/add_post',[AuthorPostController::class,'add_post'])->name('AuthorPostController.add_post');
        
        //Author Post
        Route::get('/edit_post/{id}',[AuthorPostController::class,'get_edit_post'])->name('AuthorPostController.get_edit_post');
        Route::post('/update_post/{id}',[AuthorPostController::class,'update_post'])->name('AuthorPostController.update_post');
        Route::post('/store_new_post',[AuthorPostController::class,'store_new_post'])->name('AuthorPostController.store_new_post');
        Route::get('/view_all_post',[AuthorPostController::class,'all_post_show'])->name('AuthorPostController.all_post_show');
        Route::get('/view_all_unpublished_post',[AuthorPostController::class,'view_all_unpublished_post'])->name('AuthorPostController.view_all_unpublished_post');
        Route::get('/preview/post/{id}',[AuthorPostController::class,'preview'])->name('AuthorPostController.preview');
    
    
    });
	
	
	      
});



