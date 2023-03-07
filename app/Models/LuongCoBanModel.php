<?php

namespace App\Models;

use CodeIgniter\Model;

class LuongCoBanModel extends Model
{
    protected $table = 'luongcoban';
    protected $primaryKey ='nMaLuongCB';
    protected $allowedFields = [
        'nMaNV','dNgayThayDoi','fSoTienLuongCB','nThamNien'
    ];

    public function getNhanVien() {
        return $this->db->table($this->table)->join('nhanvien','luongcoban.nMaNV = nhanvien.nMaNV')
        ->get()->getResult('array');
    }
    public function getNhanVienChuaCoLuong() {
        $nvcoluong = $this->db->table($this->table)->select('nMaNV')->get()->getResult('array');
        $arr_nv = array();
        foreach ($nvcoluong as $key => $nv) {
            foreach ($nv as $nv2) {
                array_push($arr_nv, $nv2);
            }
        }
        return $this->db->table($this->table)->join('nhanvien', 'nhanvien.nMaNV = luongcoban.nMaNV', 'right')
        ->whereNotIn('nhanvien.nMaNV', $arr_nv)->get()->getResult('array');
    }
   
}