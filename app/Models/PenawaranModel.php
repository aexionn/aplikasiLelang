<?php

namespace App\Models;

use CodeIgniter\Model;

class PenawaranModel extends Model 
{
    protected $table='tb_penawaran';
    protected $primaryKey='id_penawaran';
    protected $allowedFields = ['id_penawaran', 'id_lelang', 'id_user', 'penawaran'];
}