<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(ReaderController::class)->group(function(){
    Route::get('/','index')->name('homepage');
    Route::get('/book_detail/{id}','show')->name('book_detail');
    Route::post('/send_request','send_request')->name('request_book');
    Route::get('/view-pdf/{id}',  'viewPdf')->name('viewPdf');
    Route::get('/collections','collections')->name('collections');
    Route::post('/addCollect','addCollect')->name('addCollect');
    Route::post('/addReview','addReview')->name('addReview');
});

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/register', 'register')->name('register');
        Route::post('/login', 'login_action')->name('login.action');
        Route::post('/register', 'register_action')->name('register.action');
    });
});

Route::middleware(['auth'])->group(function(){
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware(['auth', 'role:admin,librarian'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/permissions', 'permissions')->name('permissions');
        Route::patch('/permissions_update/{id}/{action}','updateStatusPermissions')
        ->where('action', 'accept|decline')
        ->name('permissions_updateStatus');
    });

    Route::resource('/users', UserController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/books', BooksController::class);
});
