<?php

namespace App\Models;

use CodeIgniter\Model;
    
class AuthModel extends Model
{
    protected $table = 'tb_login_peserta';
    protected $allowedFields = ['sandi', 'email', 'pass_updated_at'];
    
}
