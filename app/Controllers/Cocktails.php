<?php
/**
 * @file Cocktails.php
 * @version 1.0.0
 * @date 
 * @Author : Julie Sigrist
 * @brief Controller des cocktails
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
     * @brief Constructeur de la classe
     */
    public function __construct()
    {

    }

    /**
     * @brief Méthode de récupération de l'API en parcourant l'ensemble des lettres
	 * @details 
	 * <p> Cette méthode cible l'URL de récupération des données pour chaque lettre de l'alphabet. 
	 * Une boucle for associé à la fonction native PHP chr permet de saisir l'URL de chaque lettre. 
	 * L'ensemble des données sont mises dans un tableau. 
	 * S'en suit une vérification de chaque dimension du tableau est réalisée pour vérifier la présence d'un tableau contenant des objets.
	 * Si des objets sont présents, la méthode addCocktail est alors appelée. </p>
     */
    public function fetchCocktails()
    {
         for ($i=65; $i <= 90; $i++) { 
            $curl = curl_init();
			//url from the API
            $strUrl = "https://www.thecocktaildb.com/api/json/v1/1/search.php?f=".chr($i);
			//setting curl options
            curl_setopt($curl, CURLOPT_URL, $strUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			//curl execution
			$jsonContent = curl_exec($curl);
            if(curl_error($curl)){ //if there is a curl error
                echo curl_error($curl);
            }else{ //if there isn't a curl error
                $objList = json_decode($jsonContent);
            }
			//closing the curl because it will be used for every alphabet letter
            curl_close($curl);
			
            if(!is_null($objList) && !is_null($objList->drinks)){ //building an array from data fetched of the API
                foreach($objList->drinks as $objCocktail){
					$arrList[] = $objCocktail;
				}
			}
		}
		
		foreach($arrList as $objCocktail){//running through the array of object to save it in DB
			$this->addCocktail($objCocktail, 1);
		}
    }

	/**
	 * @ Brief Méthode d'ajout de cocktail en base de données
	 * @Details <p> Cette méthode sauvegarde les différents éléments qui composent le cocktail, notamment son type de verre,
	 * ses ingredients et sa recette</p>
	 * @param $objCocktail objet cocktail, $boolIsFromFetch booléen
	 */
	public function addCocktail($objCocktail, $boolIsFromFetch)
	{
		if($objCocktail !== null){// if the index is not empty
			if(is_object($objCocktail)){
				//managing glass
				$glass_model = New Glass_model();
				if($objCocktail->strGlass != "" || $objCocktail->strGlass != null){ //if there is a glass name
					$intIdGlass = $glass_model->returnGlassId($objCocktail->strGlass);
				}else{//if there isn't a glass name
					$intIdGlass = $glass_model->returnGlassId("N'importe quel verre");
				}
				$arrCocktailToSave["cocktail_glass_id"] = $intIdGlass;
				$arrCocktailToSave["cocktail_name"] = $objCocktail->strDrink;
				if($objCocktail->strAlcoholic == 'Alcoholic'){ //If the cocktail has alcohol
					$arrCocktailToSave["cocktail_is_alcoholic"] = 1;
				}else{ // if it 
					$arrCocktailToSave["cocktail_is_alcoholic"] = 0;
				}
				$arrCocktailToSave["cocktail_img"] = $objCocktail->strDrinkThumb;
				$arrCocktailToSave["cocktail_is_archived"] = 0; //setting archived boolean to 0
				if($boolIsFromFetch){ // checking if the cocktail is from the API
					$arrCocktailToSave["cocktail_is_moderated"] = 1;
					$arrCocktailToSave["cocktail_user_id"] = null;
					$arrCocktailToSave["cockail_updated_user_id"] = null;
				}else{ //if it's from a user
					if($this->_session->get('user_id') !== null && $this->_session->get('user_id') !== null){
						$arrCocktailToSave["cocktail_user_id"] = $this->_session->get('user_id');
						$arrCocktailToSave["cockail_updated_user_id"] = $this->_session->get('user_id');
						$arrCocktailToSave["cocktail_is_moderated"] = 0;
					}else{
						$arrErrors = "Merci de vous connecter pour ajouter un nouveau cocktail";
					}
				}
				$arrCocktailToSave["cocktail_id_api"] = $objCocktail->idDrink;
				$cocktail = new Cocktails_model;
				$intCocktailId = $cocktail->addCocktail($arrCocktailToSave);
				for($i=1; $i <= 15; $i++){// running through the ingredients
					$strIngredient = "strIngredient".$i;
					$strMeasure = "strMeasure".$i;
					if($objCocktail->$strIngredient !== null && $objCocktail->$strMeasure !== null){
						$arrIngredients[$i]["ingredient_name"] = $objCocktail->$strIngredient;
						$arrIngredients[$i]["cocktail_ingredient_quantity"] = $objCocktail->$strMeasure;
						$arrIngredients[$i]["cocktail_ingredient_cocktail_id"] = $intCocktailId;
					}
				}
				$cocktail_ingredient_model = new Cocktail_ingredient_model;
				if(isset($arrIngredients)){
					$cocktail_ingredient_model->addCocktailIngredient($arrIngredients);
				}else{
					$arrErrors = "Merci de renseigner des ingredients";
				}
			}
		}
	}

	/**
	 * @Brief Méthode de formattage du cocktail à sauvegarder
	 */
	public function saveCocktail()
	{
		//formatting the object to fit the addCocktail
		$this->addCocktail();
	}

	public function addCocktailView(Type $var = null)
	{
		$arrAttributesNameInput = 
		[
			'name' => 'name',
			'id' => 'name',
			'class' => '',
			'type' => 'text',
		];
		$arrAttributesReceipe = 
		[
			'name' => 'receipe',
			'id' => 'receipe',
			'class' => '',
			'type' => 'textarea',
		];
		$glass = new Glass_model;
		
		$this->_data['form_open'] = form_open("/addCocktail");
		$this->_data['input_name'] = form_input($arrAttributesNameInput);
		$this->_data['input_receipe'] = form_input($arrAttributesReceipe);
		$this->_data['form_close'] = form_close();
		$this->_data['title'] = 'Ajouter un cocktail';
		$this->display('addCocktail.tpl');
	}
 }