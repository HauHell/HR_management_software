<?php
namespace App\Models;
use CodeIgniter\Model;
class DongBaoHiemModel extends Model
{
    protected $table = 'quatrinhdongbh';
    protected $primaryKey ='nID';
    protected $allowedFields = [
        'nMaNV','nTienDongBH','dThoiGianDong',
    ];
    public function getBaoHiem() {
        return $this->db->table($this->table)->join('nhanvien','quatrinhdongbh.nMaNV = nhanvien.nMaNV')
        ->get()->getResult('array');
    }

    public function getNhanVienChuaDongBH() {
        $nvchuadongbh = $this->db->table($this->table)->select('nMaNV')->get()->getResult('array');
        $arr_nv = array();
        foreach ($nvchuadongbh as $key => $nv) {
            foreach ($nv as $nv2) {
                array_push($arr_nv, $nv2);
            }
        }
        return $this->db->table($this->table)->join('nhanvien', 'nhanvien.nMaNV = quatrinhdongbh.nMaNV', 'right')
        ->whereNotIn('nhanvien.nMaNV', $arr_nv)->get()->getResult('array');
    }
}