<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Service\ParserService;

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

/*Route::get('/', function () {
    return view('index');
});*/

Route::get("/", [IndexController::class, "index"])
    ->name('index');

Route::group([
//    'middleware'=>  '',
    'prefix'    =>  'parser',
    'as'        =>  'parser.',
], function(){
    Route::get("categoriesAndShopItems", [ParserService::class, "parseCategoryAndShopItems"])
        ->name('parseCategoriesAndShopItems');
    Route::get("categories", [ParserService::class, "getCategory"])
        ->name('parseCategories');
    Route::get("shopItems", [ParserService::class, "getShopItems"])
            ->name('parseShopItems');
    Route::delete('deleteAllCategoriesAndShopItems', [ParserService::class, "deleteAllCategoriesAndShopItems"])
        ->name('deleteAll');

});
