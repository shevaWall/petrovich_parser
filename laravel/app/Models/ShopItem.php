<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'properties' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function setPropertiesAttribute($value)
    {
        $this->attributes['properties'] = json_encode($value);
    }

    public function deleteAll()
    {
        $shopItem = self::find($this->id);

        $shopItem->propertiesValue()->delete();
        $shopItem->delete();
    }

    public function images(){
        return $this->hasMany(ShopItemImages::class, 'shopItem_id', 'id');
    }
}
