<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Parser;

class IndexController extends Controller
{
    public function index(){
       /* $category = Category::all();
        dump($category);*/

        echo Parser::getCategory();
    }

}
