<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ChamCongModel;
use App\Models\ChucVuModel;
use App\Models\NhanVienModel;
use App\Models\PhanCongModel;
use App\Models\PhongBanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class NhanVien extends BaseController
{

    public function index()
    {
        $nhanvien_model = new NhanVienModel();
        $getnhanviens = $nhanvien_model->findAll();
        $phancong_model = new PhanCongModel();
        $phancongs = $phancong_model->findAll();
        $chucvu_model = new ChucVuModel();
        $chucvus = $chucvu_model->findAll();
        $phongban_model = new PhongBanModel();
        $phongbans = $phongban_model->findAll();

        $nhanviens = array();
        foreach ($getnhanviens as $nhanvien) {
            $getphancong = $phancong_model->where('nMaNV', $nhanvien['nMaNV'])->findAll();
            $getchucvu = array();
            foreach ($getphancong as $chucvu) {
                $chucvu['chucvu'] = $chucvu_model->where('nMaCV', $chucvu['nMaCV'])->first();
                $getchucvu[] = $chucvu;
            }
            $nhanvien['getchucvu'] = $getchucvu;
            $nhanviens[] = $nhanvien;
        }

        $data['title'] = "Nhân Viên";
        $data['nhanviens'] = $nhanviens;
        $data['phancongs'] = $phancongs;
        $data['chucvus'] = $chucvus;
        $data['phongbans'] = $phongbans;
        $data['left'] = view("Views/admin/layout/left");
        $data['head'] = view("Views/admin/layout/head");
        $data['content'] = view("Views/admin/pages/nhanvien", $data);
        return view('Views/admin/main', $data);
    }
    public function add()
    {
        $nhanvien_model = new NhanVienModel();

        $image = $this->request->getFile('image');
        if ($image->isValid()) {

            $image->move('./assets/avatars');
        }
        $imagename = $image->getName();
        $data = [

            'vTenNV' => $_POST['ten'],
            'dNgaySinh' => $_POST['ngaysinh'],
            'vDiaChi'    => $_POST['diachi'],
            'bGioiTinh'    => $_POST['gioitinh'],
            'nSdt'    => $_POST['sodienthoai'],
            'nCCCD'    => $_POST['cccd'],
            'dNgayVaoLam'    => $_POST['ngayvaolam'],
            'bTinhTrangLamViec'    => $_POST['tinhtranglamviec'],
            'vTrinhDoHocVan'    => $_POST['trinhdohocvan'],
            'vTinhTrangHonNhan'    => $_POST['tinhtranghonnhan'],
            'vTrinhDoChuyenMon'    => $_POST['trinhdochuyenmon'],
            'vImage' => $imagename,
            'vGhiChu'    => $_POST['ghichu'],
            'vBHYT' => $_POST['bhyt'],
            'vBHTN' => $_POST['bhtn'],
            'vBHXH' => $_POST['bhxh'],

        ];

        $nhanvien_model->insert($data);
        return ('<script>window.location.assign("/admin/nhanvien")</script>');
    }
    public function edit()
    {
        $image = $this->request->getFile('image');
        if ($image->isValid()) {
            $image->move('./assets/avatars');
        }
        $imagename = $image->getName();
        if (!empty($imagename)) {
            if ($_POST['oldimage'] != null) {
                unlink('./assets/avatars/' . $_POST['oldimage']);
            }
        }
        if ($imagename == "") {
            $imagename = $_POST['oldimage'];
        }
        $nhanvien_model = new NhanVienModel();
        $data = [

            'vTenNV' => $_POST['ten'],
            'dNgaySinh' => $_POST['ngaysinh'],
            'vDiaChi'    => $_POST['diachi'],
            'bGioiTinh'    => $_POST['gioitinh'],
            'nSdt'    => $_POST['sodienthoai'],
            'nCCCD'    => $_POST['cccd'],
            'dNgayVaoLam'    => $_POST['ngayvaolam'],
            'bTinhTrangLamViec'    => $_POST['tinhtranglamviec'],
            'vTrinhDoHocVan'    => $_POST['trinhdohocvan'],
            'vTinhTrangHonNhan'    => $_POST['tinhtranghonnhan'],
            'vTrinhDoChuyenMon'    => $_POST['trinhdochuyenmon'],
            'vImage' => $imagename,
            'vGhiChu'    => $_POST['ghichu'],
            'vBHYT' => $_POST['bhyt'],
            'vBHTN' => $_POST['bhtn'],
            'vBHXH' => $_POST['bhxh'],

        ];
        $nhanvien_model->update($_POST['ma'], $data);
        return ('<script>window.location.assign("/admin/nhanvien")</script>');
    }
    public function delete()
    {

        if ($_POST['image'] != "") {
            unlink('./assets/avatars/' . $_POST['image']);
        }

        $nhanvien_model = new NhanVienModel();
        $nhanvien_model->delete($_POST['ma']);
        $phancong_model = new PhanCongModel();
        $phancong_model->delete($_POST['ma']);
        $chamcong_model = new ChamCongModel();
        $chamcong_model->delete($_POST['ma']);
        return ('<script>window.location.assign("/admin/nhanvien")</script>');
    }
    public function export()
    {
        $nhanvien_model = new NhanVienModel();
        $nhanviens = $nhanvien_model->getNhanVienPrint();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay = date("m-d-Y", strtotime(date('Y-m-d')));
        $file_name = "danhsachnhanvien" . $ngay . ".xlxs";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Mã Nhân Viên');
        $sheet->setCellValue('B1', 'Tên Nhân Viên');
        $sheet->setCellValue('C1', 'Ngày Sinh');
        $sheet->setCellValue('D1', 'Địa Chỉ');
        $sheet->setCellValue('E1', 'Giới Tính');
        $sheet->setCellValue('F1', 'Số Điện Thoại');
        $sheet->setCellValue('G1', 'CCCD');
        $sheet->setCellValue('H1', 'Ngày Vào Làm');
        $sheet->setCellValue('I1', 'Phòng Ban');
        $sheet->setCellValue('J1', 'Chức Vụ');
        $sheet->setCellValue('K1', 'Tình Trạng Làm Việc');
        $sheet->setCellValue('L1', 'Trình Độ Học Vấn');
        $sheet->setCellValue('M1', 'Tình Trạng Hôn Nhân');
        $sheet->setCellValue('N1', 'Trình Độ Chuyên Môn');
        $sheet->setCellValue('O1', 'BHYT');
        $sheet->setCellValue('P1', 'BHTN');
        $sheet->setCellValue('Q1', 'BHXH');
        $count = 2;
        $gioitinh="";
        $tinhtranglamviec="";
        foreach ($nhanviens as $nhanvien) {
            if($nhanvien['bGioiTinh']==1){
                $gioitinh="Nam";
            }
            else{
                $gioitinh="Nữ";
            }
            if($nhanvien['bTinhTrangLamViec']==1){
                $tinhtranglamviec="Đang Làm";
            }
            else{
                $tinhtranglamviec="Nghỉ Việc";
            }
           
            $sheet->setCellValue('A' . $count, $nhanvien['nMaNV']);
            $sheet->setCellValue('B' . $count, $nhanvien['vTenNV']);
            $sheet->setCellValue('C'. $count, $nhanvien['dNgaySinh']);
            $sheet->setCellValue('D'. $count, $nhanvien['vDiaChi']);
            $sheet->setCellValue('E'. $count, $gioitinh);
            $sheet->setCellValue('F'. $count, $nhanvien['nSdt']);
            $sheet->setCellValue('G'. $count, $nhanvien['nCCCD']);
            $sheet->setCellValue('H'. $count, $nhanvien['dNgayVaoLam']);
            $sheet->setCellValue('I'. $count, $nhanvien['vTenPB']);
            $sheet->setCellValue('J'. $count, $nhanvien['vTenCV']);
            $sheet->setCellValue('K'. $count, $tinhtranglamviec);
            $sheet->setCellValue('L'. $count, $nhanvien['vTrinhDoHocVan']);
            $sheet->setCellValue('M'. $count, $nhanvien['vTinhTrangHonNhan']);
            $sheet->setCellValue('N'. $count, $nhanvien['vTrinhDoChuyenMon']);
            $sheet->setCellValue('O'. $count, $nhanvien['vBHYT']);
            $sheet->setCellValue('P'. $count, $nhanvien['vBHTN']);
            $sheet->setCellValue('Q'. $count, $nhanvien['vBHXH']);
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
        return ('<script>window.location.assign("/admin/nhanvien")</script>');
    }
}
