<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth.admin');

Route::get('san-pham/{id}', [HomeController::class, 'getProductDetail']);

Route::get('san-pham', [HomeController::class, 'product'])->name('product');

Route::get('them-san-pham', [HomeController::class, 'getAdd']);

Route::post('them-san-pham', [HomeController::class, 'postAdd']);

Route::put('them-san-pham', [HomeController::class, 'putAdd']);

Route::get('down-load-image', [HomeController::class, 'downloadImage_out'])->name('download-image');

Route::get('down-load-image-in', [HomeController::class, 'downloadImage_in'])->name('download-image-in');

Route::get('down-load-doc', [HomeController::class, 'downloadDoc'])->name('download-doc');


// Client Routes
Route::prefix('categories')->group(function () {

    // danh sách chuyên mục
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.list');

    // lấy chi tiết chuyên mục (Áp dung show form sửa chuyên mục)
    Route::get('edit/{id}', [CategoriesController::class, 'getCategorsy'])->name('categories.edit');

    // xử lý cập nhật dữ liệu
    Route::post('edit/{id}', [CategoriesController::class, 'updateCategory']);

    // hiển thị form thêm dữ liệu
    Route::get('add', [CategoriesController::class, 'addCategory'])->name('categories.add');

    // xử lý thêm chuyên mục
    Route::post('add', [CategoriesController::class, 'handleAddCategory']);

    // xử lý xóa chuyên mục
    Route::delete('delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('categories.delete');
});

// admin
Route::middleware('auth.admin')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('products', ProductsController::class)->middleware('auth.admin.product');
});
