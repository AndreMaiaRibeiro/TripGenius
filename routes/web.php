<?php

use App\Http\Controllers\BarController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RestaurantController;

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
    return view('home');
});

Auth::routes();
Route::group(['prefix' => 'admin'], function () {
    (new TCG\Voyager\Voyager)->routes();
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/european-countries', [CountryController::class, 'showEuropeanCountries']);
Route::get('/select-country', [CountryController::class, 'selectCountry'])->name('country.select');
Route::get('/select-country/{countryName}', [CountryController::class, 'selectCountry'])->name('country.select');


Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::post('/restaurants/search', [RestaurantController::class, 'searchRestaurant'])->name('restaurants.search');

Route::get('/cafes', [CafeController::class, 'index']);
Route::post('/cafes/search', [CafeController::class, 'searchCafe'])->name('cafes.search');

Route::get('/bars', [BarController::class, 'index']);
Route::post('/bars/search', [BarController::class, 'searchBar'])->name('bars.search');
