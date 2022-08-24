<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function addCategory($section, $parent_code = '')
    {
        if($parent_code != ''){
            $parent_id = DB::table('categories')
                ->select('id')
                ->where('code', $parent_code)
                ->first();
            if(!is_null($parent_id))
                $parent_id = $parent_id->id;
        }else{
            $parent_id = '';
        }

        return Category::create([
            'name' => $section->title,
            'parent_id' => $parent_id,
            'code' => $section->code
        ]);
    }

    public static function destroyAll()
    {
        Category::truncate();
    }
}
