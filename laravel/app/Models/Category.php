<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shopItems()
    {
        return $this->hasMany(ShopItem::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('children');
    }
}
