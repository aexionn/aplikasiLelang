<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\LelangModel;
use App\Models\PenawaranModel;
use CodeIgniter\Files\File;

class LelangContr extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {
        return view('LandingPage');
    }

    // public function rupiah($angka, $decimal = 0)
    // {
    //   $angka = !!$angka ? $angka : 0;
    //   $hasil_rupiah = "Rp. " . number_format($angka, $decimal, ',', '.');
    //   return $hasil_rupiah;
    // }

    public function dashboard()
    {
        helper('number');
        $id = session()->get('id_login');
        $pager = \Config\Services::pager();
        $clientModel = model(ClientModel::class);
        $lelangModel = model(LelangModel::class);
        $data = [
            'title' => 'Dashboard',
            'user'  => $clientModel->select('*')
                            ->join('tb_login_peserta', 'tb_login_peserta.id_login = tb_masyarakat.id_login', 'inner')
                            ->where('tb_masyarakat.id_login', $id)->findAll(),
            'lelang'=> $lelangModel-> select('*')
                            ->join('tb_barang', 'tb_barang.id_barang = tb_lelang.id_barang', 'inner')
                            ->join('tb_pemilik', 'tb_pemilik.id_pemilik = tb_barang.id_pemilik', 'inner')
                            ->where('status', 'Dibuka')->paginate(3, 'lelang'),
            'pager' => $lelangModel->pager,
        ];
        
        return view('Dashboard', $data);
    }

    public function infoBarang($id_lelang)
    {
        helper('number');
        $id = session()->get('id_login');
        $clientModel = model(ClientModel::class);
        $lelangModel = model(LelangModel::class);
        $data = [
            'title'  => 'Info Barang',
            'user'   => $clientModel->select('*')
                            ->join('tb_login_peserta', 'tb_login_peserta.id_login = tb_masyarakat.id_login', 'inner')
                            ->where('tb_masyarakat.id_login', $id)->findAll(),
            'lelang' => $lelangModel->select('*')
                                ->join('tb_barang', 'tb_barang.id_barang = tb_lelang.id_barang')
                                // ->join('tb_penawaran', 'tb_penawaran.id_lelang = tb_lelang.id_lelang')
                                // ->join('tb_masyarakat', 'tb_masyarakat.id_user = tb_penawaran.id_user')
                                // ->join('tb_petugas', 'tb_petugas.id_petugas = tb_lelang.id_petugas')
                                ->join('tb_pemilik', 'tb_pemilik.id_pemilik = tb_barang.id_pemilik')
                                ->join('tb_detail_barang', 'tb_detail_barang.id_detail = tb_barang.id_detail')
                                ->where('tb_lelang.id_lelang', $id_lelang) ->findAll()
        ];
        // dd($data);
        return view('InfoBarang', $data);
    }

    public function userProfile()
    {
       return view('UserProfile');
    }

    public function auctionPage($id_lelang)
    {
        helper('number');
        $id = session()->get('id_login');
        $clientModel = model(ClientModel::class);
        $penawaranModel = model(PenawaranModel::class);
        $where = "tb_penawaran.id_lelang = '$id_lelang' AND tb_penawaran.id_user = '" . session()->get('id_user') . "'";
        $data = [
            'title'  => 'Halaman Lelang',
            'validation' => \Config\Services::validation(),
            'user'   => $clientModel->select('*')
                            ->join('tb_login_peserta', 'tb_login_peserta.id_login = tb_masyarakat.id_login', 'inner')
                            ->where('tb_masyarakat.id_login', $id)->findAll(),
            'lelang' => $penawaranModel->select('*, MAX(penawaran) AS largestbid')
                            ->join('tb_lelang', 'tb_lelang.id_lelang = tb_penawaran.id_lelang', 'inner')
                            ->join('tb_barang', 'tb_barang.id_barang = tb_lelang.id_barang', 'inner')
                            ->join('tb_detail_barang', 'tb_detail_barang.id_detail = tb_barang.id_detail', 'inner')
                            ->join('tb_pemilik', 'tb_pemilik.id_pemilik = tb_barang.id_pemilik', 'inner')
                            ->where($where)->groupBy('tb_penawaran.id_penawaran')->findAll()
        ];
        // dd($data);
        return view('AuctionPage', $data);
    }

    public function search()
    {
        helper('number');
        $pager = \Config\Services::pager();
        $model = model(LelangModel::class);
        $clientModel = model(ClientModel::class);
        $kata_kunci = $this->request->getVar('cari');
        // $query = $model->query("SELECT * FROM diary INNER JOIN kategori ON diary.id_kategori=kategori.id_kategori WHERE title LIKE '%" . $kata_kunci . "%'"); 

        if (!empty($kata_kunci)) {
            $data = [
                'user'  => $clientModel->select('*')
                            ->join('tb_login_peserta', 'tb_login_peserta.id_login = tb_masyarakat.id_login', 'inner')
                            ->where('tb_masyarakat.id_login', session()->get('id_login'))->findAll(),
                'lelang'=> $model->select('*')
                            ->join('tb_barang', 'tb_barang.id_barang = tb_lelang.id_barang', 'inner')
                            ->join('tb_pemilik', 'tb_pemilik.id_pemilik = tb_barang.id_pemilik', 'inner')
                            ->where('status', 'Dibuka')->like('nama_barang', $kata_kunci)->orLike('harga_awal', $kata_kunci)->paginate(3, 'lelang'),
                'pager' => $model->pager,
                'title' => 'Hasil Pencarian'
            ];
        } else {
            $data['lelang'] = array();
            redirect()->to()->back();
        }
        $data['kata_kunci'] = $kata_kunci;
        return view('SearchRes', $data);
    }

    public function history()
    {
        helper('number');
        $pager = \Config\Services::pager();
        $clientModel = model(ClientModel::class);
        $arsipModel = model(PenawaranModel::class);
        $where = "tb_penawaran.id_user = '" . session()->get('id_user') . "' AND status_pemenang = '1' OR status_pemenang = '0'";
        $data = [
            'title' => 'Histori Lelang',
            'user'  => $clientModel->select('*')
                            ->join('tb_login_peserta', 'tb_login_peserta.id_login = tb_masyarakat.id_login', 'inner')
                            ->where('tb_masyarakat.id_login', session()->get('id_login'))->findAll(),
            'histori'=> $arsipModel->select('tb_penawaran.*, tb_barang.*, tb_pemilik.alamat, MAX(penawaran) AS largestbid')
                            ->join('tb_lelang', 'tb_lelang.id_lelang = tb_penawaran.id_lelang', 'inner')
                            ->join('tb_barang', 'tb_barang.id_barang = tb_lelang.id_barang', 'inner')
                            ->join('tb_pemilik', 'tb_pemilik.id_pemilik = tb_barang.id_pemilik', 'inner')
                            ->where($where)->groupBy('tb_penawaran.id_penawaran')->paginate(3, 'penawaran'),
            'pager' => $arsipModel->pager,
        ];

        return view('Histori', $data);
    }

    public function infohistory()
    {
        helper('number');
        $clientModel = model(ClientModel::class);
        $lelangModel = model(LelangModel::class);
        $data = [
            'title'  => 'Info Histori Barang',
            'user'   => $clientModel->select('*')
                            ->join('tb_login_peserta', 'tb_login_peserta.id_login = tb_masyarakat.id_login', 'inner')
                            ->where('tb_masyarakat.id_login', session()->get('id_login'))->findAll(),
            'lelang' => $lelangModel->select('*')
                                ->join('tb_barang', 'tb_barang.id_barang = tb_lelang.id_barang')
                                // ->join('tb_penawaran', 'tb_penawaran.id_lelang = tb_lelang.id_lelang')
                                ->join('tb_masyarakat', 'tb_masyarakat.id_user = tb_lelang.id_user')
                                // ->join('tb_petugas', 'tb_petugas.id_petugas = tb_lelang.id_petugas')
                                ->join('tb_pemilik', 'tb_pemilik.id_pemilik = tb_barang.id_pemilik')
                                ->join('tb_detail_barang', 'tb_detail_barang.id_detail = tb_barang.id_detail')
                                ->where('tb_lelang.id_lelang', $id_lelang) ->findAll()
        ];
        // dd($data);
        return view('InfoHistori', $data);
    }

    public function lelonprocess()
    {
        helper('number');
        $clientModel = model(ClientModel::class);
        $arsipModel = model(PenawaranModel::class);
        $pager = \Config\Services::pager();
        $where = "tb_penawaran.id_user = '" . session()->get('id_user') . "' AND status_pemenang = 'belum'";
        $data = [
            'title'  => 'Lelang Yang Diikuti',
            'user'   => $clientModel->select('*')
                            ->join('tb_login_peserta', 'tb_login_peserta.id_login = tb_masyarakat.id_login', 'inner')
                            ->where('tb_masyarakat.id_login', session()->get('id_login'))->findAll(),
            'lelang' => $arsipModel->select('tb_penawaran.*, tb_barang.*, tb_pemilik.alamat')
                            ->join('tb_lelang', 'tb_lelang.id_lelang = tb_penawaran.id_lelang', 'inner')
                            ->join('tb_barang', 'tb_barang.id_barang = tb_lelang.id_barang', 'inner')
                            ->join('tb_detail_barang', 'tb_detail_barang.id_detail = tb_barang.id_detail', 'inner')
                            ->join('tb_pemilik', 'tb_pemilik.id_pemilik = tb_barang.id_pemilik', 'inner')
                            ->where($where)->groupBy('tb_penawaran.id_penawaran')->paginate(3, 'onprocess'),
            'pager'  => $arsipModel->pager,
        ];
        // dd($data);
        return view('OnProcess', $data);
    }

    public function auctionProcess($id_lelang)
    {
        $model = model(PenawaranModel::class);
        $validationRule = [
            'ktp' => [
                'label' => 'KTP File',
                'rules' => [
                    'uploaded[ktp]',
                    'is_image[ktp]',
                    'mime_in[ktp,image/jpg,image/jpeg,image/gif,image/PNG,image/webp]',
                    'max_size[ktp,323]',
                    'max_dims[ktp,323,204]',
                ],
            ],
            'npwp' => [
                'label' => 'NPWP File',
                'rules' => [
                    'uploaded[npwp]',
                    'is_image[npwp]',
                    'mime_in[npwp,image/jpg,image/jpeg,image/gif,image/PNG,image/webp]',
                ],
            ],
            'norek' => [
                'label' => 'No Rek File',
                'rules' => [
                    'uploaded[norek]',
                    'is_image[norek]',
                    'mime_in[norek,image/jpg,image/jpeg,image/gif,image/PNG,image/webp]',
                    'max_size[norek,340]',
                    'max_dims[norek,340,340]',
                ],
            ],            
        ];
        if (!$this->validate($validationRule)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        
        $post =  $this->request->getPost();
        // dd($post);
        $img = $this->request->getFiles();
        foreach ($img as $value) {
            $value->move('userImage');
        }

        $data = [
            'id_lelang' => $id_lelang, 
            'id_user' => session()->get('id_user'), 
            'penawaran' => $post['penawaran']
        ];

        if($data['penawaran'] < $post['limit']){
           return redirect()->back()->with('gagal', 'Nilai Penawaran Harus lebih dari Nilai Limit');
        }
        
        $model->insert($data);
        return redirect()->to('/participate'. '/' . $id_lelang)->with('sukses', 'Berhasil Mengikuti Lelang');
    }

    public function cancel($id_lelang)
    {
        $model = model(PenawaranModel::class);
        $where = "id_user = '" . session()->get("id_user") . "' AND id_lelang = '$id_lelang' ";
        $model->where($where)->delete(); 
        return redirect()->to('/dashboard')->with('sukses', 'Data berhasil dihapus');
    }
}
