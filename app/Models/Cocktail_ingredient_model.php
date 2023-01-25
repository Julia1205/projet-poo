<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Models\Ingredient_model;
use App\Entities\Cocktail_ingredient_entity;

class Cocktail_ingredient_model extends Model{
    protected $table         = 'cocktail_ingredient';
    // Nom du champ de la clé primaire
    protected $primaryKey    = 'cocktail_ingredient_id';
    // Champs utilisables
    protected $allowedFields = ['cocktail_ingredient_cocktail_id',
                                'cocktail_ingredient_ingredient_id',
                                'cocktail_ingredient_quantity'];
 
    // Type de retour => Chemin de l'entité à utiliser
    protected $returnType    = 'App\Entities\Cocktail_ingredient_entity';
 
    // Utilisation ou non des dates (création / modification)
    protected $useTimestamps = false;

    public function addCocktailIngredient($arrCocktailIngredients)
    {
        foreach ($arrCocktailIngredients as $arrIngredient) {
            //checking if this association doesn't already exists
            if($arrIngredient !== 'undefined'){
                $ingredient_model = new ingredient_model;
                $objCocktailIngredient = $this->where('cocktail_ingredient_cocktail_id', $arrIngredient["cocktail_ingredient_cocktail_id"])->where("cocktail_ingredient_ingredient_id", $ingredient_model->addIngredient($arrIngredient["ingredient_name"]))->first();
                if($objCocktailIngredient == null){ // if for the current cocktail id there isn't this association cocktail id - ingredient id
                    $ingredient_model = new Ingredient_model;
                    $arrCocktailIngredientToSave["cocktail_ingredient_ingredient_id"] = $ingredient_model->addIngredient($arrIngredient["ingredient_name"]);
                    $arrCocktailIngredientToSave["cocktail_ingredient_cocktail_id"] = $arrIngredient["cocktail_ingredient_cocktail_id"];
                    $arrCocktailIngredientToSave["cocktail_ingredient_quantity"] = $arrIngredient["cocktail_ingredient_quantity"];
                    $cocktail_ingredient_entity = new Cocktail_ingredient_entity;
                    $cocktail_ingredient_entity->fill($arrCocktailIngredientToSave);  
                    $this->save($cocktail_ingredient_entity);
                }else{// if there is already this ingredient for this cocktail
                    /* TODO comment il construit $cocktail_ingredient_entity ?
					if($objCocktailIngredient->cocktail_ingredient_quantity !== $arrIngredient["cocktail_ingredient_quantity"]){
                        $this->where('cocktail_ingredient_cocktail_id', $arrIngredient["cocktail_ingredient_cocktail_id"])
                          ->where("cocktail_ingredient_ingredient_id", $ingredient_model->addIngredient($arrIngredient["ingredient_name"]))
                          ->update($cocktail_ingredient_entity);
                    }*/
                }
                //if cocktail_ingredient doesn't exists
            }
        }
    }
    public function getCocktailIngredientById($id)
    {

        $test = $this->where('cocktail_ingredient_cocktail_id', $id)->findAll();



        $result = array();
        $ingredient_model = new Ingredient_model;
        $result = $ingredient_model->getIngredientNameById($test);


        $arrIngredient = array();
        foreach ($test as $key1 => $value1) {
            foreach ($result as $key2 => $value2) {
                if ($value1->cocktail_ingredient_ingredient_id == $value2->ingredient_id) {
                    $arrIngredient[$value1->cocktail_ingredient_ingredient_id][$value2->ingredient_name]  = $value1->cocktail_ingredient_quantity;
                    // var_dump($value1->cocktail_ingredient_ingredient_id);
                    // var_dump($value2->ingredient_name);
                    // var_dump($value1->cocktail_ingredient_quantity);

                }
            }
        }
        //var_dump($arrIngredient);die;


        return $arrIngredient;
    }
}