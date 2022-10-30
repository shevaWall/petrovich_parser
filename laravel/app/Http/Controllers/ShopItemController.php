<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessDownload;
use App\Jobs\ProcessImageDownload;
use App\Models\ShopItem;
use App\Models\shopItemImages;
use App\Service\ParserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
                'source_image' => $shopItem->images,
            ]);

//            ProcessImageDownload::dispatch($new_shopItem->id, $shopItem->images)->onQueue('images');
        }
    }

    public function getShopItemInfo($categoryCode, $shopItemCode)
    {
        $item = ShopItem::where('code', '=', $shopItemCode)->with('images')->get();
        dump($item);
    }

    public static function destroyAll()
    {
        Storage::disk('public')->deleteDirectory('shopItem_images');
        sleep(1);
        Storage::disk('public')->deleteDirectory('shopItem_images');


        ShopItem::truncate();
        ShopItemImages::truncate();
    }

    static public function grabImages()
    {
        $qny = 0;
        ShopItem::chunk(200, function($shopItems) use ($qny) {
            foreach($shopItems as $shopItem){
                if (!is_null($shopItem->source_image)) {
                    if (count($shopItem->source_image)) {
                        foreach ($shopItem->source_image as $image) {
                            $fileName = explode('/', $image)[4];
                            $shopItem_id = $shopItem->id;
                            ProcessDownload::dispatch($shopItem_id, $image, $fileName);
                        }
                    }
                }
            }
            $qny += 200;
            Log::info("Обработано $qny записей");
        });

    }

    static public function downloadAndAttacheImage($shopItem_id, $image_link, $f_name)
    {
        $url = "https:$image_link";
        $image = ParserService::runCurl($url);
        Storage::disk('public')->put("shopItem_images/$f_name.jpg", $image);

        ShopItemImages::create([
            'shopItem_id' => $shopItem_id,
            'file_name' => "$f_name.jpg"
        ]);
    }
}
