<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $this->display('home/home.tpl');
    }
    public function layout()
    {
        $this->display('layout/layout.tpl');
    }
}
