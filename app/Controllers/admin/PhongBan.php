<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PhongBanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PhongBan extends BaseController
{
    public function index()
    {
        $phongban_model = new PhongBanModel();
        $phongbans = $phongban_model->findAll();
        $data['title'] = "Phòng Ban";
        $data['phongbans'] = $phongbans;
        $data['left'] = view("Views/admin/layout/left");
        $data['head'] = view("Views/admin/layout/head");
        $data['content'] = view("Views/admin/pages/phongban", $data);
        return view('Views/admin/main', $data);
    }
    public function add()
    {
        $phongban_model = new PhongBanModel();
        $data = [
            'vTenPB' => $_POST['ten'],
            'vDiaChi'    => $_POST['diachi'],
            'vGhiChu'    => $_POST['ghichu'],
        ];
        $phongban_model->insert($data);
        return ('<script>window.location.assign("/admin/phongban")</script>');
    }
    public function edit()
    {
        
        $phongban_model = new PhongBanModel();
        $data = [
            'vTenPB' => $_POST['ten'],
            'vDiaChi'    => $_POST['diachi'],
            'vGhiChu'    => $_POST['ghichu'],
        ];

        $phongban_model->update($_POST['ma'], $data);
        return ('<script>window.location.assign("/admin/phongban")</script>');
    }
    public function delete()
    {
       
        $phongban_model = new PhongBanModel();
        $phongban_model->delete($_POST['ma']);
        return ('<script>window.location.assign("/admin/phongban")</script>');
    }
    public function export()
    {
        $phongban_model = new PhongBanModel();
        $phongbans = $phongban_model->findAll();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay = date("m-d-Y", strtotime(date('Y-m-d')));
        $file_name = "danhsachphongban" . $ngay . ".xlxs";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Mã Phòng Ban');
        $sheet->setCellValue('B1', 'Tên Phòng Ban');
        $sheet->setCellValue('C1', 'Địa Chỉ');
        $sheet->setCellValue('D1', 'Ghi Chú');  
        $count = 2;
        foreach ($phongbans as $phongban) {
            $sheet->setCellValue('A' . $count, $phongban['nMaPB']);
            $sheet->setCellValue('B' . $count, $phongban['vTenPB']);
            $sheet->setCellValue('C'. $count, $phongban['vDiaChi']);
            $sheet->setCellValue('D'. $count, $phongban['vGhiChu']);
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
        return ('<script>window.location.assign("/admin/phongban")</script>');
    }
}
