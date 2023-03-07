<?php
namespace App\Models;
use CodeIgniter\Model;
class DoanhThuModel extends Model
{
    protected $table = 'doanhthu';
    protected $primaryKey ='nMaDT';
    protected $allowedFields = [
        'nMaNV','nSLSP', 'fDoanhThu','dNgayThang','vGhiChuD',
    ];
    public function getDoanhThu() {
        return $this->db->table($this->table)->join('nhanvien','doanhthu.nMaNV = nhanvien.nMaNV')
        ->get()->getResult('array');
    }

    public function getNhanVienChuaDoanhThu() {
        $thang =getdate();
        $nvchuadoanhthu = $this->db->table($this->table)->select('nMaNV')->where('Month(dNgayThang)=',$thang['mon'])->
        get()->getResult('array');
        $arr_nv = array();
        foreach ($nvchuadoanhthu as $key => $nv) {
            foreach ($nv as $nv2) {
                array_push($arr_nv, $nv2);
            }
        }
        return $this->db->table($this->table)->join('nhanvien', 'nhanvien.nMaNV = doanhthu.nMaNV', 'right')
        ->whereNotIn('nhanvien.nMaNV', $arr_nv)->get()->getResult('array');
    }
   
}