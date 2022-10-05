<?php

namespace App\Service;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FailedShopItemParseFromCategoryController;
use App\Http\Controllers\ParserInformationController;
use App\Http\Controllers\ShopItemController;
use App\Jobs\ParseCategories;
use App\Jobs\ParseShopItems;
use App\Models\Category;
use App\Models\FailedShopItemParseFromCategory;
use App\Models\ParserInformation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;


class ParserService
{
    private $json_page;
    private $categories;

    public function deleteAllCategoriesAndShopItems()
    {
        CategoryController::destroyAll();
        ShopItemController::destroyAll();
    }

    public function getCategory(): void
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

    private function getSubCategory($sections, $parent_category_code = ''): void
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

        $categories1lvl = DB::table('categories')
            ->select('id')
            ->where('parent_id', '=', '')
            ->get();

        $categories2lvl = array();
        foreach ($categories1lvl as $category1lvl) {
            $categories2lvl[] = DB::table('categories')
                ->select('code')
                ->where('parent_id', $category1lvl->id)
                ->get();
        }

        // проходим только по категориям второго уровня, т.к. в них выводятся все товары из всех подкатегорий
        foreach ($categories2lvl as $category2lvl) {
            foreach ($category2lvl as $category) {
                $api_url = $this->makeUrl($category->code);
                $ch = $this->runCurl($api_url);
                $this->getJsonPage($ch);

                if ($this->json_page->state->code != 20001) {
                    $this->createFailedParseShopItemsFromCategory($category->code, $this->json_page->state->title);
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

    private function grabItems(): void
    {
        $shopItems = array();
            if(isset($this->json_page->data->products)){
                $products = $this->json_page->data->products;

                foreach ($products as $k => $product) {
                    $shopItems[$k] = $product;
                }
                ShopItemController::addShopItems($shopItems);
                unset($shopItems);
                unset($this->json_page);
            }else{
                $this->createFailedParseShopItemsFromCategory(0, $this->json_page->state->title);
            }
    }

    private function getJsonPage($ch, $qty_repeats = 0): void
    {
        $this->makeJsonDecode($ch);

        if (!isset($this->json_page->data) && $this->json_page->state->code != 0) {
            $qty_repeats += 1;
            unset($this->json_page);
            $this->getJsonPage($ch);
        }
    }

    private function makeJsonDecode($ch): void
    {
        $this->json_page = json_decode($ch);
    }

    private function makeUrl($category_code, $offset = 0, $limit = 50): string
    {
        return "https://api.petrovich.ru/catalog/v2.3/sections/$category_code?limit=$limit&offset=$offset&sort=popularity_desc&path=%2Fcatalog%2F$category_code%2F&city_code=spb&client_id=pet_site";
    }

    private function createFailedParseShopItemsFromCategory($category_code, $message): void
    {
        FailedShopItemParseFromCategory::create($category_code, $message);
    }

    public function dispatchCategories()
    {
        // todo: блокировать одновременный запуск нескольких задач
        /*$parserInformation = new ParserInformation();
        $parserInformation->setParserStatus('category', 1);*/

        ParseCategories::dispatch();
        return redirect()->route('index');
    }

    public function dispatchShopItems()
    {
        // todo: блокировать одновременный запуск нескольких задач
        /* $parserInformation = new ParserInformationController();
         $parserInformation->setParserStatus('shopItems', 1);*/

        ParseShopItems::dispatch();
        return redirect()->route('index');

        //todo:: снятие блокировки по завершению задачи
    }

}
