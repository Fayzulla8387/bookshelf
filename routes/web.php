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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PagesController::class,'index'])->name('index');

Route::get('/books', [\App\Http\Controllers\BooksController::class,'index'])->name('books.index');
Route::get('/books/search', [\App\Http\Controllers\BooksController::class,'search'])->name('books.search');
Route::post('/books/advance-search', [\App\Http\Controllers\BooksController::class,'advanceSearch'])->name('books.search.advance');

Route::get('/books/{slug}',[\App\Http\Controllers\BooksController::class,'show'])->name('books.show');
Route::get('/books/upload/new', [\App\Http\Controllers\BooksController::class,'create'])->name('books.upload');
Route::post('/books/upload/post', [\App\Http\Controllers\BooksController::class,'store'])->name('books.store');


Route::get('/books/categories/{slug}', [\App\Http\Controllers\CategoriesController::class,'show'])->name('categories.show');


Route::group(['prefix'=>'user'],function () {
    Route::get('profile/{username}',[\App\Http\Controllers\UsersController::class,'profile'])->name('users.profile');
    Route::get('profile/{username}/books',[\App\Http\Controllers\UsersController::class,'books'])->name('users.books');
});

Route::group(['prefix' => 'dashboard'], function(){
	Route::get('/', [\App\Http\Controllers\DashboardsController::class,'index'])->name('users.dashboard');
	Route::get('/books', [\App\Http\Controllers\DashboardsController::class,'books'])->name('users.dashboard.books');
	
	Route::get('/books/edit/{slug}', [\App\Http\Controllers\DashboardsController::class,'bookEdit'])->name('users.dashboard.books.edit');
	Route::post('/books/update/{slug}', [\App\Http\Controllers\DashboardsController::class,'bookUpdate'])->name('users.dashboard.books.update');
	Route::post('/books/delete/{slug}',[\App\Http\Controllers\DashboardsController::class,'bookDelete'])->name('users.dashboard.books.delete');
	
	Route::get('/books/request-list', [\App\Http\Controllers\DashboardsController::class,'requestBookList'])->name('books.request.list');

	Route::post('/books/request/{slug}', [\App\Http\Controllers\DashboardsController::class,'requestBook'])->name('books.request');
	Route::post('/books/request-update/{id}', [\App\Http\Controllers\DashboardsController::class,'requestBookUpdate'])->name('books.request.update');
	
	Route::post('/books/request-delete/{id}', [\App\Http\Controllers\DashboardsController::class,'requestBookDelete'])->name('books.request.delete');
	
	Route::post('/books/request-approve/{id}', [\App\Http\Controllers\DashboardsController::class,'requestBookApprove'])->name('books.request.approve');
	Route::post('/books/request-reject/{id}', [\App\Http\Controllers\DashboardsController::class,'requestBookReject'])->name('books.request.reject');


	// Order Routes
	Route::get('/books/order-list', [\App\Http\Controllers\DashboardsController::class,'orderBookList'])->name('books.order.list');
	Route::post('/books/order-approve/{id}', [\App\Http\Controllers\DashboardsController::class,'orderBookApprove'])->name('books.order.approve');
	Route::post('/books/order-reject/{id}', [\App\Http\Controllers\DashboardsController::class,'orderBookReject'])->name('books.order.reject');

	// Return
	Route::post('/books/order-return/{id}', [\App\Http\Controllers\DashboardsController::class,'orderBookReturn'])->name('books.return.store');

	Route::post('/books/order-return-confirm/{id}',[\App\Http\Controllers\DashboardsController::class,'orderBookReturnConfirm'])->name('books.return.confirm');

});
Route::group(['prefix' => 'admin'], function(){
    Route::get('/', [\App\Http\Controllers\Backend\PagesController::class,'index'])->name('admin.index');





    Route::group(['prefix' => 'books'], function(){
        Route::get('/',[\App\Http\Controllers\Backend\BooksController::class,'index'])->name('admin.books.index');
        Route::get('/unapproved', [\App\Http\Controllers\Backend\BooksController::class,'unapproved'])->name('admin.books.unapproved');
        Route::get('/approved',[\App\Http\Controllers\Backend\BooksController::class,'approved'])->name('admin.books.approved');
        Route::get('/create', [\App\Http\Controllers\Backend\BooksController::class,'create'])->name('admin.books.create');
        Route::get('/edit/{id}',[\App\Http\Controllers\Backend\BooksController::class,'edit'])->name('admin.books.edit');

        Route::post('/store', [\App\Http\Controllers\Backend\BooksController::class,'store'])->name('admin.books.store');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\BooksController::class,'update'])->name('admin.books.update');
        Route::post('/delete/{id}',[\App\Http\Controllers\Backend\BooksController::class,'destroy'])->name('admin.books.delete');
        Route::post('/approve/{id}',[\App\Http\Controllers\Backend\BooksController::class,'approve'])->name('admin.books.approve');
        Route::post('/unapprove/{id}', [\App\Http\Controllers\Backend\BooksController::class,'unapprove'])->name('admin.books.unapprove');
    });

    Route::group(['prefix' => 'authors'], function(){
        Route::get('/', [\App\Http\Controllers\Backend\AuthorsController::class,'index'])->name('admin.authors.index');
        Route::post('/store', [\App\Http\Controllers\Backend\AuthorsController::class,'store'])->name('admin.authors.store');
        Route::get('/{id}', [\App\Http\Controllers\Backend\AuthorsController::class,'show'])->name('admin.authors.show');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\AuthorsController::class,'update'])->name('admin.authors.update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Backend\AuthorsController::class,'destroy'])->name('admin.authors.delete');
    });

    Route::group(['prefix' => 'categories'], function(){
        Route::get('/',[\App\Http\Controllers\Backend\CategoriesController::class,'index'])->name('admin.categories.index');
        Route::post('/store', [\App\Http\Controllers\Backend\CategoriesController::class,'store'])->name('admin.categories.store');
        Route::get('/{id}', [\App\Http\Controllers\Backend\CategoriesController::class,'show'])->name('admin.categories.show');
        Route::post('/update/{id}', [\App\Http\Controllers\Backend\CategoriesController::class,'update'])->name('admin.categories.update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Backend\CategoriesController::class,'destroy'])->name('admin.categories.delete');
    });

    Route::group(['prefix' => 'publishers'], function(){
        Route::get('/',[\App\Http\Controllers\Backend\PublishersController::class,'index'])->name('admin.publishers.index');
        Route::post('/store', [\App\Http\Controllers\Backend\PublishersController::class,'store'])->name('admin.publishers.store');
        Route::get('/{id}', [\App\Http\Controllers\Backend\PublishersController::class,'show'])->name('admin.publishers.show');
        Route::post('/update/{id}',[\App\Http\Controllers\Backend\PublishersController::class,'update'])->name('admin.publishers.update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Backend\PublishersController::class,'destroy'])->name('admin.publishers.delete');
    });

});
//Auth::routes(['verify' => true]);

Route::get('/home', [\App\Http\Controllers\HomeController::class,'index'])->name('home');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
