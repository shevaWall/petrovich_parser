<?php

namespace App\Http\Controllers;

use App\Models\ShopItem;
use App\Models\shopItemImages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

            self::grabImages($new_shopItem->id, $shopItem->images);
        }
    }

    public function getShopItemInfo($categoryCode, $shopItemCode)
    {
        $item = ShopItem::where('code', '=', $shopItemCode)->with('images')->get();
        dump($item);
    }

    public static function destroyAll()
    {
        ShopItem::truncate();
    }

    private function grabImages($shopItem_id, $images)
    {
        if(count($images)){
            foreach ($images as $image) {
                $fileName = explode('/', $image)[4];

                self::file_get_image($image, $fileName);

                ShopItemImages::create([
                    'shopItem_id' => $shopItem_id,
                    'file_name' => "$fileName.jpg"
                ]);
            }
        }
    }

    private function file_get_image($image_link, $f_name){

        //todo: переделать загрузку изображений - вылетает по таймауте
        $url = "https:$image_link";
        $image = file_get_contents($url);
        Storage::disk('public')->put("shopItem_images/$f_name.jpg", $image);
    }
}
