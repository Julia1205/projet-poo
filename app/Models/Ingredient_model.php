<?php
namespace App\Models;
use CodeIgniter\Model;

class Ingredient_model extends Model{
    protected $table         = 'ingredient';
    // Nom du champ de la clé primaire
    protected $primaryKey    = 'ingredient_id';
    // Champs utilisables
    protected $allowedFields = ['ingredient_name'];
 
    // Type de retour => Chemin de l'entité à utiliser
    protected $returnType    = 'App\Entities\Ingredient_entity';
 
    // Utilisation ou non des dates (création / modification)
    protected $useTimestamps = false;

    public function addIngredient($strIngredientName)
    {
        //var_dump($objIngredient);die;
        $exists = $this->where('ingredient_name', $strIngredientName)->first();
        //var_dump($exists);
        if($exists !== null){
            $result = $exists->ingredient_id;
            return $result;
        }else{
            $data = [
                'ingredient_name' => $strIngredientName,
            ];
            $validInsert = $this->insert($data, false);
            if($validInsert){
                $idInserted = $this->getInsertID();
                //var_dump($idInserted);
                return $idInserted;
            }
        }
    }
    public function getIngredientNameById($id)
    {
        $arrObjIngredient = array();
        foreach ($id as $key => $value) {
            //var_dump($id[$key]->cocktail_ingredient_ingredient_id);
            $arrObjIngredient[] = $this->where('ingredient_id', $id[$key]->cocktail_ingredient_ingredient_id)->first();

        }
        return $arrObjIngredient;

    }
}