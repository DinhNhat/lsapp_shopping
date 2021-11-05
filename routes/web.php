<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store'])->name('admin.users.login.store');

Route::middleware(['auth'])->group(function() {

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/', [MainController::class, 'index'])->name('index');
//        Route::get('main', [MainController::class, 'index']);

        #Menu
        Route::prefix('menus')->group(function() {
            Route::get('add', [MenuController::class, 'create'])->name('menu.add');
            Route::post('add', [MenuController::class, 'store'])->name('menu.store');
            Route::get('list', [MenuController::class, 'index'])->name('menu.list');
            Route::get('edit/{menu}', [MenuController::class, 'show'])->name('menu.edit');
            Route::post('edit/{menu}', [MenuController::class, 'update'])->name('menu.update');
            Route::delete('destroy', [MenuController::class, 'destroy'])->name('menu.destroy');
        });

        #Product
        Route::prefix('products')->group(function() {
            Route::get('add', [ProductController::class, 'create'])->name('product.add');
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });

        #Upload
        Route::post('upload/services', [UploadController::class, 'store'])->name('upload.services');

    });


});

