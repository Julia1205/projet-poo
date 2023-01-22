<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Entities\Cocktails_entity;
use App\Entities\Glass_entity;
use App\Models\Glass_model;

use App\Entities\Ingredient_entity;
use App\Models\Ingredient_model;
use App\Entities\Cocktails_ingredient_entity;
use App\Models\Cocktail_ingredient_model;



class Cocktails_model extends Model{
    protected $table         = 'cocktail';
		// Nom du champ de la clé primaire
		protected $primaryKey    = 'cocktail_id';
		// Champs utilisables
		protected $allowedFields = ['cocktail_name', 
                                    'cocktail_is_alcoholic', 
                                    'cocktail_img', 
                                    'cocktail_receipe', 
                                    'cocktail_is_archived', 
                                    'cocktail_is_moderated', 
                                    'cocktail_glass_id', 
                                    'cocktail_created_at', 
                                    'cocktail_updated_at', 
                                    'cocktail_id_api', 
                                    'cocktail_user_id',
                                    'cockail_updated_user_id'
                                    ];
	 
		// Type de retour => Chemin de l'entité à utiliser
		protected $returnType    = 'App\Entities\Cocktails_entity';
	 
		// Utilisation ou non des dates (création / modification)
		protected $useTimestamps = true;
        protected $dateFormat    = 'datetime';
        protected $createdField  = 'cocktail_created_at';
        protected $updatedField  = 'cocktail_updated_at';
        protected $deletedField  = 'cocktail_deleted_at';

    public function addCocktail($arrCocktailToSave)
    {
        $arrErrors = "";
        //initializing cocktail object
        $cocktail_entity = new Cocktails_entity;
        $cocktail_entity->fill($arrCocktailToSave);
        $exists = $this->where('cocktail_name', $cocktail_entity->cocktail_name)->first(); //query to check if the cocktail exists
        if($exists == null){ //if it doesn't already exists
            $boolCocktailInserted = $this->save($cocktail_entity, false); //saving cocktail object, returning false if not inserted
            if($boolCocktailInserted){//if cocktail is inserted, retrieving the ID
                return $this->getInsertID();
            }else{
                $arrErrors += "Oops, l'update des cocktails n'a pas fonctionné!";
            }
        }else{
            return $exists->cocktail_id;
        }
    }

    public function getCocktailByID($intId)
    {
        $objCocktail = $this->where('cocktail_id', $intId)->first();
        return $objCocktail;
    }
}