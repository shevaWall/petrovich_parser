<?php

namespace App\Service;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ParserInformationController;
use App\Http\Controllers\ShopItemController;
use App\Http\Controllers\ShopItemPropertiesController;
use App\Models\Category;
use App\Models\ShopItem;
use App\Models\ShopItemProperties;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;
use phpQuery;

class ParserService
{
    public $shopItems;

    public function parseCategoryAndShopItems()
    {
        $this->getCategory();
        $this->getShopItems();
    }

    public function deleteAllCategoriesAndShopItems()
    {
        CategoryController::destroyAll();
        ShopItemController::destroyAll();
    }

    public function getCategory()
    {
//        CategoryController::destroyAll();
        /*  if (!ParserInformationController::getParserStatus('category') && !ParserInformationController::getParserStatus('shopItems')) {
              ParserInformationController::setParserStatus('category', 1);*/
        $html = $this->tryFileGetContents("https://petrovich.ru/catalog/");
        $dom = phpQuery::newDocument($html);

        foreach ($dom->find(".main__catalog-categoty") as $k => $v) {
            $pq = pq($v);
            $params['name'] = $pq->find('.main__catalog-title-block p')->text();
            $params['url'] = $pq->find('.main__catalog-title-block a')->attr('href');
            $params['level'] = 1;

            CategoryController::addCategory($params);
        }

        phpQuery::unloadDocuments($dom);

        $this->getSubcategory($level = 1);
        /**
         * перезапускаем, чтобы добавить недостающие категории, кт почему-то не парсятся
         * честно, неделю потратил на поиски этого бага. должно быть ~1262 категории
         **/
//        $this->getSubcategory($level = 1);

//            ParserInformationController::setParserStatus('category', 0);
//        }
    }

    private function getSubcategory($level)
    {
        $category = DB::table('categories')->where('level', $level)->select('url', 'id')->get();

        if (count($category)) {
            foreach ($category as $category_v) {

                $html = $this->tryFileGetContents("https://petrovich.ru" . $category_v->url);
                $dom = phpQuery::newDocument($html);
                $countChildren = count($dom->find(".catalog-subsection")->stack());

                if ($countChildren) {
                    foreach ($dom->find(".catalog-subsection") as $v) {
                        $pq = pq($v);

                        $params['name'] = $pq->text();
                        $params['url'] = $pq->attr('href');
                        $params['level'] = $level + 1;
                        $params['parent_id'] = $category_v->id;

                        CategoryController::addCategory($params);
                    }
                }
                phpQuery::unloadDocuments($dom);
            }

            $this->getSubcategory($level + 1);
        }
    }

    private function tryFileGetContents($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }

    public function getShopItems()
    {
        ShopItemController::destroyAll();
        $categories = Category::where('level', 2)->get();
        if (count($categories) == 0) {
            $this->getCategory();
            $categories = Category::where('level', 2)->get();
        }

        foreach ($categories as $category) {
            $this->grabItem($category['url']);
        }
    }

    private function grabItem($category_url, $page = 0, $dom = "")
    {
        ($dom != "") ?? phpQuery::unloadDocuments($dom);

        $url = ($page == 0)
            ? "https://petrovich.ru" . $category_url . "?sort=popularity_desc"
            : "https://petrovich.ru" . $category_url . "?sort=popularity_desc&p=$page";

        $html = $this->tryFileGetContents($url);

        $dom = phpQuery::newDocument($html);
        $count = 0;

        if (count($dom->find(".page-item-list")->stack()) > 0) {
            foreach ($dom->find(".page-item-list") as $k => $v) {
                $pq = pq($v);

                $params['name'] = $pq->find('.title')->text();
                $params['price'] = ($pq->find('.retail-price')->text() != '')
                    ? $pq->find('.retail-price')->text()
                    : $pq->find('.gold-price')->text();
                $params['preview_description'] = $pq->find('.product-card-properties')->text();
                $params['url'] = $pq->find('.title')->attr('href');
                $params['price_per'] = ($pq->find('p.unit-tab')->text() != '')
                    ? $pq->find('p.unit-tab')->text()
                    : $pq->find('span.active.unit-tab')->text();
                $params['code'] = $pq->find('.code .pt-c-secondary')->text();
                ShopItemController::addShopItem($params);
                $count++;
            }

            ($count == 0) ? $this->grabItem($category_url, $page, $dom) : $this->pageNavigation($category_url, $dom, $page);

        } else {
            $this->grabItem($category_url, $page);
        }
    }

    private function pageNavigation($category_url, $dom, $page)
    {
        if ($dom->find('.pagination-nav .pages-list')->stack() > 0) {
            foreach ($dom->find('.pagination-nav .pages-list a') as $k => $link) {
                if ($k > 0) {
                    $pq = pq($link);
                    if ($pq->text() >= $page + 2) {
                        $this->grabItem($category_url, $page + 1, $dom);
                    }
                }
            }
        } else {
            dump("блок с навигацией не найден");
        }
    }

    public function getFullShopItemInformation($shopItems)
    {
        foreach ($shopItems as $shopItem) {
            $url = "https://petrovich.ru" . $shopItem['url'];
            $html = $this->tryFileGetContents($url);
            $dom = phpQuery::newDocument($html);

            $params['shop_item_id'] = $shopItem['id'];
            $params['description'] = htmlspecialchars(pq($dom->find('.content'))->html());
            $params['details'] = htmlspecialchars(pq($dom->find('.product-details'))->html());
            foreach ($dom->find('.product-properties-list li') as $k => $v) {
                $pq = pq($v);
                $params['properties'][$pq->find('.title')->text()] = $pq->find('.value')->text();
            }

            phpQuery::unloadDocuments($dom);

            ShopItemController::completeShopItemInfo($params);
            ShopItemPropertiesController::addPropertyNameIfNotExists($params);
        }
    }
}
