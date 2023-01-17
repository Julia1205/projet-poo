<?php
/**
 * @file Cocktails.php
 * @version 1.0.0
 * @brief Controller des cocktails
 * @Authors : Julie Sigrist
 */

 namespace App\Controllers;
 use App\Models\Cocktails_model;
 //use App\Entities\Cocktails_entity;
 use App\Models\Cocktail_ingredient_model;
 //use App\Model\Cocktail_ingredient_entity;
 use App\Models\Glass_model;
 //use App\Model\Glass_entity;
 use App\Models\User_model;
// use App\Model\User_entity;
 use App\Models\Rank_model;
 //use App\Model\Rank_entity;
 use App\Models\Ingredient_model;
 use CodeIgniter\I18n\Time;





class Cocktails extends BaseController
{
    /**
     * @brief
     */

     public function __construct()
    {

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
            //if(is_object($arrList)){
                //if(isset($arrList->drinks)){
                    foreach($arrList->drinks as $objCocktail){
                        //managing glass
                        if($objCocktail !== null){// if the index is not empty
                            if(is_object($objCocktail)){
                                $glass_model = New Glass_model();
                                if($objCocktail->strGlass != "" || $objCocktail->strGlass != null){ //if there is a glass name
                                    $intIdGlass = $glass_model->returnGlassId($objCocktail->strGlass);
                                }else{//if there isn't a glass name
                                    $intIdGlass = $glass_model->returnGlassId("N'importe quel verre");
                                }
                                $arrCocktailToSave["cocktail_glass_id"] = $intIdGlass;
                                $arrCocktailToSave["cocktail_name"] = $objCocktail->strDrink;
                                if($objCocktail->strAlcoholic == 'Alcoholic'){
                                    $arrCocktailToSave["cocktail_is_alcoholic"] = 1;
                                }else{
                                    $arrCocktailToSave["cocktail_is_alcoholic"] = 0;
                                }
                                $arrCocktailToSave["cocktail_img"] = $objCocktail->strDrinkThumb;
                                $arrCocktailToSave["cocktail_is_archived"] = 0;
                                if(isset($session->userId) && $session->userId !== null){
                                    $arrCocktailToSave["cocktail_user_id"] = $session->userId;
                                    $arrCocktailToSave["cockail_updated_user_id"] = $session->userId;
                                    $arrCocktailToSave["cocktail_is_moderated"] = 0;
                                }else{
                                    $arrCocktailToSave["cocktail_is_moderated"] = 1;
                                }
                                $arrCocktailToSave["cocktail_id_api"] = $objCocktail->idDrink;
                                $cocktail = new Cocktails_model;
                                $intCocktailId = $cocktail->addCocktail($arrCocktailToSave);
                                echo('<pre>');echo($intCocktailId);echo('</pre>');
                                for($i=1; $i <= 15; $i++){
                                    $strIngredient = "strIngredient".$i;
                                    $strMeasure = "strMeasure".$i;
                                    if($objCocktail->$strIngredient !== null && $objCocktail->$strMeasure !== null){
                                        $arrIngredients[$i]["ingredient_name"] = $objCocktail->$strIngredient;
                                        $arrIngredients[$i]["cocktail_ingredient_quantity"] = $objCocktail->$strMeasure;
                                        $arrIngredients[$i]["cocktail_ingredient_cocktail_id"] = $intCocktailId;
                                    }
                                }
                                $cocktail_ingredient_model = new Cocktail_ingredient_model;
                                $cocktail_ingredient_model->addCocktailIngredient($arrIngredients);
                            }
                        }
                    }
                //}
            //}
        }
    }

 }