<?php
namespace App\Models;
use CodeIgniter\Model;

class Glass_model extends Model{
    protected $table         = 'user';
    // Nom du champ de la clé primaire
    protected $primaryKey    = 'user_id';
    // Champs utilisables
    protected $allowedFields = ['user_pseudo', 'user_pwd', 'user_mail', 'user_rank', 'user_created_at', 'user_updated_at'];
 
    // Type de retour => Chemin de l'entité à utiliser
    protected $returnType    = 'App\Entities\User_entity';
 
    // Utilisation ou non des dates (création / modification)
    protected $useTimestamps = true;
}