<?php

namespace App\Models;

use CodeIgniter\Model;

class NhanVienModel extends Model
{
    protected $table = 'nhanvien';
    protected $primaryKey ='nMaNV';
    protected $allowedFields = [
        'vTenNV','dNgaySinh' ,'vDiaChi', 'bGioiTinh','nSdt','nCCCD','dNgayVaoLam','nMaPB',
        'nMaCV','bTinhTrangLamViec','vTrinhDoHocVan',
        'vTinhTrangHonNhan','vTrinhDoChuyenMon','vImage','vGhiChu','vBHYT','vBHTN','vBHXH',
    ];
    public function getNhanVien() {
        return $this->db->table($this->table)->join('phancong','phancong.nMaNV = nhanvien.nMaNV')
        ->join('chucvu','nhanvien.nMaCV = chucvu.nMaCV')->join('phongban','nhanvien.nMaPB = phongban.nMaPB')
        ->get()->getResult('array');
    }
    public function getNhanVienPrint() {
        return $this->db->table($this->table)
        ->join('chucvu','nhanvien.nMaCV = chucvu.nMaCV')->join('phongban','nhanvien.nMaPB = phongban.nMaPB')
        ->get()->getResult('array');
    }
   
}