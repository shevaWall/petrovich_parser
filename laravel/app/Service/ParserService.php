<?php

namespace App\Service;

use App\Http\Controllers\CategoryController;
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

        $this->recursiveGetSubcategory($level = 1);
    }

    private function recursiveGetSubcategory($level)
    {
        dump($level);
        $category = Category::where('level', $level)->get();

        if (count($category) != 0) {
            foreach ($category as $category_k => $category_v) {
                $html = $this->tryFileGetContents("https://petrovich.ru" . $category_v['url']);
                $dom = phpQuery::newDocument($html);

                if (count($dom->find(".pt-col-xl-2.pt-col-lg-3.pt-col-xxs-6")->stack()) > 0) {
                    foreach ($dom->find(".pt-col-xl-2.pt-col-lg-3.pt-col-xxs-6") as $k => $v) {
                        $pq = pq($v);

                        $params['name'] = $pq->find('.title')->text();
                        $params['url'] = $pq->find('a')->attr('href');
                        $params['level'] = $level + 1;
                        $params['parent_id'] = $category_v['id'];
//                        dump($params);
                    CategoryController::addCategory($params);
                    }
                    phpQuery::unloadDocuments($dom);
                }
//                    phpQuery::unloadDocuments($dom);
            }
            if ($level < 8) {
                $this->recursiveGetSubcategory($level+1);
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

}
