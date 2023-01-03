<?php
/**
 * @file Cocktails.php
 * @version 1.0.0
 * @brief Controller des cocktails
 * @Authors : Julie Sigrist
 */

 //namespace App\Controllers;
// use App\Controller\BaseController;
 //use CodeIgniter\Controller;
 
 namespace App\Controllers;
 use App\Models\Cocktails_model;
 use App\Entities\Cocktails_entity;

class Cocktails extends BaseController
{
    /**
     * @brief
     */

     public function __construct(){

     }

     public function fetchCocktails()
     {

         for ($i=65; $i <= 90; $i++) { 
            $curl = curl_init();
            # code...
            $strUrl = "https://www.thecocktaildb.com/api/json/v1/1/search.php?f=".chr($i);
            curl_setopt($curl, CURLOPT_URL, $strUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $jsonContent = curl_exec($curl);
            if(curl_error($curl)){
                echo curl_error($curl);
            }else{
                $arrList = json_decode($jsonContent);
            }
            curl_close($curl);
    
            foreach($arrList as $objCocktail){
                var_dump($objCocktail);
            }
        }

     }
 }