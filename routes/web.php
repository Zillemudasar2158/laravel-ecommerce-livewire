<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubcatController;
use App\Http\Controllers\ordercontroller;
use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;

Route::get('/',[CategoryController::class,'welcome'])->name('home');
Route::get('/cat/{id}',[CategoryController::class,'catproduct'])->name('catproduct');
Route::get('/search-all', [ProductController::class, 'globalSearch']);
Route::get('/searchproduct/{id}',[ProductController::class,'productsearch']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(PermissionController::class)->group(function(){
    	//for permission route
    	Route::get('/permission_list','list')->name('permission.list');
    	Route::get('/create_permission','create')->name('permission.create');
    	Route::post('/store','store')->name('permission.store');
    	Route::get('/permission/{id}/edit','edit')->name('permission.edit');
    	Route::put('/permission/{id}','update')->name('permission.update');
    	Route::get('/permission/{id}','destory')->name('permission.destory');
    });
    	//for role route
    Route::controller(RoleController::class)->group(function(){
    	Route::get('/role','list')->name('role.list');
    	Route::get('/rolecreate','create')->name('role.create');
    	Route::post('/rolestore','store')->name('role.store');
    	Route::get('/role/{id}/edit','edit')->name('role.edit');
    	Route::put('/roleupdate/{id}','update')->name('role.update');
    	Route::get('/roledelete/{id}','destory')->name('role.destory');
    });
	    //User Routes
    Route::controller(UserController::class)->group(function(){
        Route::get('/userabout','about')->name('about');
        Route::get('/userlist','list')->name('user.list');
        Route::get('/user/{id}/edit','edit')->name('user.edit');
        Route::put('/user/{id}','update')->name('user.update');
    });
    //for about pages
    Route::controller(ProductController::class)->group(function(){        
        Route::get('productcreate','create')->name('product.create');   
        Route::post('productstore','store')->name('product.store');
        Route::delete('product/{id}','destroy')->name('product.destroy');
    });
    //for product pages
    Route::controller(ProductController::class)->group(function(){
        Route::get('/product/{id}/edit','edit')->name('product.edit');
        Route::put('/product/{id}','update')->name('product.update');
    });

    //for category pages
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/catlist','list')->name('category.list');
        Route::get('/catcreate','create')->name('category.create');
        Route::post('/catstore','store')->name('category.store');
        Route::get('/cat/{id}/edit','edit')->name('category.edit');
        Route::put('/cat/{id}','update')->name('category.update');
        Route::delete('/category/{id}','destory')->name('category.destory');
        //for subcategory delete
        Route::delete('/subcat/{id}','destorysubcat')->name('subcat.destory');
    });

    //for category pages
    Route::controller(SubcatController::class)->group(function(){
        Route::post('/subcatstore','store')->name('subcat.store');
    });

    //for user cart - Cartcontroller
    Route::controller(CartController::class)->group(function(){
        Route::get('/cartlist','list')->name('cart.list');
        Route::post('/addtocart','store')->name('cart.store');
        Route::put('/cart/{id}','update')->name('cart.update');
    });
    // for order controller
    Route::controller(ordercontroller::class)->group(function(){
        Route::get('/orderlist','list')->name('order.list');
        Route::post('/orderconfirm','store')->name('order.confirm');
        Route::get('/allorderlist','alllistorder')->name('allorder.list');
        Route::get('/orderdetail/{is}','orderfind')->name('orderdetail.list');
        Route::get('/order/{id}/edit','edit')->name('order.edit');
        Route::put('/order/{id}/','update')->name('order.update');
    });
    Route::controller(CouponController::class)->group(function(){
        Route::get('/createcoupon','create')->name('coupon.create');
        Route::post('/storecoupon','store')->name('coupon.store');
        Route::get('/listcoupon','list')->name('coupon.list');
    });
});
        Route::get('/productlist',[ProductController::class,'list'])->name('product.list');
        Route::get('/category',[ProductController::class,'category'])->name('category');
require __DIR__.'/auth.php';
