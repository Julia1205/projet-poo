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
 use App\Models\UserModel;
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

    public function registerUser(): void
    {
        
        
    }
    

    /**
     *
     */
    public function updateUser(): void
    {
        
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
    
    public function myAccount()
    {

        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => "Dashboard",
            'userInfo' => $userInfo,
            'user_pseudo' => $userInfo['user_pseudo'],
            'user_mail' => $userInfo['user_mail']
        ];

        $validated = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Your name is required',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Your mail is required',
                    'valid_email' => 'Your mail need to be valid',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[10]',
                'errors' => [
                    'required' => 'A password is required',
                    'min_length' => 'Your password must be 5 charactars long',
                    'max_length' => 'Your password must be less than 10 charactars long'
                ],
            ],
            'password_conf' => [
                'rules' => 'required|min_length[5]|max_length[10]|matches[password]',
                'errors' => [
                    'required' => 'A password is required',
                    'min_length' => 'Your password must be 5 charactars long',
                    'max_length' => 'Your password must be less than 10 charactars long',
                    'matches' => 'Your confirmation password should match with your password'
                ],
            ]
        ]);

        $this->_data['array'] = $data;
        return  $this->display('user/account.tpl');

    }
}
