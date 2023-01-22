<?php

namespace App\Controllers;
use App\Models\Cocktails_model;


class Home extends BaseController
{
    public function index()
    {
        $cocktail_model = new Cocktails_model;
        for ($i=0; $i < 4; $i++) { //fetching 4 random cocktails
            $objCocktail = $cocktail_model->getCocktailByID(rand(1, 400));
            var_dump($objCocktail);
        }
        //$this->_data['title'] = "Cocktail point";
        //$this->display('home/home.tpl');
    }
    public function layout()
    {
        $this->display('layout/layout.tpl');
    }
}
