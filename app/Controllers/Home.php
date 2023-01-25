<?php

namespace App\Controllers;
use App\Models\Cocktails_model;


class Home extends BaseController
{
    public function index(): void
    {
        $arrObjCocktail = array();
        $cocktail_model = new Cocktails_model;
        for ($i=0; $i < 6; $i++) { //fetching 4 random cocktails
            $objCocktail = $cocktail_model->getCocktailByID(rand(1, 400));
            $arrObjCocktail[] = $objCocktail;
        }
        //var_dump($arrObjCocktail);
        $this->_data['allCocktail'] = $arrObjCocktail;
        $this->_data['title'] = "Cocktail point";
        $this->display('home/home.tpl');
    }

    public function layout(): void
    {
        $this->_data['title'] = "Layout - ";
        $this->display('layout/layout.tpl');
    }
    public function gdpr(): void
    {
        $this->_data['title'] = "GDPR - ";
        $this->display('reglementation/rgpd.tpl');
    }
    public function gcu(): void
    {
        $this->_data['title'] = "GCU - ";
        $this->display('reglementation/gcu.tpl');
    }

    /**
     * @param Int $intPage
     */
    public function cocktailsList(Int $intPage): void {
        //On récupère la liste des cocktails à afficher
        $arrObjCocktail[] = array();
        $cocktail_model = new Cocktails_model;
        $arrObjCocktail = $cocktail_model->getCocktailByPage($intPage);
        $maxPage = $cocktail_model->getCocktailPageNumber();
        //On récupère le nombre max de pages
        $this->_data['allCocktail'] = $arrObjCocktail;
        $this->_data['actualPage'] = $intPage;
        $this->_data['maxPage'] = $maxPage;
        $this->_data['title'] = "";
        $this->display('cocktail/list.tpl');
    }
}