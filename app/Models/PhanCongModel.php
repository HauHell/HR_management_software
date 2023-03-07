<?php
namespace App\Models;
use CodeIgniter\Model;
class PhanCongModel extends Model
{
    protected $table = 'phancong';
    protected $primaryKey ='nID';
    protected $allowedFields = [
        'nMaNV','nMaCV', 'nMaPB','dThoiGian','bTrangThai',
    ];
    public function getPhanCong() {
        return $this->db->table($this->table)->join('nhanvien','phancong.nMaNV = nhanvien.nMaNV')
        ->join('chucvu','phancong.nMaCV = chucvu.nMaCV')->join('phongban','phancong.nMaPB = phongban.nMaPB')->get()->getResult('array');
    }

    public function getQuaTrinhPhanCong($id) {
        return $this->db->table($this->table)->join('nhanvien','phancong.nMaNV = nhanvien.nMaNV')
        ->join('chucvu','phancong.nMaCV = chucvu.nMaCV')->join('phongban','phancong.nMaPB = phongban.nMaPB')->where('phancong.nMaNV'.$id)
        ->get()->getResult('array');
    }


    public function getNhanVienChuaPhanCong() {
        $nvphancong = $this->db->table($this->table)->select('nMaNV')->get()->getResult('array');
        $arr_nv = array();
        foreach ($nvphancong as $key => $nv) {
            foreach ($nv as $nv2) {
                array_push($arr_nv, $nv2);
            }
        }
        return $this->db->table($this->table)->join('nhanvien', 'nhanvien.nMaNV = phancong.nMaNV', 'right')->
        whereNotIn('nhanvien.nMaNV', $arr_nv)->get()->getResult('array');
    }
}