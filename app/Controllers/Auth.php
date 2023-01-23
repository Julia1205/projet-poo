<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;

class Auth extends BaseController
{

    public function __construct()
    {
        helper('url', 'form');
    }

    public function index()
    {
        $this->_data['title'] = "S'inscrire";
        $this->display('user/register.tpl');
    }
    
    public function registerUser()
    {
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
        
        if (!$validated) {
            $this->_data['title'] = "S'inscrire";
            $this->_data['validation'] = $this->validator;
           return  $this->display('user/register.tpl');
        }

        $name = $this->request->getPost('name');
        $mail = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $password_confirm = $this->request->getPost('password_conf');

        $data = [
            'user_pseudo' => $name,
            'user_pwd' => Hash::encrypt($password),
            'user_mail' => $mail,
            'user_rank' => 1,
            'user_created_at' => date('Y-m-d h:i:s'),
            'user_updated_at' => date('Y-m-d h:i:s'),
        ];

        $userModel = new \App\Models\UserModel();
        $query = $userModel->insert($data);

        if ($query){
            return  $this->display('home/home.tpl');
        }else{
            return $this->display('user/register.tpl');
        }

        $array = [$name, $mail, $password, $password_confirm];
        $this->_data['title'] = "S'inscrire";
        $this->_data['array'] = $array;
        return  $this->display('user/register.tpl');
    }
}
