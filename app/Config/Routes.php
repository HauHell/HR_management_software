<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

/*--------------------Trang Chủ-----------------------------*/
$routes->get('/admin', 'Home::index');

/*--------------------Nhân Viên-----------------------------*/
$routes->get('admin/nhanvien', 'admin\NhanVien::index');
$routes->post('admin/nhanvien/themnhanvien', 'admin\NhanVien::add');
$routes->post('admin/nhanvien/suanhanvien', 'admin\NhanVien::edit');
$routes->post('admin/nhanvien/xoanhanvien', 'admin\NhanVien::delete');
$routes->get('admin/nhanvien/print', 'admin\NhanVien::export');

/*--------------------Phòng Ban-----------------------------*/
$routes->get('admin/phongban', 'admin\PhongBan::index');
$routes->post('admin/phongban/themphongban', 'admin\PhongBan::add');
$routes->post('admin/phongban/suaphongban', 'admin\PhongBan::edit');
$routes->post('admin/phongban/xoaphongban', 'admin\PhongBan::delete');
$routes->get('admin/phongban/print', 'admin\PhongBan::export');

/*--------------------Chức Vụ-----------------------------*/
$routes->get('admin/chucvu', 'admin\ChucVu::index');
$routes->post('admin/chucvu/themchucvu', 'admin\ChucVu::add');
$routes->post('admin/chucvu/suachucvu', 'admin\ChucVu::edit');
$routes->post('admin/chucvu/xoachucvu', 'admin\ChucVu::delete');
$routes->get('admin/chucvu/print', 'admin\ChucVu::export');

/*--------------------Phân Công-----------------------------*/
$routes->get('admin/phancong', 'admin\PhanCong::index');
$routes->post('admin/phancong/themphancong', 'admin\PhanCong::add');
$routes->post('admin/phancong/suaphancong', 'admin\PhanCong::edit');
$routes->post('admin/phancong/xoaphancong', 'admin\PhanCong::delete');
$routes->post('admin/phancong//selected/chucvu', 'admin\PhanCong::selectchuvu');
$routes->get('admin/phancong/print', 'admin\PhanCong::export');


/*--------------------Bảng Chấm Công-----------------------------*/
$routes->get('admin/bangchamcong', 'admin\ChamCong::index');
$routes->post('admin/bangchamcong/thembangcong', 'admin\ChamCong::add');
$routes->post('admin/bangchamcong/suabangcong', 'admin\ChamCong::edit');
$routes->post('admin/bangchamcong/xoabangcong', 'admin\ChamCong::delete');
$routes->post('admin/bangchamcong/kiemtrangaycong', 'admin\ChamCong::checkworkingday');
$routes->post('admin/bangchamcong/kiemtrangaynghi', 'admin\ChamCong::checknoworkingday');
$routes->get('admin/bangchamcong/print', 'admin\ChamCong::export');

/*--------------------Lương Cơ Bản-----------------------------*/
$routes->get('admin/luongcoban', 'admin\LuongCoBan::index');
$routes->post('admin/luongcoban/themluongcoban', 'admin\LuongCoBan::add');
$routes->post('admin/luongcoban/sualuongcoban', 'admin\LuongCoBan::edit');
$routes->post('admin/luongcoban/xoaluongcoban', 'admin\LuongCoBan::delete');
$routes->get('admin/luongcoban/print', 'admin\LuongCoBan::export');

/*--------------------Đóng Bảo Hiểm-----------------------------*/
$routes->get('admin/dongbaohiem', 'admin\DongBaoHiem::index');
$routes->post('admin/dongbaohiem/themdongbaohiem', 'admin\DongBaoHiem::add');
$routes->post('admin/dongbaohiem/suadongbaohiem', 'admin\DongBaoHiem::edit');
$routes->post('admin/dongbaohiem/xoadongbaohiem', 'admin\DongBaoHiem::delete');
$routes->post('admin/dongbaohiem/dongbaohiemthang', 'admin\DongBaoHiem::dongbaohiem');
$routes->get('admin/dongbaohiem/print', 'admin\DongBaoHiem::export');

/*--------------------Doanh Thu-----------------------------*/
$routes->get('admin/doanhthu', 'admin\DoanhThu::index');
$routes->post('admin/doanhthu/themdoanhthu', 'admin\DoanhThu::add');
$routes->post('admin/doanhthu/suadoanhthu', 'admin\DoanhThu::edit');
$routes->post('admin/doanhthu/xoadoanhthu', 'admin\DoanhThu::delete');
$routes->get('admin/doanhthu/print', 'admin\DoanhThu::export');

/*--------------------Tính Lương-----------------------------*/
$routes->get('admin/bangluong', 'admin\BangLuong::index');
$routes->post('admin/bangluong/tinhluong', 'admin\BangLuong::tinhluong');
$routes->post('admin/bangluong/xoabangluong', 'admin\BangLuong::xoabangluong');
$routes->get('admin/bangluong/print', 'admin\BangLuong::export');

/*--------------------Login-----------------------------*/
$routes->get('/admin/login', 'admin\TaiKhoan::loginPage');
$routes->post('/admin/loginAction', 'admin\TaiKhoan::loginAction');
$routes->post('/admin/doimatkhau', 'admin\TaiKhoan::doimatkhau');

/*--------------------Tài Khoản-----------------------------*/
$routes->get('admin/taikhoan', 'admin\TaiKhoan::index');
$routes->post('admin/taikhoan/themtaikhoan', 'admin\TaiKhoan::add');
$routes->post('admin/taikhoan/suataikhoan', 'admin\TaiKhoan::edit');
$routes->post('admin/taikhoan/xoataikhoan', 'admin\TaiKhoan::delete');

$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
