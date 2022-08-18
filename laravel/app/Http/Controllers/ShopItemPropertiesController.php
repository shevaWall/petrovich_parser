<?php

namespace App\Http\Controllers;

use App\Models\ShopItemProperties;
use Illuminate\Http\Request;

class ShopItemPropertiesController extends Controller
{
    public function addPropertyNameIfNotExists($params)
    {
        foreach ($params['properties'] as $property_name => $property_value) {
            $shopItemProperty = ShopItemProperties::where('name', $property_name);

            $property['shop_item_id'] = $params['shop_item_id'];
            $property['value'] = $property_value;

            if ($shopItemProperty->exists()) {
                $shopItemProperty = $shopItemProperty->get();
                $property['property_id'] = $shopItemProperty[0]['id'];
            } else {
                $shopItemProperty = ShopItemProperties::create([
                    'name' => $property_name,
                ]);
                $property['property_id'] = $shopItemProperty['id'];
            }

            ShopItemPropertyValueController::addPropertyToShopItem($property);
        }
    }
}
