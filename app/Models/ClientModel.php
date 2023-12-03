<?php

namespace App\Models;

use CodeIgniter\Model;
    
class ClientModel extends Model
{
    protected $table = 'tb_masyarakat';
    protected $allowedFields = ['nama', 'alamat', 'telp', 'foto_ktp', 'foto_npwp', 'foto_rek'];
    
}