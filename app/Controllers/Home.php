<?php

namespace App\Controllers;
use App\Models\Cocktails_model;


class Home extends BaseController
{
    public function index()
    {
        $arrObjCocktail = array();
        $cocktail_model = new Cocktails_model;
        for ($i=0; $i < 6; $i++) { //fetching 4 random cocktails
            $objCocktail = $cocktail_model->getCocktailByID(rand(1, 400));
            $arrObjCocktail[] = $objCocktail;
        }
        //var_dump($arrObjCocktail);
        $this->_data['allCocktail'] = $arrObjCocktail;
        $this->_data['title'] = "Cocktail poiecceecent";
        $this->display('home/home.tpl');
    }
    public function layout()
    {
        $this->display('layout/layout.tpl');
    }
}