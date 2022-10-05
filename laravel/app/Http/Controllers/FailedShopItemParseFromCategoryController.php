<?php

namespace App\Http\Controllers;

use App\Models\FailedShopItemParseFromCategory;
use Illuminate\Http\Request;

class FailedShopItemParseFromCategoryController extends Controller
{
    public function create($category_code, $message)
    {
        FailedShopItemParseFromCategory::create([
            'category_code' => $category_code,
            'error_message' => $message,
            'actuality' => true,
        ]);
    }

    public function read($params)
    {

    }

    public function update($category_code)
    {

    }

    public function delete($params)
    {

    }
}
