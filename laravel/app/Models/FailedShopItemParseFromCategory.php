<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedShopItemParseFromCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_code',
        'error_message',
        'actuality'
    ];
}
