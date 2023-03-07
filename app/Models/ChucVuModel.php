<?php

namespace App\Models;

use CodeIgniter\Model;

class ChucVuModel extends Model
{
    protected $table = 'chucvu';
    protected $primaryKey ='nMaCV';
    protected $allowedFields = [
        'vTenCV','fPhuCap', 'vGhiChu',
    ];
}