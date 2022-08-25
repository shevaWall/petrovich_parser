<?php

namespace App\Http\Controllers;

use App\Jobs\ParseShopItems;
use App\Models\Category;
use App\Models\ShopItem;
use App\Service\ParserService;
use Illuminate\Support\Facades\Artisan;

class IndexController extends Controller
{
    public function index()
    {
        ParseShopItems::dispatch();

        return view('petrovichMainPage');
    }
}
