<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\DoanhThuModel;
use App\Models\NhanVienModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class doanhthu extends BaseController
{
    public function index()
    {
        $doanhthu_model = new DoanhThuModel();
        $doanhthus = $doanhthu_model->getDoanhThu();
        $chuadoanhthus = $doanhthu_model->getNhanVienChuaDoanhThu();
        /* nhan vien */
        $nhanvien_model = new NhanVienModel();
        $nhanviens = $nhanvien_model->findAll();
        $data['title'] = "Doanh Thu";
        $data['doanhthus'] = $doanhthus;
        $data['chuadoanhthus'] = $chuadoanhthus;
        $data['nhanviens'] = $nhanviens;
        $data['left'] = view("Views/admin/layout/left");
        $data['head'] = view("Views/admin/layout/head");
        $data['content'] = view("Views/admin/pages/doanhthu", $data);
        return view('Views/admin/main', $data);
    }
    public function add()
    {
        $doanhthu_model = new doanhthuModel();
        $data = [
            'nMaNV' => $_POST['manhanvien'],
            'nSLSP'    => $_POST['slsp'],
            'fDoanhThu'    => $_POST['doanhthu'],
            'dNgayThang'    => $_POST['ngaythang'],
            'vGhiChuD'    => $_POST['ghichu'],
            
        ];
        $doanhthu_model->insert($data);
    
        return ('<script>window.location.assign("/admin/doanhthu")</script>');
    }
    public function edit()
    {
        $doanhthu_model = new doanhthuModel();
        $data = [
           
            'nSLSP'    => $_POST['slsp'],
            'fDoanhThu'    => $_POST['doanhthu'],
            'dNgayThang'    => $_POST['ngaythang'],
            'vGhiChuD'    => $_POST['ghichu'],
            
        ];
        $doanhthu_model->update($_POST['id'], $data);
      
       
        return ('<script>window.location.assign("/admin/doanhthu")</script>');
    }
    public function delete()
    {
        $doanhthu_model = new doanhthuModel();
        $doanhthu_model->delete($_POST['id']);
       
        return ('<script>window.location.assign("/admin/doanhthu")</script>');
    }
   
    public function export()
    {
        $doanhthu_model = new DoanhThuModel();
        $doanhthus = $doanhthu_model->getDoanhThu();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay = date("m-d-Y", strtotime(date('Y-m-d')));
        $file_name = "danhsachdoanhthu" . $ngay . ".xlxs";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Tên Nhân Viên');
        $sheet->setCellValue('C1', 'Số Lượng Sản Phẩm');
        $sheet->setCellValue('D1', 'Doanh Thu');
        $sheet->setCellValue('E1', 'Ngày Tháng');
        $sheet->setCellValue('F1', 'Ghi Chú');
        $count = 2;
        foreach ($doanhthus as $doanhthu) {
            $sheet->setCellValue('A' . $count, $doanhthu['nMaDT']);
            $sheet->setCellValue('B' . $count, $doanhthu['vTenNV']);
            $sheet->setCellValue('C'. $count, $doanhthu['nSLSP']);
            $sheet->setCellValue('D'. $count, $doanhthu['fDoanhThu']);
            $sheet->setCellValue('E'. $count, $doanhthu['dNgayThang']);
            $sheet->setCellValue('F'. $count, $doanhthu['vGhiChuD']);
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
        return ('<script>window.location.assign("/admin/doanhthu")</script>');
    }
}
