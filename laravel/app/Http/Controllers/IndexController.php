<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ShopItem;
use App\Service\ParserService;
use Illuminate\Support\Facades\Artisan;

class IndexController extends Controller
{
    public function index()
    {
        /*$parser = new ParserService();

        $parser->getShopItems();*/
        Artisan::call('parse:shopItems');

        return view('petrovichMainPage');
    }
}
