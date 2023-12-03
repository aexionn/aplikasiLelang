<?php
namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\AuthModel;
use CodeIgniter\I18n\Time;

class UserContr extends BaseController
{
    public function index()
    {
        $session = session();
        $clientModel = model(ClientModel::class);
        $id_login = $session->get('id_login');
        $data = [
            'user' => $clientModel->select('*')->join('tb_login_peserta', 'tb_login_peserta.id_login = tb_masyarakat.id_login', 'inner')->where('tb_masyarakat.id_login', $id_login)->findAll(),
            'validation' => \Config\Services::validation(),
            'title' => 'User Profile'
        ];
       return view('UserProfile', $data);
    }

    public function editProfile($id)
    {
        $rules = [
            'nama'  => [
                'label'  => 'nama',
                'rules'  => 'required', 'min_length[4]', 'max_length[50]', 
                'errors' => [
                    'required' => 'Harap Isi Nama Anda',
                    'min_length[4]' => 'Nama Anda Harus Lebih dari 4 Karakter',
                    'max_length[50]' => 'Nama Anda Harus Kurang Dari 50 Karakter'
                ]
            ],

            'email'  => [
                'label'  => 'email',
                'rules'  => 'required', 'min_length[4]', 'max_length[50]', 'valid_email', 'is_unique[user.email]',
                'errors' => [
                    'required' => 'Harap Isi Nama Anda',
                    'min_length[4]' => 'Nama Anda Harus Lebih dari 4 Karakter',
                    'max_length[50]' => 'Nama Anda Harus Kurang Dari 50 Karakter',
                    'valid_email' => 'Harap Masukan Email Anda',
                    'is_unique[user.email]' => 'Email Ini Sudah Terpakai',
                ]
            ],

            'alamat'  => [
                'label'  => 'alamat',
                'rules'  => 'required', 'min_length[10]', 'max_length[120]',
                'errors' => [
                    'required'          => 'Harap Isi Alamat Anda',
                    'min_length[10]'     => 'Alamat Anda Harus Lebih dari 10 karakter',
                    'max_length[120]'    => 'Alamat Anda Tidak Boleh Lebih dari 120 karakter',
                ]
            ],

            'telp'  => [
                'label'  => 'telp',
                'rules'  => 'required', 'is_natural',
                'errors' => [
                    'required' => 'No Telpon harus diisi',
                    'is_natural' => 'No Telp Hanya dapat berisi angka',
                ]
            ],
        ];
        
        // dd($data);
        // dd($authModel->where('id_login', $id));

        if(!$this->validate($rules)){
            return redirect()->to('/user')->with('gagal', 'Data gagal diubah'); 
        }

        $clientModel = model(ClientModel::class);
        $authModel = model(AuthModel::class);
        $post = $this->request->getPost();
        // dd($post);

        $data = [
            'nama' => $post['nama'],
            'alamat' => $post['alamat'],
            'telp' => $post['telp']
        ];

        $authModel->set('email', ['email' =>  $post['email']])->where('id_login', $id)->update();
        $clientModel->set($data)->where('id_login', $id)->update();
        return redirect()->to('/user')->with('sukses', 'Data berhasil diubah'); 
    }

    public function editPassword($id)
    {
        $passUpdate = Time::now('Asia/Shanghai');
        $rules = [
            'oldpassword'  => [
                'label'  => 'OldPassword',
                'rules'  => 'required',
                'errors' => ['required' => 'Harap Isi Kata Sandi Lama Anda']
            ],
            'newpassword'  => [
                'label'  => 'NewPassword',
                'rules'  => 'required', 'min_length[4]', 'max_length[20]',
                'errors' => [
                    'required'          => 'Harap Isi Kata Sandi Baru Anda',
                    'min_length[4]'     => 'Kata Sandi Anda Yang Baru Harus Lebih dari 4 karakter',
                    'max_length[50]'    => 'Kata Sandi Anda Yang Baru Tidak Boleh Lebih dari 20 karakter',
                ]
            ],
            'confpass'  => [
                'label'  => 'ConfPassword',
                'rules'  => 'matches[password]',
                'errors' => ['matches[confpass]' => 'Kata Sandi Tidak Sama dengan Kata Sandi Baru']
            ],
        ];
        
        if(!$this->validate($rules)){
            return redirect()->to('/user')->with('gagal', 'Kata Sandi gagal diubah'); 
        }
        
        $data = $this->request->getPost();
        $model = model(AuthModel::class);
        $builder = $model->table('tb_login_peserta');
        $passDb = $builder->select('sandi')->where('id_login', $id)->first();
        // dd($passDb);

        if(password_verify($data['oldpassword'], $passDb['sandi'])){
            $dataUser = [
                'sandi'   => password_hash($data['newpassword'], PASSWORD_DEFAULT),
                'pass_updated_at' => $passUpdate,
            ];
            // var_dump($dataUser);
            $model->update($id_user, $dataUser);
            return redirect()->to('/user')->with('sukses', 'Kata Sandi berhasil diubah'); 
        } else{
            return redirect()->to('/user')->with('gagal', 'Kata Sandi gagal diubah'); 
        }
    }
}