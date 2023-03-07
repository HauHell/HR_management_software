<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PhanCongModel;
use App\Models\PhongBanModel;
use App\Models\ChucVuModel;
use App\Models\LuongCoBanModel;
use App\Models\NhanVienModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DateTime;

class PhanCong extends BaseController
{
    public function index()
    {
        $phancong_model = new PhanCongModel();
        $phancongs = $phancong_model->getPhanCong();
        $chuaphancongs = $phancong_model->getNhanVienChuaPhanCong();
        /* nhan vien */
        $nhanvien_model = new NhanVienModel();
        $nhanviens = $nhanvien_model->findAll();
        /* chuc vu */
        $chucvu_model = new ChucVuModel();
        $chucvus = $chucvu_model->findAll();
        /* phong ban */
        $phongban_model = new PhongBanModel();
        $phongbans = $phongban_model->findAll();

        $data['title'] = "Phân Công";
        $data['phancongs'] = $phancongs;
        $data['chuaphancongs'] = $chuaphancongs;
        $data['nhanviens'] = $nhanviens;
        $data['chucvus'] = $chucvus;
        $data['phongbans'] = $phongbans;
        $data['left'] = view("Views/admin/layout/left");
        $data['head'] = view("Views/admin/layout/head");
        $data['content'] = view("Views/admin/pages/phancong", $data);
        return view('Views/admin/main', $data);
    }
    public function add()
    {
        $phancong_model = new PhanCongModel();
        $nhanvien_model = new NhanVienModel();

        $data = [
            'nMaNV' => $_POST['manhanvien'],
            'nMaCV'    => $_POST['machucvu'],
            'nMaPB'    => $_POST['maphongban'],
            'dThoiGian'    => $_POST['thoigian'],
            'bTrangThai'    => $_POST['trangthai'],
        ];
        $phancong_model->insert($data);
        $datanhanvien = [
            'nMaCV'    => $_POST['machucvu'],
            'nMaPB'    => $_POST['maphongban'],
        ];
        $nhanvien_model->update($_POST['manhanvien'], $datanhanvien);
        $luongcoban_model = new LuongCoBanModel();
        $nhanvien_model = new NhanVienModel();
        $nhanviens = $nhanvien_model->findAll();
        $chucvu_model = new ChucVuModel();
        $chucvus = $chucvu_model->findAll();
        $tienluong = 0;
        foreach ($nhanviens as $nhanvien) {
            if ($_POST['manhanvien'] == $nhanvien['nMaNV']) {

                foreach ($chucvus as $chucvu) {

                    if ($chucvu['nMaCV'] == $_POST['machucvu']) {
                        $tienluong=$chucvu['nLuongCV'];
                    }
                }
            }
        }
        foreach ($nhanviens as $nhanvien) {
            if ($nhanvien['nMaNV'] == $_POST['manhanvien']) {
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $date1 = new DateTime(date('Y-m-d'));
                $newDate = date("Y-m-d", strtotime($nhanvien['dNgayVaoLam']));
                $date2 = new DateTime($newDate);
                $diff = $date1->diff($date2);
                $thamnien= floor($diff->days / 365);
            }
        }

        $data2 = [
            'nMaNV' => $_POST['manhanvien'],
            'dNgayThayDoi'    => $_POST['thoigian'],
            'fSoTienLuongCB' => $tienluong+($tienluong*$thamnien*0.1),
            'nThamNien'=>$thamnien,
        ];
        $data3 = [
            'dNgayThayDoi'    => $_POST['thoigian'],
            'fSoTienLuongCB' =>  $tienluong+($tienluong*$thamnien*0.1),
        ];
        $luongcobans = $luongcoban_model->findAll();
        $maluongcb = 0;
        foreach ($luongcobans as $luongcoban) {
            if ($_POST['manhanvien'] == $luongcoban['nMaNV']) {
                $maluongcb = $luongcoban['nMaLuongCB'];
            }
        }
        if ($maluongcb > 0) {
            $luongcoban_model->update($maluongcb, $data3);
        } else {
            $luongcoban_model->insert($data2);
        }

        return ('<script>window.location.assign("/admin/phancong")</script>');
    }
    public function edit()
    {

        $phancong_model = new PhanCongModel();
        $nhanvien_model = new NhanVienModel();

        $data = [
            'nMaNV' => $_POST['manhanvien'],
            'nMaCV'    => $_POST['machucvu'],
            'nMaPB'    => $_POST['maphongban'],
            'dThoiGian'    => $_POST['thoigian'],
            'bTrangThai'    => $_POST['trangthai'],
        ];
        $phancong_model->update($_POST['id'], $data);
        $datanhanvien = [
            'nMaCV'    => $_POST['machucvu'],
            'nMaPB'    => $_POST['maphongban'],
        ];

        $nhanvien_model->update($_POST['manhanvien'], $datanhanvien);

        return ('<script>window.location.assign("/admin/phancong")</script>');
    }
    public function delete()
    {
        $nhanvien_model = new NhanVienModel();
        $phancong_model = new PhanCongModel();
        $phancong_model->delete($_POST['id']);
        $datanhanvien = [
            'nMaCV'    => 0,
            'nMaPB'    => 0,
        ];
        $nhanvien_model->update($_POST['manhanvien'], $datanhanvien);
        return ('<script>window.location.assign("/admin/phancong")</script>');
    }
    public function selectchuvu()
    {
        $selectchucvu = $_POST['machucvu'];
        print_r($selectchucvu);
    }

    public function export()
    {
        $phancong_model = new PhanCongModel();
        $phancongs = $phancong_model->getPhanCong();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay = date("m-d-Y", strtotime(date('Y-m-d')));
        $file_name = "danhsachphancong" . $ngay . ".xlxs";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Tên Nhân Viên');
        $sheet->setCellValue('C1', 'Tên Chức Vụ');
        $sheet->setCellValue('D1', 'Tên Phòng Ban');  
        $sheet->setCellValue('E1', 'Ngày Phân Công'); 
        $count = 2;
        foreach ($phancongs as $phancong) {
            $sheet->setCellValue('A' . $count, $phancong['nID']);
            $sheet->setCellValue('B' . $count, $phancong['vTenNV']);
            $sheet->setCellValue('C'. $count, $phancong['vTenCV']);
            $sheet->setCellValue('D'. $count, $phancong['vTenPB']);
            $sheet->setCellValue('E'. $count, $phancong['dThoiGian']);
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
        return ('<script>window.location.assign("/admin/phancong")</script>');
    }
}
