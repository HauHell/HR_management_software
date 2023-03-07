<?php
namespace App\Models;
use CodeIgniter\Model;
class ChamCongModel extends Model
{
    protected $table = 'bangchamcong';
    protected $primaryKey ='nMaChamCong';
    protected $allowedFields = [
        'nMaNV','fSoNgayCong','fGioTangCa','fSoNgayNghi','dNgayThang', 'vGhiChuC',
    ];
    public function getChamCongNV(){
        return $this->db->table($this->table)->join('nhanvien','bangchamcong.nMaNV = nhanvien.nMaNV')
        ->get()->getResult('array');
    }
    public function getNhanVienChuaChamCong() {
        $thang =getdate();
        $nvchuachamcong = $this->db->table($this->table)->select('nMaNV')->
        where('Month(dNgayThang)=',$thang['mon'])->get()->getResult('array');
        $arr_nv = array();
        foreach ($nvchuachamcong as $key => $nv) {
            foreach ($nv as $nv2) {
                array_push($arr_nv, $nv2);
            }
        }
        return $this->db->table($this->table)->join('nhanvien', 'nhanvien.nMaNV = bangchamcong.nMaNV', 'right')
        ->whereNotIn('nhanvien.nMaNV', $arr_nv)->get()->getResult('array');
    }
   
}