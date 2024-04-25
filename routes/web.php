<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\loginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
// use App\Http\Controllers\SinglemenuController;
use App\Http\Controllers\BanerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LoginfeController;
use App\Http\Controllers\RegisterController;
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
Route::group(['prefix'=>'frontend'],function(){
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('registerfe');
Route::post('/register', [RegisterController::class, 'registerfe']);
Route::get('/loginfe', [LoginfeController::class, 'showLoginForm'])->name('loginfe');
Route::post('/loginfe', [LoginfeController::class, 'loginfe']);
Route::post('/logout', [LoginfeController::class, 'logout'])->name('logout');
});
Route::post('/order/confirm', [OrderController::class, 'confirmOrder'])->name('order.confirm');
Route::get('/order/success', [OrderController::class, 'showSuccess'])->name('order.success');
Route::get('/admin/orders', [OrdersController::class, 'index'])->name('admin.orders.index');
Route::get('/admin/orders/{id}', [OrdersController::class, 'showOrderDetails'])->name('admin.orders.show');
Route::delete('/admin/orders/{id}', [OrdersController::class, 'destroy'])->name('admin.orders.destroy');
Route::post('/admin/orders/{id}/confirm', [OrdersController::class, 'confirm'])->name('admin.orders.confirm');
Route::get('/', [FrontendController::class,'getHome'])->name('home');
// Route::get('single',[SinglemenuController::class,'getSingle']);

Route::get('detail/{id}', [FrontendController::class,'getDetail']);
Route::post('detail/{id}',[FrontendController::class,'postComment']);
Route::get('detail/{id}', [FrontendController::class,'getDetail']);
Route::get('baner1', [FrontendController::class, 'index'])->name('baner');
Route::get('search',[FrontendController::class,'getSearch']);
Route::group(['prefix'=>'cart'],function(){
    Route::get('add/{id}',[CartController::class,'getAddCart']);
    Route::get('show',[CartController::class,'getShowCart']);
    Route::get('delete/{id}',[CartController::class,'getDeleteCart']);
    Route::get('update',[CartController::class,'getUpdateCart']);
    Route::post('show',[CartController::class,'postComplete']);
});
Route::get('complete',[CartController::class,'getComplete']);
Route::get('category/{id}', [FrontendController::class,'getCategory']); //
Route::prefix('admin')->group(function(){
    Route::group(['prefix'=>'login','middleware'=>'ChecklogedIn'], function() {
       
        Route::get('/',[loginController::class,'getlogin'])->name('aaa');
        Route::post('/',[loginController::class,'postlogin']);
      
    });
    Route::get('logout',[HomeController::class,'getlogout'])->name('logoutbe');;
    Route::group(['middleware'=>'ChecklogedOut'],function(){
        Route::get('home',[HomeController::class,'gethome']);
        Route::get('baner', [BanerController::class, 'index'])->name('homebaner');
        Route::get('/editbaner/{id}', [BanerController::class, 'edit'])->name('editbaner');
        Route::post('/updatebaner/{id}', [BanerController::class, 'update'])->name('updatebaner');
    
        Route::group(['prefix'=>'category'],function(){
            Route::get('/',[CategoryController::class,'getCate']);
            Route::post('/',[CategoryController::class,'postCate']);
            Route::get('edit/{id}',[CategoryController::class,'getEditCate']);
            Route::post('edit/{id}',[CategoryController::class,'postEditCate']);
            Route::get('delete/{id}',[CategoryController::class,'getDeleteCate']);
        });
        Route::group(['prefix'=>'product'],function(){
            Route::get('/',[ProductController::class,'getProduct']);
            Route::get('add',[ProductController::class,'getAddProduct']);
            Route::post('add',[ProductController::class,'postAddProduct']);
            Route::get('edit/{id}',[ProductController::class,'getEditProduct']);
            Route::post('edit/{id}',[ProductController::class,'postEditProduct']);
            Route::get('delete/{id}',[ProductController::class,'getDeleteProduct']);
           
        });
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
