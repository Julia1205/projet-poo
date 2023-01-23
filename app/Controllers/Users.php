<?php
/**
 * @file Users.php
 * @version 1.0.0
 * @brief Controller des utilisateurs
 * @details
 * <p>
 * Cette classe permet de gérer les actions des utilisateurs</p>
 * <p> Ces actions sont : 
 * <ul>
 *  <li><strong>addUser</strong> : page d'inscription
 *  <li><strong>updateUser</strong> : page de mise des informations de l'utilisateur
 *  <li><strong>connectUser</strong> : page de connexion
 *  <li><strong>disconnectUser</strong> : méthode de déconnexion
 * </ul>
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
        $validation =  \Config\Services::validation();
    }

    /**
     *
     */
    public function addUSer(): void
    {
        $arrErrors = array();
        $validation =  \Config\Services::validation();
        if($this->_session->get('user_id') == NULL){ //checking if the user isn't already connected
            $validation->setRules([
                'user_email' => 
                [
                    'label'  => 'e-mail',
                    //adding the validation rules
                    'rules'  => 'required|valid_email|is_unique[user.user_mail]',
                    //adding the error messages for each validation rule
                    'errors' => [
                        'required' => 'Le {field} est obligatoire',
                        'valid_email' => 'Le {field} doit être au format valide',
                        'is_unique' => 'Merci d\'utiliser une autre adresse mail',
                    ],
                ],
                'user_password' => 
                [
                    'label'  => 'mot de passe',
                    'rules'  => 'required|max_length[30]|min_length[5]',
                    'errors' => [
                        //Attribution des messages d'erreurs individualisés pour chaque condition
                        'max_length' => 'Le {field} doit être de maximum trente caractères',
                        'min_length' => 'Le {field} doit être de minimum de cinq caractères',
                        'required' => 'Le {field} doit être rempli',
                    ],
                ],
            ]);
            if(count($this->request->getPost())  > 0){ //checking if the form is submitted and has no errors
                //checking user credentials
                if($boolCanConnect){

                }else{ // if it's not possible to connect the user
                    $arrErrors[] = 'Connexion impossible';
                }
            }else{ //if the form has errors
                $arrErrors = $validation->getErrors();
            }
        
        $arrAttributesUsernameInput = 
        [
            'name' => 'username',
            'id' => 'username',
            'class' => 'form-control form-control-lg',
            //'value' => ,
            'type' => 'text',
        ];
        $arrAttributesLabel = 
        [
            'class' => 'form-label',
        ];
        $this->_data['form_open'] = form_open("/login");
        $this->_data['form_username'] = form_input($arrAttributesUsernameInput);
        $this->_data['form_close'] = form_close();
        $this->_data['arrErrors'] = $arrErrors;
        $this->_data['title'] = "Create an account";
        $this->display('user/register.tpl'); //redirecting to the template
        }else{
            $this->_data['title'] = "You're already connected";
            $this->display('errors/alreadyconnected.tpl');
        }
    }

    /**
     *
     */
    public function updateUser(): void
    {
        # code...
        //redirige vers la fiche utilisateur
        $this->_data['title'] = "My account";
        $this->display('user/account.tpl');
    }

    /**
     *
     */
    public function connectUser(): void
    {
        
        var_dump($this->_session->get('user_id'));
        # code...
        $arrAttributesUsernameInput = 
        [
            'name' => 'username',
            'id' => 'username',
            'class' => 'form-control form-control-lg',
            //'value' => ,
            'type' => 'text',
        ];
        $arrAttributesPasswordInput = 
        [
            'name' => 'pwd',
            'id' => 'pwd',
            'class' => 'form-control form-control-lg',
            'type' => 'password',
        ];
        $arrAttributesLabel = 
        [
            'class' => 'form-label',
        ];
        $this->_data['form_open'] = form_open("/login");
        $this->_data['form_username'] = form_input($arrAttributesUsernameInput);
        $this->_data['label_username'] = form_label('Your username', 'username', $arrAttributesLabel);
        $this->_data['form_pwd'] = form_input($arrAttributesPasswordInput);
        $this->_data['label_password'] = form_label('Your password', 'pwd', $arrAttributesLabel);
        $this->_data['form_submit' ]= form_submit("submit", "Login", "class='btn btn-purple btn-block btn-lg text-body'");
        $this->_data['form_close'] = form_close();
        //redirige vers page de connexion
        $this->_data['title'] = "Login";
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
        $this->_data['title'] = "Home";
        $this->display('home/home.tpl');
    }
}
