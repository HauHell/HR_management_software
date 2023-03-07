<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\BangLuongModel;
use App\Models\ChamCongModel;
use App\Models\PhanCongModel;
use App\Models\PhongBanModel;
use App\Models\ChucVuModel;
use App\Models\DoanhThuModel;
use App\Models\DongBaoHiemModel;
use App\Models\LuongCoBanModel;
use App\Models\NhanVienModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DateTime;

class BangLuong extends BaseController
{
    public function index()
    {
        $bangluong_model = new BangLuongModel();
        $bangluongs =$bangluong_model->getNhanVien();
        $chuatinhluongs = $bangluong_model->getNhanVienChuaTinhLuong();
        /* nhan vien */
        $nhanvien_model = new NhanVienModel();
        $nhanviens = $nhanvien_model->findAll();
        /* chuc vu */
        $chucvu_model = new ChucVuModel();
        $chucvus = $chucvu_model->findAll();
        /* phong ban */
        $phongban_model = new PhongBanModel();
        $phongbans = $phongban_model->findAll();

        $data['bangluongs'] = $bangluongs;
        $data['chuatinhluongs'] = $chuatinhluongs;
        $data['nhanviens'] = $nhanviens;
        $data['chucvus'] = $chucvus;
        $data['phongbans'] = $phongbans;
        $data['left'] = view("Views/admin/layout/left");
        $data['head'] = view("Views/admin/layout/head");
        $data['content'] = view("Views/admin/pages/bangluong", $data);
        return view('Views/admin/main', $data);
    }
    public function tinhluong(){
        //
        $bangluong_model =new BangLuongModel();
        // nhan vien
        $nhanvien_model = new NhanVienModel();
        $nhanviens = $nhanvien_model->findAll();
        // chuc vu
        
        $chucvu_model = new ChucVuModel();
        $chucvus = $chucvu_model->findAll();
        // doanh thu
        $doanhthu_model = new DoanhThuModel();
        $thang =getdate();
        $doanhthus =$doanhthu_model->where('Month(dNgayThang)=',$thang['mon'])->findAll();
        // bang cham cong
        $bangchamcong_model = new ChamCongModel();
        $chamcongs = $bangchamcong_model->where('Month(dNgayThang)=',$thang['mon'])->findAll();
        // luong co ban
        $luongcoban_model = new LuongCoBanModel();
        $luongcobans = $luongcoban_model->findAll();


        foreach($nhanviens as $nhanvien){
            if($nhanvien['nMaNV']==$_POST['manhanvien']){
                $tennv=$nhanvien['vTenNV'];
                $macv=$nhanvien['nMaCV'];
                $mapb=$nhanvien['nMaPB'];
            }
        }
        foreach($chucvus as $chucvu){
            if($chucvu['nMaCV']==$macv){
                $phucap=$chucvu['fPhuCap'];
            }
        }
        foreach($luongcobans as $luongcoban){
            if($luongcoban['nMaNV']==$_POST['manhanvien']){
                $luongcb=$luongcoban['fSoTienLuongCB'];
            }
        }
        $ngaycong=0;
        $giotangca=0;
        foreach($chamcongs as $chamcong){
            if($chamcong['nMaNV']==$_POST['manhanvien']){
                $ngaycong=$chamcong['fSoNgayCong']-$chamcong['fSoNgayNghi'];
                $giotangca=$chamcong['fGioTangCa'];
            }
        }
        $dt=0;
        foreach($doanhthus as $doanhthu){
            if($doanhthu['nMaNV']==$_POST['manhanvien']){
                $dt+=$doanhthu['fDoanhThu'];
            }
        }
        //thưởng tiền theo ngày lễ
        $thuong=0;
        if(($thang['mon']-1)==9||($thang['mon']-1)==4||($thang['mon']-1)==0||($thang['mon'])-1==1){
            $thuong=1000000;
        }

        $data = [
            'nMaNV' => $_POST['manhanvien'],
            'nMaCV'=>$macv,
            'nMaPV'=>$mapb,
            'fLuongCB'=>$luongcb/26*$ngaycong,
            'fSoNgayCong'=>$ngaycong,
            'fGioTangCa'=>$giotangca,
            'fPhuCap'=>$phucap,
            'fCacKhoanChiBH'=>($luongcb/26*$ngaycong)*0.105,
            'fDoanhThu'=>$dt,
            'fThuong'=>$thuong,
            'fThucLinh'=>($luongcb/26*$ngaycong)+$phucap+($luongcb/26/8*$giotangca)+$thuong-(($luongcb)*0.105)+(round(($dt/10000000)-3)*200000),
            'dNgayTinhLuong'=>$_POST['thoigian'],
            'vGhiChu'    => $_POST['ghichu'],
        ];

        $dongbaohiem_model = new DongBaoHiemModel();
        $data2 = [
            'nMaNV' => $_POST['manhanvien'],
            'nTienDongBH'    => ($luongcb/26*$ngaycong)*0.105,
            'dThoiGianDong'    => $_POST['thoigian'],
        ];
        $dongbaohiem_model->insert($data2);

        $bangluong_model->insert($data);

        return ('<script>window.location.assign("/admin/bangluong")</script>');

    }
    public function xoabangluong()
    {
        $bangluong_model = new BangLuongModel();
        $bangluong_model->delete($_POST['id']);
        return ('<script>window.location.assign("/admin/bangluong")</script>');
    }

    public function export()
    {
        $bangluong_model = new BangLuongModel();
        $bangluongs =$bangluong_model->getNhanVien();
          /* chuc vu */
          $chucvu_model = new ChucVuModel();
          $chucvus = $chucvu_model->findAll();
          /* phong ban */
          $phongban_model = new PhongBanModel();
          $phongbans = $phongban_model->findAll();

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay = date("m-d-Y", strtotime(date('Y-m-d')));
        $file_name = "danhsachbangluong" . $ngay . ".xlxs";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Tên Nhân Viên');
        $sheet->setCellValue('C1', 'Phòng Ban');
        $sheet->setCellValue('D1', 'Chức Vụ');
        $sheet->setCellValue('E1', 'Ngày Công');
        $sheet->setCellValue('F1', 'Giờ Tăng Ca');
        $sheet->setCellValue('G1', 'Phụ Cấp');
        $sheet->setCellValue('H1', 'Các Khoản Chi Bảo Hiểm');
        $sheet->setCellValue('I1', 'Doanh Thu');
        $sheet->setCellValue('J1', 'Thưởng');
        $sheet->setCellValue('K1', 'Tiền Lương');
        $sheet->setCellValue('L1', 'Thực Lĩnh');
        $sheet->setCellValue('M1', 'Ngày Tính Lương');
        $sheet->setCellValue('N1', 'Ghi Chú');
        $tenphongban="";
        $tenchucvu="";
        $count = 2;
        foreach ($bangluongs as $bangluong) {
            foreach($phongbans as $phongban){
                if($bangluong['nMaPB']==$phongban['nMaPB']){
                    $tenphongban=$phongban['vTenPB'];
                }
            }
            foreach($chucvus as $chucvu){
                if($bangluong['nMaCV']==$chucvu['nMaCV']){
                    $tenchucvu=$chucvu['vTenCV'];
                }
            }
            $sheet->setCellValue('A' . $count, $bangluong['nID']);
            $sheet->setCellValue('B' . $count, $bangluong['vTenNV']);
            $sheet->setCellValue('C'. $count, $tenphongban);
            $sheet->setCellValue('D'. $count, $tenchucvu);
            $sheet->setCellValue('E'. $count, $bangluong['fSoNgayCong']);
            $sheet->setCellValue('F'. $count, $bangluong['fGioTangCa']);
            $sheet->setCellValue('G'. $count, $bangluong['fPhuCap']);
            $sheet->setCellValue('H'. $count, $bangluong['fCacKhoanChiBH']);
            $sheet->setCellValue('I'. $count, $bangluong['fDoanhThu']);
            $sheet->setCellValue('J'. $count, $bangluong['fThuong']);
            $sheet->setCellValue('K'. $count, $bangluong['fLuongCB']);
            $sheet->setCellValue('L'. $count, $bangluong['fThucLinh']);
            $sheet->setCellValue('M'. $count, $bangluong['dNgayTinhLuong']);
            $sheet->setCellValue('N'. $count, $bangluong['vGhiChu']);
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
