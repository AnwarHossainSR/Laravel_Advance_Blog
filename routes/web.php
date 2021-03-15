<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

//All Users Accessible
use App\Http\Controllers\AllUser\FavoriteController;
//superAdmin
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\user\UserCommentController;
//admin
use App\Http\Controllers\admin\AdminCategoryController;
use App\Http\Controllers\admin\AdminTagController;
use App\Http\Controllers\admin\AdminPostController;
use App\Http\Controllers\admin\ProfileController;
//author
use App\Http\Controllers\author\AuthorPostController;
use App\Http\Controllers\author\AuthorProfileController;
use App\Http\Controllers\CommentController;
//user
use App\Http\Controllers\user\UserHomeController;
use App\Http\Controllers\user\UserSubscriberController;
use App\Http\Controllers\user\UserProfileController;
use App\Http\Controllers\user\UserCategoryController;
use App\Http\Controllers\user\UserPostController;


//User area
Route::get('/', [UserHomeController::class, 'index'])->name('homepage');
Route::prefix('home')->group(function () {
    Route::get('/single-blog/{id}', [UserHomeController::class, 'singleBlog'])->name('user.single-blog');
    Route::post('/subscriber', [UserSubscriberController::class, 'subscriberStore'])->name('user.subscriber');

    Route::get('/single-author/{id}', [UserProfileController::class, 'AuthorProfile'])->name('user.single-author');
    Route::get('/posts/category/{id}', [UserCategoryController::class, 'PostByCategory'])->name('user.category-post');

});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('auth/login', [LoginController::class, 'login'])->name('login.custom');

Route::group(['middleware' => ['auth']], function () {

    //All Users Accessible
    Route::group(['prefix' => 'home'], function () {
        Route::get('/favorite/{post}/add', [FavoriteController::class, 'add'])->name('post.favorite');
        Route::post('/comment/{post}', [UserCommentController::class, 'Store'])->name('comment.store');

        Route::get('/user/profile', [UserProfileController::class, 'index'])->name('user.profile');
        Route::post('user/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');

        Route::get('user/posts/favourite', [UserPostController::class, 'favourite'])->name('user.posts.favourite');
    });

    //Redirect Dashboard
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/superadmin', [LoginController::class, 'superAdminDashboard'])->name('superadmin.dashboard');
        Route::get('/admin', [LoginController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/author', [LoginController::class, 'authorDashboard'])->name('author.dashboard');
        Route::get('/user', [LoginController::class, 'userDashboard'])->name('user.dashboard');
    });

    //admin area
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
        Route::get('/posts/search', [AdminPostController::class, 'search'])->name('admin.posts.search');
        Route::get('/posts/own', [AdminPostController::class, 'ownindex'])->name('admin.posts.own');
        Route::get('/posts/favourite', [AdminPostController::class, 'favourite'])->name('admin.posts.favourite');
        Route::post('/posts/favourite/remove/{id}', [AdminPostController::class, 'favouriteRemove'])->name('admin.posts.favourite.remove');
        Route::get('/post/create', [AdminPostController::class, 'create'])->name('admin.post.create');
        Route::post('/post/create', [AdminPostController::class, 'createPost'])->name('admin.post.create');
        Route::get('/post/edit/{id}', [AdminPostController::class, 'edit'])->name('admin.post.edit');
        Route::post('/post/edit/{id}', [AdminPostController::class, 'editPost'])->name('admin.post.edit');
        Route::post('/post/delete/{id}', [AdminPostController::class, 'delete'])->name('admin.post.delete');
        Route::get('/post/details/{id}', [AdminPostController::class, 'details'])->name('admin.post.details');
        Route::get('/post/pending', [AdminPostController::class, 'pending'])->name('admin.posts.pending');
        Route::get('/post/pending/approve/{id}', [AdminPostController::class, 'approve'])->name('admin.posts.approve');
        Route::post('/post/pending/deny/{id}', [AdminPostController::class, 'deny'])->name('admin.posts.deny');
        Route::get('/post/pending/details/{id}', [AdminPostController::class, 'pendingDetails'])->name('admin.posts.pending.details');
        //admin profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    });

    //Super Admin Area
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
        Route::get('/deleted/posts', [PostController::class,'getDeletedPost'])->name('softdelete.post');
        Route::get('/deleted/post/restore/{id}', [PostController::class,'restoreDeletedPost'])->name('softdelete.restore');
        Route::get('/post/delete/permanent/{id}', [PostController::class,'postDeletePermanent'])->name('permanent.post.delete');
        Route::get('/posts/favorite', [PostController::class,'getFevoritePost'])->name('superadmin.post.favorite');

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
            Route::get('/request/cancell/{id}', [UserManageController::class, 'requestUserCancell'])->name('user.request.cancell');
        });

        //Subscriber
        Route::prefix('manage')->group(function () {
            Route::resource('subscriber', SubscriberController::class);
            Route::get('/sendnews', [SubscriberController::class, 'sendNewsToSubscriber'])->name('subscriber.email.show');
        });

        //Emailing
        Route::prefix('dashboard')->group(function(){
            Route::resource('email', EmailController::class);
        });

        //comments
        Route::resource('comment', CommentController::class);
        Route::get('comments/self', [CommentController::class,'commentsByMe'])->name('comments.self');
    });



    //Author Area
    Route::prefix('author')->group(function () {
        //Author Profile
        Route::get('/profile', [AuthorProfileController::class, 'view_profile'])->name('AuthorProfileController.view_profile');
        Route::post('/profile', [AuthorProfileController::class, 'save_profile'])->name('AuthorProfileController.save_profile');
        Route::get('/add_post', [AuthorPostController::class, 'add_post'])->name('AuthorPostController.add_post');

        //Author Post
        Route::get('/edit_post/{id}', [AuthorPostController::class, 'get_edit_post'])->name('AuthorPostController.get_edit_post');
        Route::post('/update_post/{id}', [AuthorPostController::class, 'update_post'])->name('AuthorPostController.update_post');
        Route::post('/store_new_post', [AuthorPostController::class, 'store_new_post'])->name('AuthorPostController.store_new_post');
        Route::get('/view_all_post', [AuthorPostController::class, 'all_post_show'])->name('AuthorPostController.all_post_show');
        Route::get('/view_all_unpublished_post', [AuthorPostController::class, 'view_all_unpublished_post'])->name('AuthorPostController.view_all_unpublished_post');
        Route::get('/preview/post/{id}', [AuthorPostController::class, 'preview'])->name('AuthorPostController.preview');
    });

});
