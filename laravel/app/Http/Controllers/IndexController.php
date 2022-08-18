<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ShopItem;
use App\Service\ParserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $parser = new ParserService();
        $parser->getShopItems();

        /*$category['count'] = DB::table('categories')->count();
        $category['status'] = DB::table('parser_information')->where('model_name', 'category')->value('status');
        $category['progressbar'] = round($category['count']/1229*100);
//        должно быть 1255 категорий

        $shopItems['count'] = DB::table('shop_items')->count();
        $shopItems['status'] = DB::table('parser_information')->where('model_name', 'shopItems')->value('status');
        $shopItems['progressbar'] = round($shopItems['count']/30880*100);

        return view('index')
            ->with('category', $category)
            ->with('shopItems', $shopItems)
            ;*/
    }
}
