<?php

namespace App\Http\Controllers;

use App\Models\ShopItemPropertyValue;
use Illuminate\Http\Request;

class ShopItemPropertyValueController extends Controller
{
    public function addPropertyToShopItem($property){
        ShopItemPropertyValue::create([
            'property_id' => $property['property_id'],
            'shop_item_id' => $property['shop_item_id'],
            'value' => $property['value'],
        ]);
    }
}
