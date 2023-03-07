<?php
namespace App\Models;
use CodeIgniter\Model;
class BangLuongModel extends Model
{
    protected $table = 'bangluong';
    protected $primaryKey ='nID';
    protected $allowedFields = [
        'nMaNV', 'nMaCV','nMaPB','fLuongCB','fSoNgayCong','fGioTangCa','fPhuCap','fCacKhoanChiBH','fDoanhThu','fThuong'
        ,'fThucLinh','dNgayTinhLuong','vGhiChu',
    ];
    public function getNhanVien() {
        return $this->db->table($this->table)->join('nhanvien','bangluong.nMaNV = nhanvien.nMaNV')-> get()->getResult('array');
    }
    public function getNhanVienChuaTinhLuong() {
        $thang =getdate();
        $nvcobangluong = $this->db->table($this->table)->select('nMaNV')
        ->where('Month(dNgayTinhLuong)=',$thang['mon'])->get()->getResult('array');
        $arr_nv = array();
        foreach ($nvcobangluong as $key => $nv) {
            foreach ($nv as $nv2) {
                array_push($arr_nv, $nv2);
            }
        }
        return $this->db->table($this->table)->join('nhanvien', 'nhanvien.nMaNV = bangluong.nMaNV', 'right')
        ->whereNotIn('nhanvien.nMaNV', $arr_nv)->get()->getResult('array');
    }
}