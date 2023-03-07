<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\DongBaoHiemModel;
use App\Models\NhanVienModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class DongBaoHiem extends BaseController
{
    public function index()
    {
        $dongbaohiem_model = new DongBaoHiemModel();
        $dongbaohiems = $dongbaohiem_model->findAll();
        /* nhan vien */
        $nhanvien_model = new NhanVienModel();
        $nhanviens = $nhanvien_model->findAll();
    

        $data['title'] = "Đóng Bảo Hiểm";
        $data['dongbaohiems'] = $dongbaohiems;
        $data['nhanviens'] = $nhanviens;

        $data['left'] = view("Views/admin/layout/left");
        $data['head'] = view("Views/admin/layout/head");
        $data['content'] = view("Views/admin/pages/dongbaohiem", $data);
        return view('Views/admin/main', $data);
    }
    public function add()
    {
        $dongbaohiem_model = new DongBaoHiemModel();
        $data = [
            'nMaNV' => $_POST['manhanvien'],
            'vBHYT'    => $_POST['bhyt'],
            'vBHTN'    => $_POST['bhtn'],
            'vBHXH'    => $_POST['bhxh'],
            'nTienDongBH'    => $_POST['sotien'],
            'nSoThangDong'    => $_POST['sothang'],
            'dThoiGianDong'    => $_POST['thoigian'],
        ];
        $dongbaohiem_model->insert($data);
        return ('<script>window.location.assign("/admin/dongbaohiem")</script>');
    }
    public function edit()
    {
        $dongbaohiem_model = new DongBaoHiemModel();
        $data = [
           
            'vBHYT'    => $_POST['bhyt'],
            'vBHTN'    => $_POST['bhtn'],
            'vBHXH'    => $_POST['bhxh'],
            'nTienDongBH'    => $_POST['sotien'],
            'nSoThangDong'    => $_POST['sothang'],
            'dThoiGianDong'    => $_POST['thoigian'],
        ];
        $dongbaohiem_model->update($_POST['id'], $data);

        return ('<script>window.location.assign("/admin/dongbaohiem")</script>');
    }
    public function delete()
    {
        $dongbaohiem_model = new DongBaoHiemModel();
        $dongbaohiem_model->delete($_POST['id']);
       
        return ('<script>window.location.assign("/admin/dongbaohiem")</script>');
    }
    public function dongbaohiem()
    {
        $dongbaohiem_model = new DongBaoHiemModel();
        $data = [
            'nMaNV' => $_POST['manhanvien'],
            'vBHYT'    => $_POST['bhyt'],
            'vBHTN'    => $_POST['bhtn'],
            'vBHXH'    => $_POST['bhxh'],
            'nTienDongBH'    => $_POST['sotien'],
            'nSoThangDong'    => $_POST['sothang'],
            'dThoiGianDong'    => $_POST['thoigian'],
        ];
        $dongbaohiem_model->insert($data);
        return ('<script>window.location.assign("/admin/dongbaohiem")</script>');
    }
    public function export()
    {
        $dongbaohiem_model = new DongBaoHiemModel();
        $dongbaohiems = $dongbaohiem_model->getBaoHiem();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay = date("m-d-Y", strtotime(date('Y-m-d')));
        $file_name = "danhsachdongbaohiem" . $ngay . ".xlxs";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Mã Đóng Bảo Hiểm');
        $sheet->setCellValue('B1', 'Tên Nhân Viên');
        $sheet->setCellValue('C1', 'BHYT');
        $sheet->setCellValue('D1', 'BHTN');
        $sheet->setCellValue('E1', 'BHXH');
        $sheet->setCellValue('F1', 'Số Tiền');
        $sheet->setCellValue('G1', 'Ngày Đóng');
        $count = 2;
        foreach ($dongbaohiems as $dongbaohiem) {
            $sheet->setCellValue('A' . $count, $dongbaohiem['nID']);
            $sheet->setCellValue('B' . $count, $dongbaohiem['vTenNV']);
            $sheet->setCellValue('C'. $count, $dongbaohiem['vBHYT']);
            $sheet->setCellValue('D'. $count, $dongbaohiem['vBHTN']);
            $sheet->setCellValue('E'. $count, $dongbaohiem['vBHXH']);
            $sheet->setCellValue('F'. $count, $dongbaohiem['nTienDongBH']);
            $sheet->setCellValue('G'. $count, $dongbaohiem['dThoiGianDong']);
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
        return ('<script>window.location.assign("/admin/dongbaohiem")</script>');
    }
}
