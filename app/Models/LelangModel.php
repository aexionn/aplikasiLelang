<?php

namespace App\Models;

use CodeIgniter\Model;

class LelangModel extends Model 
{
    protected $table='tb_lelang';
    protected $primaryKey='id_lelang';
    protected $allowedFields = ['id_barang', 'tgl_lelang', 'id_user', 'harga_akhir', 'id_petugas', 'id_pemilik', 'tgl_akhir', 'status'];
}