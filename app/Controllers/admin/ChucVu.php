<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ChucVuModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ChucVu extends BaseController
{
    public function index()
    {
        $chucvu_model = new ChucVuModel();
        $chucvus = $chucvu_model->findAll();
        $data['title'] = "Chức Vụ";
        $data['chucvus'] = $chucvus;
        $data['left'] = view("Views/admin/layout/left");
        $data['head'] = view("Views/admin/layout/head");
        $data['content'] = view("Views/admin/pages/chucvu", $data);
        return view('Views/admin/main', $data);
    }
    public function add()
    {
        $chucvu_model = new ChucVuModel();
        $data = [
            'vTenCV' => $_POST['ten'],
            'fPhuCap'    => $_POST['phucap'],
            'nLuongCv'    => $_POST['luongcv'],
            'vGhiChu'    => $_POST['ghichu'],
        ];
        $chucvu_model->insert($data);
        return ('<script>window.location.assign("/admin/chucvu")</script>');
    }
    public function edit()
    {
        
        $chucvu_model = new ChucVuModel();
        $data = [
            'vTenCV' => $_POST['ten'],
            'fPhuCap'    => $_POST['phucap'],
            'nLuongCv'    => $_POST['luongcv'],
            'vGhiChu'    => $_POST['ghichu'],
        ];
        $chucvu_model->update($_POST['ma'], $data);
        return ('<script>window.location.assign("/admin/chucvu")</script>');
    }
    public function delete()
    {
       
        $chucvu_model = new ChucVuModel();
        $chucvu_model->delete($_POST['ma']);
        return ('<script>window.location.assign("/admin/chucvu")</script>');
    }
    public function export()
    {
        $chucvu_model = new ChucVuModel();
        $chucvus = $chucvu_model->findAll();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay = date("m-d-Y", strtotime(date('Y-m-d')));
        $file_name = "danhsachchucvu" . $ngay . ".xlxs";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Mã Chức Vụ');
        $sheet->setCellValue('B1', 'Tên Chức Vụ');
        $sheet->setCellValue('C1', 'Phụ Cấp');
        $sheet->setCellValue('D1', 'Lương Chức Vụ');
        $sheet->setCellValue('E1', 'Ghi Chú');  
        $count = 2;
        foreach ($chucvus as $chucvu) {
            $sheet->setCellValue('A' . $count, $chucvu['nMaCV']);
            $sheet->setCellValue('B' . $count, $chucvu['vTenCV']);
            $sheet->setCellValue('C'. $count, $chucvu['fPhuCap']);
            $sheet->setCellValue('D'. $count, $chucvu['nLuongCV']);
            $sheet->setCellValue('E'. $count, $chucvu['vGhiChu']);
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
        return ('<script>window.location.assign("/admin/chucvu")</script>');
    }
}
