<?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;

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

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Auth::routes();
    //Homepage routes
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
    Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
    Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

    Route::group(["prefix" => 'food'], function(){

        //Product Display Route
        Route::get('/food-details/{id}', [App\Http\Controllers\Food\FoodController::class, 'foodDetails'])->name('food.details');

        //Cart Routes
        Route::post('/food-details/{id}', [App\Http\Controllers\Food\FoodController::class, 'cart'])->name('food.cart');
        Route::get('/cart', [App\Http\Controllers\Food\FoodController::class, 'displayCartItems'])->name('food.display.cart');
        Route::get('/delete-cart/{id}', [App\Http\Controllers\Food\FoodController::class, 'deleteCartItems'])->name('food.delete.cart');

        //Checkout Routes
        Route::post('/prepare-checkout/{id}', [App\Http\Controllers\Food\FoodController::class, 'prepareCheckout'])->name('prepare.checkout');

        //Insert user info Routes
        Route::get('/checkout', [App\Http\Controllers\Food\FoodController::class, 'checkout'])->name('.checkout');
        Route::post('/checkout', [App\Http\Controllers\Food\FoodController::class, 'storeCheckout'])->name('food.checkout.store');

        //Paypal Route
        Route::get('/pay', [App\Http\Controllers\Food\FoodController::class, 'pay'])->name('food.pay');
        Route::get('/success', [App\Http\Controllers\Food\FoodController::class, 'success'])->name('food.success');

        //Booking Table Route
        Route::post('/booking', [App\Http\Controllers\Food\FoodController::class, 'bookingTables'])->name('food.booking.table');

        //Menu Route
        Route::get('/menu', [App\Http\Controllers\Food\FoodController::class, 'menu'])->name('food.menu');
    });

    Route::group(["prefix" => 'users'], function() {

        //Users Route
        Route::get('/all-bookings', [App\Http\Controllers\Users\UsersController::class, 'getBookings'])->name('users.bookings');
        Route::get('users/all-orders', [App\Http\Controllers\Users\UsersController::class, 'getOrders'])->name('users.orders');

        //Reviews Route
        Route::get('/write-review', [App\Http\Controllers\Users\UsersController::class, 'viewReview'])->name('users.review.create');
        Route::post('/write-review', [App\Http\Controllers\Users\UsersController::class, 'submitReview'])->name('users.review.store');
    });