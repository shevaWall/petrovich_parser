<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopItemController extends Controller
{
    public function addShopItems($params)
    {
        if (ShopItemController::checkShopItemForAvailabilityInDB($params['name']) === false) {
            $shopItem = ShopItem::create([
                'name' => $params['name'],
                'price' => preg_replace("/[^,.0-9]/", '', $params['price']),
                'preview_description' => $params['preview_description'],
                'category_id' => 0,
                'description' => (isset($params['description'])) ? $params['description'] : "",
                'url' => $params['url'],
                'price_per' => $params['price_per'],
                'code' => $params['code'],
            ]);
        }
    }

    private function checkShopItemForAvailabilityInDB($shopItemName): bool
    {
        $availability = true;

        $shopItem = DB::table('shop_items')
            ->where('name', $shopItemName)
            ->first();

        if (!is_null($shopItem) == 0)
            $availability = false;


        return $availability;
    }

    // автоматически запускается после выполнения getShopItems класса app/service/ParserService
    public function completeShopItemInfo($params)
    {
        $shopItem = ShopItem::find($params['shop_item_id']);

        $shopItem->description = $params['description'];
        $shopItem->details = $params['details'];
        $shopItem->save();
    }

    public static function destroyAll()
    {
        ShopItem::truncate();
    }
}
