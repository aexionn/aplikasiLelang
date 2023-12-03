<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\ClientModel;

class AuthContr extends BaseController
{
    public function index(){
        $data = [
            'email' => $this->request->getVar(),
            'title' => "Register"
        ]; 
        session()->set($data['email']);
        
        return view('auth/Register', $data);     
    }

    public function login()
    {
        $data['title'] = "Login";
        return view('auth/Login', $data);
    }

    public function registStore()
    {
        $db = \Config\Database::connect();
        helper('form');
        $authModel = model(AuthModel::class);

        $rules = [
            'email'     => ['required', 'min_length[4]', 'max_length[100]', 'valid_email', 'is_unique[tb_login_peserta.email]'],
            'password'  => ['required', 'min_length[4]', 'max_length[50]'],
        ];
        $data = $this->request->getPost();

        if ($this->validate($rules)) {
            $post = [
                'email' => $data['email'],
                'sandi' => password_hash($data['password'], PASSWORD_DEFAULT),
            ];

            $authModel->insert($post);
            // session()->set($db->insertID());

            return redirect()->to('/login');
        }else{
            session()->setFlashData('regMsg', "Gagal Registrasi");
            return redirect()->back();
        }
    }

    public function logPros()
    {
        $session = session();
        $model = model(AuthModel::class);
        $userModel = model(ClientModel::class);
        $post = $this->request->getPost();        
        $data = $model->where('email', $post['email'])->first();
        
        if ($data){
            if(password_verify($post['password'], $data['sandi'])){
                $dbData = $userModel->where('id_login', $data['id_login'])->first();
                $ses_data = [
                    'email'    => $data['email'],
                    'id_login' => $data['id_login'],
                    'id_user' => $dbData['id_user'],
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            } else{ 
                $session->setFlashdata('logMsg', 'Kata Sandi Salah');
                return redirect()->back();
            }
        } else{
            $session->setFlashdata('logMsg', 'Nama Tidak ditemukan');
            return redirect()->back();
        }
    }

    public function logout()
    {
        $session = session();
        $session->remove('email');
        return redirect()->to('/login');
    }
}

?>