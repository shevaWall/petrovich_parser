<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopItemController extends Controller
{
    public function addShopItem($params)
    {
        if (ShopItemController::checkShopItemForAvailabilityInDB($params['name']) === false) {
            $cat_id = Category::where('name', $params['category_id'])->get();

            $shopItem = ShopItem::create([
                'name' => $params['name'],
                'price' => preg_replace("/[^,.0-9]/", '', $params['price']),
                'category_id' => $cat_id[0]['id'],
                'preview_description' => $params['preview_description'],
                'description' => $desc = (isset($params['description'])) ? $params['description'] : "",
                'url' => $params['url'],
                'price_per' => $params['price_per'],
            ]);
        }
    }

    private function checkShopItemForAvailabilityInDB($shopItemName): bool
    {
        $availability = true;

        $shopItem = DB::table('shop_items')
            ->where('name', $shopItemName)
            ->get();

        if (count($shopItem) == 0)
            $availability = false;


        return $availability;
    }
}
