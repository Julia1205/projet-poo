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
 use App\Entities\Cocktails_entity;
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
	private $validation;
    /**
     * @brief Constructeur de la classe
     */
    public function __construct()
    {
        $this->validation =  \Config\Services::validation();
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
			$this->saveCocktail($objCocktail, 1);
		}
    }

	/**
	 * @ Brief Méthode d'ajout de cocktail en base de données
	 * @Details <p> Cette méthode sauvegarde les différents éléments qui composent le cocktail, notamment son type de verre,
	 * ses ingredients et sa recette</p>
	 * @param $objCocktail objet cocktail, $boolIsFromFetch booléen
	 */
	public function saveCocktail($objCocktail, $boolIsFromFetch)
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
				$arrCocktailToSave['cocktail_receipe'] = $objCocktail->strInstructions;
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
     *
     */
    final public function cocktailAdd(): void {
		$this->_data['arrErrors'] = array();
		$this->validation->setRules(
			[
				'name' => 
				[
					'rules' => 'required|is_unique[cocktail.cocktail_name]',
					'errors' => 
					[
						'required' => 'Il est obligatoire de nommer le cocktail',
						'is_unique' => 'Ce cocktail existe déjà',
						],
				],
				'glass' => 
				[
					'rules' => 'required',
					'errors' => 
					[
						'required' => 'Il est obligatoire de sélectionner un verre',
					],
				],
				'alcoholic' =>
				[
					'rules' => 'required',
					'errors' => 
					[
						'required' => 'Il est obligatoire de sélectionner un verre',
					],
				],
				'qty.1' =>
				[
					'rules' => 'required',
					'errors' => 
					[
						'required' => 'Il est obligatoire de saisir une quantité pour les ingrédients',
					],
				],
				'ingredient.1' =>
				[
					'rules' => 'required',
					'errors' => 
					[
						'required' => 'Il est obligatoire de renseigner au moins un ingrédient',
					],
				],
				'alcoholic' => 
				[
					'rules' => 'required',
					'errors' => 
					[
						'required' => 'Il est obligatoire d\'indiquer si le cocktail est avec ou sans alcool',
					],
				],
				'img' => 
					[
						'rules' => 'required|valid_url_strict',
						'errors' => 
							[
								'required' => 'Il est obligatoire d\'ajouter l\'URL d\'une image',
								'valid_url_strict' => 'Merci de renseigner une URL valide',
							],
					],	
			]);
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
			$arrLabelAttributes =
			[
				'class' => 'form-label',
			];
			$arrLabelCheckboxAttributes = [
				'class' => '',
			];
			$arrAttributesNameInput =
			[
				'name' => 'name',
				'id' => 'name',
				'class' => 'form-control form-control-lg',
				'type' => 'text',
			];
			$arrAttributesImgInput = 
			[
				'name' => 'img',
				'id' => '',
				'class' => 'form-control form-control-lg',
				'type' => 'text',
			];
			$glass = new Glass_model;
			$glasses = $glass->findAll();
			$arrGlassesOptions = array();
			$arrIngredientsOptions = array();
			foreach ($glasses as $objGlass) {
				$arrGlassesOptions[$objGlass->glass_id] = $objGlass->glass_name;
			}
			$ingredient = new Ingredient_model;
			$ingredients = $ingredient->findAll();
			$arrIngredientsOptions = array();
			foreach ($ingredients as $objIngredient) {
				$arrIngredientsOptions[$objIngredient->ingredient_id] = $objIngredient->ingredient_name;
			}
			//$arrErrors = $this->validation->getErrors();
			if (count($this->request->getPost()) > 0){ // if the form was sent
				if ($this->validation->run($this->request->getPost())){ //if there are no errors
					//var_dump($this->request->getPost('name'));
					//var_dump($this->request->getPost('name'));die;
					$arrCocktail['cocktail_name'] = $this->request->getPost('name');
					$arrCocktail['cocktail_is_alcoholic'] = $this->request->getPost('alcoholic');
					$arrCocktail['cocktail_glass_id'] = $this->request->getPost('glass');
					$arrCocktail['cocktail_img'] = $this->request->getPost('img');
					$arrCocktail['cocktail_receipe'] = $this->request->getPost('cocktailRecipe');
					$cocktail_entity = new Cocktails_entity;
					$cocktail_entity->fill($arrCocktail);
					$cocktail_model = new Cocktails_model;
					$cocktail_model->save($cocktail_entity);
					//var_dump($arrCocktail);
					$this->_data['arrErrors'] = "Votre cocktail a bien été sauvegardé";
				}else{
					$arrErrors = $this->validation->getErrors();
					$this->_data['arrErrors'] = $arrErrors;
				}
			}
			//var_dump($arrIngredientsOptions);

		$this->_data['form_open'] = form_open("cocktail/add");
		$this->_data['input_name'] = form_input($arrAttributesNameInput);
		$this->_data['label_name'] = form_label('Name', 'name', $arrLabelAttributes);
		$this->_data['input_img'] = form_input($arrAttributesImgInput);
		$this->_data['label_img'] = form_label('Cocktail image', 'img', $arrLabelAttributes);

		$this->_data['input_glass'] = form_dropdown('glass', $arrGlassesOptions, "", "class='form-select'");
		$this->_data['label_glass'] = form_label('Glass name', 'glass', $arrLabelAttributes);
		$this->_data['input_alcohol'] = form_radio('alcoholic', 0, "","class='form-check-input'");
		$this->_data['label_alcohol'] = form_label('Cocktail without alcool', 'alcoholic', $arrLabelCheckboxAttributes);
		$this->_data['input_nonalcohol'] = form_radio('alcoholic', 1, "","class='form-check-input'");
		$this->_data['label_nonalcohol'] = form_label('Cocktail with alcool', 'alcoholic', $arrLabelCheckboxAttributes);
		for ($i=1; $i <= 15; $i++) { 
			$this->_data['input_ingredient'][$i] = form_dropdown('ingredient['.$i.']', $arrIngredientsOptions, "",'class=form-select');
			$arrIngredient_quantity =
			[
				'class' => '',
				'name' => 'qty['.$i.']',
			];
			$this->_data['input_quantity'][$i] = form_input($arrIngredient_quantity);
		}
		$this->_data['label_ingredient_name'] = form_label('Ingredient name', 'Ingredient-name', $arrLabelAttributes);
		$this->_data['label_quantity_name'] = form_label('Ingredient quantity', 'Ingredient-name', $arrLabelAttributes);
		$this->_data['form_submit' ]= form_submit("submit", "Create new cocktail", "class='btn btn-purple btn-block btn-lg text-body'");
		$this->_data['form_close'] = form_close();
		
		$this->_data['title'] = 'New cocktail - ';	
		$this->display('cocktail/add.tpl');
	}

    /**
     * @param Int $intCocktailId
     */
    final public function cocktailView(Int $intCocktailId): void {

        $arrObjCocktail = array();
        $cocktail_model = new Cocktails_model;
        $cocktail_model->getCocktailByID($intCocktailId);
        $arrObjCocktail[] = $cocktail_model->getCocktailByID($intCocktailId);
        $this->_data['allCocktail'] = $arrObjCocktail;
        //var_dump($arrObjCocktail);
        $cocktail_ingredient_model = new Cocktail_ingredient_model;
        $arrObjCtest = $cocktail_ingredient_model->getCocktailIngredientById($intCocktailId);
        //var_dump($arrObjCtest);
        $this->_data['Cocktail_ingredient_model'] = $arrObjCtest;
        $this->_data['title'] = 'View cocktail - ';
        $this->display('cocktail/view.tpl');
    }

    /**
     * @param Int $intCocktailId
     */
    final public function cocktailUpdate(Int $intCocktailId): void {
        $this->_data['title'] = 'Update cocktail - ';
        $this->display('cocktail/update.tpl');
    }

    /**
     * @param Int $intCocktailId
     */
    final public function cocktailDelete(Int $intCocktailId): void {
        $this->_data['title'] = 'Delete cocktail - ';
        $this->display('cocktail/delete.tpl');
    }

	public function cocktailSearch()
	{
		if(count($this->request->getPost()) > 0 ){
			//var_dump($this->request->getPost('search'));
			$cocktail_model = new Cocktails_model;
			$this->_data['allCocktail'] = $cocktail_model->getCocktail($this->request->getPost('search'));
			$this->_data['title'] = "Recherche - ";
			$this->display('home/home.tpl');
		}
	}
 }