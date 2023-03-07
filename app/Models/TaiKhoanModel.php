<?php
namespace App\Models;
use CodeIgniter\Model;
class TaiKhoanModel extends Model
{
    protected $table = 'taikhoan';
    protected $primaryKey ='nID';
    protected $allowedFields = [
        'vUserName','vEmail' ,'vPassword', 'vImageLogin','vRole',
    ];
    
}