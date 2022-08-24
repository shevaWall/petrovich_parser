<?php

namespace App\Service;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopItemController;
use App\Http\Controllers\ShopItemPropertiesController;
use App\Http\Controllers\ShopItemPropertyValueController;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpQuery;


class ParserService
{
    private $json_page;
    private $categories;

    public function deleteAllCategoriesAndShopItems()
    {
        CategoryController::destroyAll();
        ShopItemController::destroyAll();
    }

    public function getCategory()
    {
        CategoryController::destroyAll();

        $api_url = "https://api.petrovich.ru/catalog/v2.3/sections/tree/3?city_code=spb&client_id=pet_site";
        $ch = $this->runCurl($api_url);
        $this->getJsonPage($ch);

        foreach ($this->json_page->data->sections as $section) {
            CategoryController::addCategory($section);

            if (!is_null($section->sections)) {
                $this->getSubCategory($section->sections, $section->code);
            }
        }
    }

    private function getSubCategory($sections, $parent_category_code = '')
    {
        foreach ($sections as $section) {
            CategoryController::addCategory($section, $parent_category_code);
            if (!is_null($section->sections)) {
                $this->getSubCategory($section->sections, $section->code);
            }
        }
    }

    public function runCurl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, Storage::disk('public')->path('petrovich.ru_cookies.txt'));

        $r = curl_exec($ch);
        curl_close($ch);

        return $r;
    }

    public function getShopItems()
    {
        \Debugbar::disable();

        ShopItemController::destroyAll();
        ShopItemPropertiesController::destroyAll();
        ShopItemPropertyValueController::destroyAll();

        $categories1lvl = DB::table('categories')
            ->select('id')
            ->where('parent_id', '')
            ->get();

        $categories2lvl = array();
        foreach ($categories1lvl as $category1lvl) {
            $categories2lvl[] = DB::table('categories')
                ->select('code')
                ->where('parent_id', $category1lvl->id)
                ->get();
        }

        foreach ($categories2lvl as $category2lvl) {
            foreach ($category2lvl as $category) {
                $api_url = $this->makeUrl($category->code);
                $ch = $this->runCurl($api_url);
                $this->getJsonPage($ch);

                if ($this->json_page->state->code != 20001) {
                    dd($this->json_page);
                } else {
                    if (!is_null($this->json_page->data->products) && count($this->json_page->data->products)) {
                        $page_qty = ceil($this->json_page->data->pagination->products_count / 50);
                        $this->grabItems();

                        $offset = 0;
                        for ($page = 2; $page <= $page_qty; $page++) {
                            $offset += 50;
                            $api_url = $this->makeUrl($category->code, $offset);
                            $ch = $this->runCurl($api_url);

                            $this->getJsonPage($ch);
                            $this->grabItems();
                        }
                    }
                }
            }
        }
    }

    private function grabItems()
    {
        $shopItems = array();
        $products = $this->json_page->data->products;

        foreach ($products as $k => $product) {
            $shopItems[$k] = $product;
        }
        ShopItemController::addShopItems($shopItems);
        unset($shopItems);
        unset($this->json_page);
    }

    private function getJsonPage($ch)
    {
        $this->makeJsonDecode($ch);

        if (!isset($this->json_page->data)) {
            unset($this->json_page);
            $this->getJsonPage($ch);
        }
    }

    private function makeJsonDecode($ch)
    {
        $this->json_page = json_decode($ch);
    }

    private function makeUrl($category_code, $offset = 0, $limit = 50)
    {
        return "https://api.petrovich.ru/catalog/v2.3/sections/$category_code?limit=$limit&offset=$offset&sort=popularity_desc&path=%2Fcatalog%2F$category_code%2F&city_code=spb&client_id=pet_site";
    }

}
