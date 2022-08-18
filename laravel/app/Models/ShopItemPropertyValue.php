<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopItemPropertyValue extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function propertyName(){
        return $this->hasOne(ShopItemProperties::class);
    }
}
