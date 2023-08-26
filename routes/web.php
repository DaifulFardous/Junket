<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TourGroupController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\FeedController;

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
/*-----common_routes------*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/blogs',[BlogController::class, 'index']);
Route::get('/feed',[FeedController::class, 'index']);
Route::get('blog/details/{id}',[BlogController::class, 'details']);
Route::get('tour/plans',[TourController::class, 'index']);
Route::get('upcomming/tour/plans',[TourController::class, 'upcomming']);
Route::get('feed/details/{id}',[FeedController::class, 'details']);
/*-----common_routes ends------*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*----------Admin_routes_start----------*/
Route::prefix('admin')->group(function(){

    Route::get('/login',[AdminController::class, 'index']);
    Route::get('/register',[AdminController::class, 'register']);
    Route::post('/register/create',[AdminController::class, 'registerCreate']);
    Route::post('/login/owner',[AdminController::class, 'login']);
    Route::get('/dashboard',[AdminController::class, 'dashboard'])->middleware('admin');
    Route::get('/logout',[AdminController::class, 'logout'])->middleware('admin');
    Route::get('/blog_list',[AdminController::class, 'get_blog_list']);
    Route::get('/blogEdit/{id}',[BlogController::class, 'blogEdit']);
    Route::post('/blog/update/{id}',[BlogController::class, 'blogUpdate']);
    Route::get('/blog/delete/{id}',[BlogController::class, 'blogDelete']);
    Route::get('/blog/status/{id}',[BlogController::class, 'blogStatus']);
    Route::get('/feed_list',[AdminController::class, 'get_feed_list']);
    Route::get('/feedEdit/{id}',[FeedController::class, 'feedEdit']);
    Route::post('/feed/update/{id}',[FeedController::class, 'feedUpdate']);
    Route::get('/feed/delete/{id}',[FeedController::class, 'feedDelete']);
    Route::get('/feed/status/{id}',[FeedController::class, 'feedStatus']);




});

/*----------Admin_routes_end----------*/

/*----------TourGroup_routes_start----------*/
Route::prefix('group')->group(function(){
    Route::get('/login',[TourGroupController::class, 'index']);
    Route::get('/register',[TourGroupController::class, 'register']);
    Route::post('/register/create',[TourGroupController::class, 'registerCreate']);
    Route::post('/login/owner',[TourGroupController::class, 'login']);
    Route::get('/dashboard',[TourGroupController::class, 'dashboard'])->middleware('group');
    Route::get('/logout',[TourGroupController::class, 'logout'])->middleware('group');
    Route::get('/blog/add',[BlogController::class, 'add'])->middleware('group');
    Route::post('/blog/create',[BlogController::class, 'create'])->middleware('group');
    Route::get('/feed/add',[FeedController::class, 'add'])->middleware('group');
    Route::post('/feed/create',[FeedController::class, 'create'])->middleware('group');
    Route::get('/feed/list/{group_name}',[TourGroupController::class, 'feedDetails'])->middleware('group');
    Route::get('/feedEdit/{id}',[TourGroupController::class, 'feedEdit'])->middleware('group');
    Route::post('/feed/update/{id}',[TourGroupController::class, 'feedUpdate'])->middleware('group');
    Route::get('/feed/delete/{id}',[TourGroupController::class, 'feedDelete'])->middleware('group');
    Route::get('/blog/list/{group_name}',[TourGroupController::class, 'blogDetails'])->middleware('group');
    Route::get('/blogEdit/{id}',[TourGroupController::class, 'blogEdit'])->middleware('group');
    Route::post('/blog/update/{id}',[TourGroupController::class, 'blogUpdate'])->middleware('group');
    Route::get('/blog/delete/{id}',[TourGroupController::class, 'blogDelete'])->middleware('group');



});

/*----------TourGroup_routes_end----------*/

require __DIR__.'/auth.php';