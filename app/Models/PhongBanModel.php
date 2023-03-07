<?php

namespace App\Models;

use CodeIgniter\Model;

class PhongBanModel extends Model
{
    protected $table = 'phongban';
    protected $primaryKey ='nMaPB';
    protected $allowedFields = [
        'vTenPB','vDiaChi', 'vGhiChu',
    ];
   
}