<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory($params)
    {
        $category = Category::create([
            'name' => $params['name'],
            'url' => $params['url'],
            'parent_id' => ($params['parent_id'] ?? ""),
            'level' => $params['level'],
        ]);
    }
}
