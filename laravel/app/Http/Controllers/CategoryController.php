<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function addCategory($params)
    {
        $existCategory = DB::table('categories')
            ->where('name', $params['name'])
            ->where('url', $params['url'])
            ->first();

        if (is_null($existCategory)) {
            $category = Category::create([
                'name' => $params['name'],
                'url' => $params['url'],
                'parent_id' => ($params['parent_id'] ?? ""),
                'level' => $params['level'],
            ]);
            dump($params);
        };
    }

    public static function destroyAll()
    {
        Category::truncate();
    }
}
