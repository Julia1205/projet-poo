<?php
namespace App\Models;
use CodeIgniter\Model;

class Rank_model extends Model{
    protected $table         = 'rank';
    // Nom du champ de la clé primaire
    protected $primaryKey    = 'rank_id';
    // Champs utilisables
    protected $allowedFields = ['rank_name'];
 
    // Type de retour => Chemin de l'entité à utiliser
    protected $returnType    = 'App\Entities\Rank_entity';
 
    // Utilisation ou non des dates (création / modification)
    protected $useTimestamps = true;
}