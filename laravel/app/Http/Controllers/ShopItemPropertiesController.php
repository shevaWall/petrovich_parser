<?php

namespace App\Http\Controllers;

use App\Models\ShopItemProperties;
use App\Models\ShopItemPropertyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopItemPropertiesController extends Controller
{
    public function addPropertyName($properties)
    {
        foreach ($properties as $property) {
            $exists_prop = ShopItemPropertiesController::getPropertyName($property->title);

            if (is_null($exists_prop)) {
                ShopItemProperties::create([
                    'name' => $property->title,
                ]);
            }
        }
    }

    public static function destroyAll(){
        ShopItemProperties::truncate();
    }

    private function getPropertyName($title)
    {
        return DB::table('shop_item_properties')
            ->where('name', $title)
            ->first();
    }
}
