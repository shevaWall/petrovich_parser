<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shopItemImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'shopItem_id',
        'file_name'
    ];
}
