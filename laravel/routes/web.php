<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ShopItemController;
use Illuminate\Support\Facades\Route;
use App\Service\ParserService;

Route::get("/", [IndexController::class, "index"])
    ->name('index');

Route::group([
//    'middleware'=>  '',
    'prefix' => 'catalog',
    'as' => 'catalog.',
], function () {
    Route::get("{category_code}", [CategoryController::class, "getCategoryInfoAndAllShopItems"])
        ->name('category');

    Route::get("{category_code}/{shopItem_code}", [ShopItemController::class, "getShopItemInfo"])
        ->name('shopItemInfo');
});

Route::group([
//    'middleware'=>  '',
    'prefix' => 'parser',
    'as' => 'parser.',
], function () {
    Route::get("categoriesAndShopItems", [ParserService::class, "parseCategoryAndShopItems"])
        ->name('parseCategoriesAndShopItems');
    Route::get("categories", [ParserService::class, "getCategory"])
        ->name('parseCategories');
    Route::get("shopItems", [ParserService::class, "getShopItems"])
        ->name('parseShopItems');
    Route::get("grabImages", [ShopItemController::class, "grabImages"])
            ->name('grabImages');
    Route::delete('deleteAllCategoriesAndShopItems', [ParserService::class, "deleteAllCategoriesAndShopItems"])
        ->name('deleteAll');

});

Route::group([
//    'middleware'=>  '',
    'prefix' => 'dispatch',
    'as' => 'dispatch.',
], function () {
    Route::get("categories", [ParserService::class, "dispatchCategories"])
        ->name('categories');
    Route::get("shopItems", [ParserService::class, "dispatchShopItems"])
        ->name('shopItems');
    Route::get("shopImages", [ParserService::class, "dispatchShopImages"])
        ->name('shopImages');
});


Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    Route::get("/", [AdminController::class, "index"])
        ->name('');

    Route::get("login", [LoginController::class, "showLoginForm"])
        ->name('login')
        ->withoutMiddleware('auth');
    Route::post("login", [LoginController::class, "login"])
        ->name('login')
        ->withoutMiddleware('auth');

    Route::get("logout", [LoginController::class, "logout"])
        ->name('logout');

    Route::get("registration", [RegistrationController::class, "showRegistrationForm"])
        ->name('registration')
        ->withoutMiddleware('auth');
    Route::post("registration", [RegistrationController::class, "registration"])
        ->name('registration')
        ->withoutMiddleware('auth');
});
