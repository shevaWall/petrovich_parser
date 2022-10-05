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
                'properties' => $shopItem->properties,
            ]);
        }
    }

    public function getShopItemInfo($categoryCode, $shopItemCode){
        dump(ShopItem::where('code', '=', $shopItemCode)->first());
    }

    public static function destroyAll()
    {
        ShopItem::truncate();
    }
}
