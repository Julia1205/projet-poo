<?php
/**
 * @file Users.php
 * @version 1.0.0
 * @brief Controller des utilisateurs
 */

 //namespace App\Controllers;
// use App\Controller\BaseController;
 //use CodeIgniter\Controller;
 
 namespace App\Controllers;
 use App\Models\Users_model;
 use App\Entities\Users_entity;

class Users extends BaseController
{
    public function __construct()
    {
        # code...
    }

    /**
     *
     */
    public function addUSer(): void
    {
        # code...
        //Redirige vers register
        $this->display('user/register.tpl');
    }

    /**
     *
     */
    public function updateUser(): void
    {
        # code...
        //redirige vers la fiche utilisateur
        $this->display('user/account.tpl');
    }

    /**
     *
     */
    public function connectUser(): void
    {
        # code...
        //redirige vers page de connexion
        $this->display('user/login.tpl');
        //Ou home si connexion réussie
        //$this->display('home/home.tpl');
    }

    /**
     *
     */
    public function disconnectUser(): void
    {
        # code...
        //On redirige vers home quand déconnecté
        $this->display('home/home.tpl');
    }
}
