<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AOrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;

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

Auth::routes();


Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard',[DashboardController::class,'index']);
    Route::controller(CategoryController::class)->group(function(){
    Route::get('/category/view','index');
    Route::get('/category/add','create');
    Route::post('/category/add','store');
    Route::get('category/delete/{id}','delete');
    Route::get('category/edit/{id}','edit');
    Route::put('category/update/{id}','update');    
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/product/view','index');
        Route::get('/product/add','create');
        Route::post('/product/add','store');
        Route::get('product/delete/{id}','delete');
        Route::get('product/edit/{id}','edit');
        Route::put('product/update/{id}','update');  
        Route::get('product/destroy/image/{id}','destroy');  
    });

    Route::controller(SliderController::class)->group(function(){
        Route::get('sliders','index');
        Route::get('slider/create','create');
        Route::post('sliders','add')->name('store');
    });

    Route::controller(AOrderController::class)->group(function(){
        Route::get('orders','orders');
        Route::get('avieworder/{id}','vieworder');
        Route::get('orders/sendmail/{id}','sendmail');
        Route::get('orders/invoice/{id}','viewinvoice');
        Route::get('orders/invoice/download/{id}','downloadinvoice');
        Route::put('orders/updatestatus/{id}','updatestatus');
    });
   
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/',[FrontendController::class,'index']);
Route::get('/collection/{category}',[FrontendController::Class,'cproducts']);
Route::get('/collection/{category}/{product}',[FrontendController::Class,'viewproduct']);
Route::get('/search',[FrontendController::Class,'searchproduct']);

// Route::get('/cart',[CartController::class,'index'])->middleware('auth');

Route::middleware(['auth'])->group(function(){
    Route::get('cart',[CartController::class,'index']);
    Route::get('checkout-show',[CheckoutController::class,'index']);
    Route::get('thank-you',[CheckoutController::class,'thankyou']);
    Route::get('myorders',[OrderController::class,'myorders']);
    Route::get('vieworder/{id}',[OrderController::class,'vieworder']);
    Route::get('profile',[FrontendController::class,'profile']);
    Route::post('profile',[FrontendController::class,'saveprofile']);
    Route::get('changepassword',[FrontendController::class,'changepassword']);
    Route::post('changepassword',[FrontendController::class,'updatepassword']);
});