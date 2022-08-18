<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id')->withDefault([
            'name' => 'без категории'
        ]);
    }

    public function propertiesValue(){
        return $this->hasMany(ShopItemPropertyValue::class, 'id', 'shop_item_id');
    }

    public function deleteAll(){
        $shopItem = self::find($this->id);

        $shopItem->propertiesValue()->delete();
        $shopItem->delete();
    }
}
