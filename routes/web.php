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

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Product Display Route
    Route::get('food/food-details/{id}', [App\Http\Controllers\Food\FoodController::class, 'foodDetails'])->name('food.details');

    //Cart Routes
    Route::post('food/food-details/{id}', [App\Http\Controllers\Food\FoodController::class, 'cart'])->name('food.cart');
    Route::get('food/cart', [App\Http\Controllers\Food\FoodController::class, 'displayCartItems'])->name('food.display.cart');
    Route::get('food/delete-cart/{id}', [App\Http\Controllers\Food\FoodController::class, 'deleteCartItems'])->name('food.delete.cart');

    //Checkout Routes
    Route::post('food/prepare-checkout/{id}', [App\Http\Controllers\Food\FoodController::class, 'prepareCheckout'])->name('prepare.checkout');

    //Insert user info Routes
    Route::get('food/checkout', [App\Http\Controllers\Food\FoodController::class, 'checkout'])->name('food.checkout');
    Route::post('food/checkout', [App\Http\Controllers\Food\FoodController::class, 'storeCheckout'])->name('food.checkout.store');

    //Paypal Route
    Route::get('food/pay', [App\Http\Controllers\Food\FoodController::class, 'pay'])->name('food.pay');
    Route::get('food/success', [App\Http\Controllers\Food\FoodController::class, 'success'])->name('food.success');

    //Booking Table Route
    Route::post('food/booking', [App\Http\Controllers\Food\FoodController::class, 'bookingTables'])->name('food.booking.table');

    //Menu Route
    Route::get('food/menu', [App\Http\Controllers\Food\FoodController::class, 'menu'])->name('food.menu');

    //Users Route
    Route::get('users/all-bookings', [App\Http\Controllers\Users\UsersController::class, 'getBookings'])->name('users.bookings');
    Route::get('users/all-orders', [App\Http\Controllers\Users\UsersController::class, 'getOrders'])->name('users.orders');