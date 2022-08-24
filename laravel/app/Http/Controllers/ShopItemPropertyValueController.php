<?php

namespace App\Http\Controllers;

use App\Models\ShopItemPropertyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopItemPropertyValueController extends Controller
{
    public function addPropertyValue($properties, $shopItem_id){
        foreach($properties as $property){
            $prop_id = DB::table('shop_item_properties')
                ->select('id')
                ->where('name', $property->title)
                ->first()
                ->id;

            ShopItemPropertyValue::create([
                'property_id' => $prop_id,
                'shop_item_id' => $shopItem_id,
                'value' => $property->value[0]->title." ".$property->unit,
            ]);
        }
    }

    public static function destroyAll(){
        ShopItemPropertyValue::truncate();
    }
}
