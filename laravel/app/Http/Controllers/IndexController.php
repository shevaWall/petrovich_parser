<?php

namespace App\Http\Controllers;

use App\Jobs\ParseShopItems;
use App\Models\Category;
use App\Models\ParserInformation;
use App\Models\ShopItem;
use App\Service\ParserService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
       /* $shopItem = ShopItem::where('id', 1)
            ->with('category')
            ->get();

        dump($shopItem);*/


        return view('index')
            ->with('parserInformation', ParserInformation::all())
            ->with('categoryCount', DB::table('categories')->count())
            ->with('shopItemCount', DB::table('shop_items')->count())
            ;
    }
}
