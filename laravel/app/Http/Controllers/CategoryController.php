<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ShopItem;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private $categories_id = array();

    public function addCategory($section, $parent_code = '')
    {
        if ($parent_code != '') {
            $parent_id = DB::table('categories')
                ->select('id')
                ->where('code', $parent_code)
                ->first();
            if (!is_null($parent_id))
                $parent_id = $parent_id->id;
        } else {
            $parent_id = '';
        }

        return Category::create([
            'name' => $section->title,
            'parent_id' => $parent_id,
            'code' => $section->code
        ]);
    }

    public function getCategoryInfoAndAllShopItems($category_code)
    {
        $category = Category::where('code', $category_code)->first();
        $this->categories_id[] = $category->id;

        $this->getAllSubCategoryIds($category->id);

        $shopItems = DB::table('shop_items')
            ->whereIn('category_id', $this->categories_id)
            ->paginate(15);

        // т.к. получаем shopItems из запроса к БД, а не через модель - принудительно преобразуем дополнительные свойства через json
        foreach ($shopItems->items() as $k => $shopItem) {
            $shopItem->properties = json_decode($shopItem->properties);
            $shopItems->items()[$k] = $shopItem;
        }

        return view('category.listing')
            ->with('categoryChildrens', $category->children)
            ->with('category', $category)
            ->with('shopItems', $shopItems);
    }

    private function getAllSubCategoryIds($currentCategoryId)
    {
        $allCategories = DB::table('categories')->select(['id', 'parent_id'])->get();

        $ids = array();

        foreach ($allCategories as $k => $category) {
            if ($category->parent_id == $currentCategoryId) {
                $this->categories_id[] = $category->id;
                $ids[] = $category->id;
                unset($allCategories[$k]);
            }
        }

        if (count($ids))
            $this->deeperSubCategory($allCategories, $ids);

        unset($allCategories);
    }

    private function deeperSubCategory($allCategories, $ids)
    {
        if ($ids) {
            $subIds = array();
            foreach ($allCategories as $k => $category) {
                if (in_array($category->parent_id, $ids)) {
                    $this->categories_id[] = $category->id;
                    $subIds[] = $category->id;
                    unset($allCategories[$k]);
                }
            }

            if (count($subIds))
                $this->deeperSubCategory($allCategories, $subIds);
        }
    }

    public static function destroyAll()
    {
        Category::truncate();
    }
}
