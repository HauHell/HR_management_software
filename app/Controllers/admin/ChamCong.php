<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ChamCongModel;
use App\Models\NhanVienModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ChamCong extends BaseController
{
    public function index()
    {
        $chamcong_model = new ChamCongModel();
        $chamcongs = $chamcong_model->getChamCongNV();
        $chuachamcongs =$chamcong_model->getNhanVienChuaChamCong();
        $nhanvien_model = new NhanVienModel();
        $nhanviens = $nhanvien_model->findAll();
        
        $data['title'] = "Bảng Chấm Công";
        $data['chamcongs'] = $chamcongs;
        $data['chuachamcongs'] = $chuachamcongs;
        $data['nhanviens'] = $nhanviens;
        $data['left'] = view("Views/admin/layout/left");
        $data['head'] = view("Views/admin/layout/head");
        $data['content'] = view("Views/admin/pages/bangchamcong", $data);
        return view('Views/admin/main', $data);
    }
    public function add()
    {
        $chamcong_model = new ChamCongModel();
        $data = [
            'nMaNV' => $_POST['manhanvien'],
            'fSoNgayCong'    => $_POST['songaycong'],
            'fGioTangCa'    => $_POST['giotangca'],
            'fSoNgayNghi'    => $_POST['songaynghi'],
            'dNgayThang'    => $_POST['ngaythang'],
            'vGhiChuC'    => $_POST['ghichu'],
        ];
        $chamcong_model->insert($data);
        return ('<script>window.location.assign("/admin/bangchamcong")</script>');
    }
    public function edit()
    {
        
        $chamcong_model = new ChamCongModel();
        $data = [
        
            'fSoNgayCong'    => $_POST['songaycong'],
            'fGioTangCa'    => $_POST['giotangca'],
            'fSoNgayNghi'    => $_POST['songaynghi'],
            'dNgayThang'    => $_POST['ngaythang'],
            'vGhiChuC'    => $_POST['ghichu'],
        ];
        $chamcong_model->update($_POST['machamcong'], $data);
        return ('<script>window.location.assign("/admin/bangchamcong")</script>');
    }
    public function delete()
    {
       
        $chamcong_model = new ChamCongModel();
        $chamcong_model->delete($_POST['machamcong']);
        return ('<script>window.location.assign("/admin/bangchamcong")</script>');
    }
    public function checkworkingday(){
        if ($this->request->isAJAX()) {
            $ngaycong = service('request')->getPost('ngaycong');
            return  $ngaycong;
        }
    }
    public function checknoworkingday(){
        if ($this->request->isAJAX()) {
            $ngaynghi = service('request')->getPost('ngaynghi');
            return  $ngaynghi;
        }
    }
    
    public function export()
    {
        $chamcong_model = new ChamCongModel();
        $chamcongs = $chamcong_model->getChamCongNV();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay = date("m-d-Y", strtotime(date('Y-m-d')));
        $file_name = "danhsachchamcong" . $ngay . ".xlxs";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Mã Chấm Công');
        $sheet->setCellValue('B1', 'Tên Nhân Viên');
        $sheet->setCellValue('C1', 'Số Ngày Công');
        $sheet->setCellValue('D1', 'Số Giờ Tăng Ca');
        $sheet->setCellValue('E1', 'Số Ngày Nghỉ');  
        $sheet->setCellValue('F1', 'Ngày Chấm Công'); 
        $sheet->setCellValue('G1', 'Ghi Chú'); 
        $count = 2; 
        foreach($chamcongs as $chamcong) {
            $sheet->setCellValue('A' . $count, $chamcong['nMaChamCong']);
            $sheet->setCellValue('B' . $count, $chamcong['vTenNV']);
            $sheet->setCellValue('C'. $count, $chamcong['fSoNgayCong']);
            $sheet->setCellValue('D'. $count, $chamcong['fGioTangCa']);
            $sheet->setCellValue('E'. $count, $chamcong['fSoNgayNghi']);
            $sheet->setCellValue('F'. $count, $chamcong['dNgayThang']);
            $sheet->setCellValue('G'. $count, $chamcong['vGhiChuC']);
            $count++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($file_name);
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=" . basename($file_name) . "");
        header('Expries: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Lenght:' . filesize($file_name));
        flush();
        readfile($file_name);
        exit;
        return ('<script>window.location.assign("/admin/bangchamcong")</script>');
    }
}
