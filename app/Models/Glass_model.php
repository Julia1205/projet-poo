<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Entities\Glass_entity;

class Glass_model extends Model{
    protected $table         = 'glass';
    // Nom du champ de la clé primaire
    protected $primaryKey    = 'glass_id';
    // Champs utilisables
    protected $allowedFields = ['glass_name'];
 
    // Type de retour => Chemin de l'entité à utiliser
    protected $returnType    = 'App\Entities\Glass_entity';
 
    // Utilisation ou non des dates (création / modification)
    protected $useTimestamps = false;

    public function returnGlassId($strGlassName)
    {
        $exists = $this->where('glass_name', $strGlassName)->first();
        if($exists !== null){
            return $exists->glass_id;
        }else{
            $data = [
                'glass_name' => $strGlassName,
            ];
            $validInsert = $this->insert($data, false);
            if($validInsert){
                $idInserted = $this->getInsertID();
                return $idInserted;
            }
        }
    }
}