<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Mart\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Form\{
    formController,
    jsonFormController
};
use App\Http\Controllers\Admin\Product\{
    ProductController,
};
use App\Http\Controllers\Admin\FetchApi\{
    FetchController,
};

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


Route::get('/', [HomeController::class, 'index']);
require __DIR__ . '/auth.php';

Route::name('fetch.')->prefix('fetch')->group(function () {
    Route::post('/product_category', [FetchController::class, 'getProductCategory'])->name('product_category');
});

require __DIR__ . '/adminauth.php';
Route::middleware('auth:admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');

    Route::get('/add-product-category', [ProductController::class, 'create'])->name('product-add');
    Route::post('/store-product-category', [ProductController::class, 'store'])->name('product-category-store');

    Route::get('/custom_form', [formController::class, 'customForm']);
    Route::post('/custom_form', [formController::class, 'storeCustomForm']);
    Route::get('/modify_custom_form', [formController::class, 'modifyForm']);
    Route::post('/modify_custom_form', [formController::class, 'modifyFormData']);
    Route::post('/delete_custom_form', [formController::class, 'deleteField']);
    Route::post('/delete_option', [formController::class, 'deleteOption']);

    Route::post('/show_form', [formController::class, 'showFormDetails']);
    Route::get('/category', [formController::class, 'showCategory']);
    Route::post('/store_category', [formController::class, 'storeCategory']);

    // Route::get('/form',[formController::class,'dynamicForm']);
    Route::post('/get_form', [formController::class, 'getForm']);
    // Route::post('/store_form_data',[formController::class,'storeFormData']);
    // Route::get('/list_form_data',[formController::class,'showFormData']);
    // Route::get('/list_form_data/{id}',[formController::class,'showFormData']);

    #json ways
    Route::get('/form', [jsonFormController::class, 'dynamicForm']);
    Route::post('/store_form_data', [jsonFormController::class, 'storeFormData']);
    Route::get('/list_form_data', [jsonFormController::class, 'showFormData']);
    Route::get('/list_form_data/{id}', [jsonFormController::class, 'showFormData']);
    #end
    Route::post('/get_sub_category', [formController::class, 'getSubCategory']);
});
