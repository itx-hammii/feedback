<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/',[App\Http\Controllers\User\DashboardController::class,'index'])->name('main');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=> ['auth','admin']],function() {
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');
//    Route::resource('product',App\Http\Controllers\Admin\ProductController::class);
    Route::get('product/comments/{id}',[App\Http\Controllers\Admin\ProductController::class,'viewProductComments'])->name('product.comments');
    Route::delete('comments/{id}',[App\Http\Controllers\Admin\ProductController::class,'deleteComment'])->name('delete.comment');

    Route::get('comment-toggle/{id}',[App\Http\Controllers\Admin\ProductController::class,'enableDisableComment']);
    Route::resource('user',App\Http\Controllers\Admin\UserController::class);
});
Route::group(['middleware'=> ['auth','admin','user']],function() {
    Route::resource('product',App\Http\Controllers\Admin\ProductController::class);
});

Route::group(['middleware'=> ['auth','user']],function() {
    Route::get('product/detail/{id}',[App\Http\Controllers\User\DashboardController::class,'productDetail'])->name('product.detail');
    Route::post('product/feedback',[App\Http\Controllers\User\DashboardController::class,'saveProductComment'])->name('product.feedback');
    Route::get('add/vote/{id}',[App\Http\Controllers\User\DashboardController::class,'addProductVote'])->name('add.vote');
    Route::get('minus/vote/{id}',[App\Http\Controllers\User\DashboardController::class,'minusProductVote'])->name('minus.vote');

    Route::get('users/list',[App\Http\Controllers\User\DashboardController::class,'userList'])->name('users.list');
});
