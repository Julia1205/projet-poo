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
    protected $allowedFields = ['cocktail_ingredient_cocktail_id', 'cocktail_ingredient_ingredient_id', 'cocktail_ingredient_quantity'];
 
    // Type de retour => Chemin de l'entité à utiliser
    protected $returnType    = 'App\Entities\Cocktail_ingredient_entity';
 
    // Utilisation ou non des dates (création / modification)
    protected $useTimestamps = false;

    public function addCocktailIngredient($arrCocktailIngredients)
    {
        var_dump($arrCocktailIngredients);
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
                    //var_dump($cocktail_ingredient_entity);
                    $this->save($cocktail_ingredient_entity);
                }else{// if there is already this ingredient for this cocktail
                    if($objCocktailIngredient->cocktail_ingredient_quantity !== $arrIngredient["cocktail_ingredient_quantity"]){
                        $this->where('cocktail_ingredient_cocktail_id', $arrIngredient["cocktail_ingredient_cocktail_id"])
                          ->where("cocktail_ingredient_ingredient_id", $ingredient_model->addIngredient($arrIngredient["ingredient_name"]))
                          ->update($cocktail_ingredient_entity);
                    }
                }
                //if cocktail_ingredient doesn't exists
                var_dump($arrIngredient);
            }
        }

    }
}