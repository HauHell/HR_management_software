<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ChucVuModel;
use App\Models\LuongCoBanModel;
use App\Models\NhanVienModel;
use App\Models\PhongBanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class LuongCoBan extends BaseController
{
    public function index()
    {
        $luongcoban_model = new LuongCoBanModel();
        $luongcobans = $luongcoban_model->getNhanVien();
        $nvchuacoluongs = $luongcoban_model->getNhanVienChuaCoLuong();
         /* chuc vu */
         $chucvu_model = new ChucVuModel();
         $chucvus = $chucvu_model->findAll();
         /* phong ban */
         $phongban_model = new PhongBanModel();
         $phongbans = $phongban_model->findAll();
        $data['title'] = "Bảng Chấm Công";
        $data['luongcobans'] = $luongcobans;
        $data['chucvus'] = $chucvus;
        $data['phongbans'] = $phongbans;
        $data['nvchuacoluongs'] = $nvchuacoluongs;
        $data['left'] = view("Views/admin/layout/left");
        $data['head'] = view("Views/admin/layout/head");
        $data['content'] = view("Views/admin/pages/luongcoban", $data);
        return view('Views/admin/main', $data);
    }
    public function add()
    {
        $luongcoban_model = new LuongCoBanModel();
        $nhanvien_model = new NhanVienModel();
        $nhanviens=$nhanvien_model->findAll();
        $chucvu_model = new ChucVuModel();
        $chucvus = $chucvu_model->findAll();
        $tienluong=0;
        foreach($nhanviens as $nhanvien){
            if( $_POST['manhanvien']==$nhanvien['nMaNV']){
                
            foreach($chucvus as $chucvu){
               
                    if ($chucvu['nMaCV'] == $nhanvien['nMaCV']) {
                        $tienluong=$chucvu['nLuongCV'];
                    }}
        }}
        $data = [
            'nMaNV' => $_POST['manhanvien'],
            'dNgayThayDoi'    => $_POST['ngaythaydoi'],
            'fSoTienLuongCB'=>$tienluong,
            'vGhiChuL'    => $_POST['ghichu'],
        ];
        $luongcoban_model->insert($data);
        return ('<script>window.location.assign("/admin/luongcoban")</script>');
    }
    public function edit()
    {
       
        
        $luongcoban_model = new LuongCoBanModel();
        $data = [
           
            'dNgayThayDoi'    => $_POST['ngaythaydoi'],
            'vGhiChuL'    => $_POST['ghichu'],
        ];
        $luongcoban_model->update($_POST['id'], $data);
        return ('<script>window.location.assign("/admin/luongcoban")</script>');
    }
    public function delete()
    {
       
        $luongcoban_model = new LuongCoBanModel();
        $luongcoban_model->delete($_POST['id']);
        return ('<script>window.location.assign("/admin/luongcoban")</script>');
    }

    public function export()
    {
        $luongcoban_model = new LuongCoBanModel();
        $luongcobans = $luongcoban_model->getNhanVien();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay = date("m-d-Y", strtotime(date('Y-m-d')));
        $file_name = "danhsachluongcoban" . $ngay . ".xlxs";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Mã Lương');
        $sheet->setCellValue('B1', 'Tên Nhân Viên');
        $sheet->setCellValue('C1', 'Ngày Thay Đổi');
        $sheet->setCellValue('D1', 'Thâm Niên');
        $sheet->setCellValue('E1', 'Số Tiền');
        $count = 2;
        foreach ($luongcobans as $luongcoban) {
            $sheet->setCellValue('A' . $count, $luongcoban['nMaLuongCB']);
            $sheet->setCellValue('B' . $count, $luongcoban['vTenNV']);
            $sheet->setCellValue('C'. $count, $luongcoban['dNgayThayDoi']);
            $sheet->setCellValue('D'. $count, $luongcoban['nThamNien']);
            $sheet->setCellValue('E'. $count, $luongcoban['fSoTienLuongCB']);
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
        return ('<script>window.location.assign("/admin/luongcoban")</script>');
    }
}
