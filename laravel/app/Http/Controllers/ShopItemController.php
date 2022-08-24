<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopItemController extends Controller
{
    public function addShopItems($shopItems)
    {
        foreach ($shopItems as $shopItem) {
            $category = DB::table('categories')
                ->select('id')
                ->where('code', $shopItem->section->code)
                ->first();

            if (is_null($category)) {
                $breadcrumbs_length = count($shopItem->breadcrumbs);
                $parent_code = $shopItem->breadcrumbs[$breadcrumbs_length - 2]->code;

                $category = CategoryController::addCategory($shopItem->section, $parent_code);
            }
            if (!isset($category->id)) {
                dd($category);
            } else {
                $category_id = $category->id;
            }

            $new_shopItem = ShopItem::create([
                'code' => $shopItem->code,
                'name' => $shopItem->title,
                'category_id' => $category_id,
                'price_gold' => $shopItem->price->gold,
                'price_retail' => $shopItem->price->retail,
                'price_per' => $shopItem->unit_title,
            ]);

            if (isset($shopItem->properties)) {
                ShopItemPropertiesController::addPropertyName($shopItem->properties);
                ShopItemPropertyValueController::addPropertyValue($shopItem->properties, $new_shopItem->id);
            }
        }
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
