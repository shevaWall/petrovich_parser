<?php

namespace App\Service;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopItemController;
use App\Models\Category;
use phpQuery;

class ParserService
{
    public function getCategory(): void
    {
        $html = file_get_contents("https://petrovich.ru/catalog/");
        $dom = phpQuery::newDocument($html);

        foreach ($dom->find(".main__catalog-title-block") as $k => $v) {
            $pq = pq($v);
            $params['name'] = $pq->find('p')->text();
            $params['url'] = $pq->find('a')->attr('href');
            $params['level'] = 1;

            CategoryController::addCategory($params);
        }

        phpQuery::unloadDocuments();

//        $this->getSubcategory($level = 1);
//        $this->getShopItems($category = Category::where('level', 2)->get());
    }

    private function getSubcategory($level): void
    {
        $category = Category::where('level', $level)->get();

        if (count($category) != 0) {
            foreach ($category as $category_k => $category_v) {
                $currentCategoryName = $category_v['name'];
                $html = $this->tryFileGetContents("https://petrovich.ru" . $category_v['url']);
                $dom = phpQuery::newDocument($html);

                if (count($dom->find(".pt-col-xl-2.pt-col-lg-3.pt-col-xxs-6")->stack()) > 0) {
                    foreach ($dom->find(".pt-col-xl-2.pt-col-lg-3.pt-col-xxs-6") as $k => $v) {
                        $pq = pq($v);

                        $params['name'] = $pq->find('.title')->text();
                        $params['url'] = $pq->find('a')->attr('href');
                        $params['level'] = $level + 1;
                        $params['parent_id'] = $category_v['id'];
                        CategoryController::addCategory($params);
                    }
                }
                phpQuery::unloadDocuments($dom);
            }
            if ($level < 8) {
                $this->getSubcategory($level + 1);
            }
        }
    }

    private function tryFileGetContents($url)
    {
//        return  file_get_contents($url);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }

    public function getShopItems($categories)
    {
        if (count($categories) == 0) {
            $this->getCategory();
        } else {
            foreach ($categories as $category_k => $category_v) {
                echo "грабим ".$category_v['name'] ."<br/>";
                $this->grabItem($category_v['url']);
            }
        }
    }

    private function grabItem($category_url, $page = 0)
    {
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
                $params['category_id'] = $category_url;
                $params['preview_description'] = $pq->find('.product-card-properties')->text();
                $params['url'] = $pq->find('.title')->attr('href');
                $params['price_per'] = ($pq->find('p.unit-tab')->text() != '')
                    ? $pq->find('p.unit-tab')->text()
                    : $pq->find('span.active.unit-tab')->text();

                ShopItemController::addShopItem($params);
                $count++;
            }

            ($count == 0) ? $this->grabItem($category_url, $page) : $this->pageNavigation($category_url, $dom, $page);

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
                        $this->grabItem($category_url, $page + 1);
                    }
                }
            }
        } else {
            dump("блок с навигацией не найден");
        }
        phpQuery::unloadDocuments($dom);
    }

}
