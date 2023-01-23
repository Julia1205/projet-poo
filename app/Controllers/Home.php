<?php

namespace App\Controllers;
use App\Models\Cocktails_model;


class Home extends BaseController
{
    public function index(): void
    {
        $cocktail_model = new Cocktails_model;
        for ($i=0; $i < 4; $i++) { //fetching 4 random cocktails
            $objCocktail = $cocktail_model->getCocktailByID(rand(1, 400));
        }
        $this->_data['title'] = "Cocktail point";
        $this->display('home/home.tpl');
    }
    public function layout(): void
    {
        $this->display('layout/layout.tpl');
    }
    /*On accède à la page RGPD*/
    public function rgpd(): void
    {
        $this->display('reglementation/rgpd.tpl');
    }
    /*On accède à la page des CGU*/
    public function gcu(): void
    {
        $this->display('reglementation/gcu.tpl');
    }
}
