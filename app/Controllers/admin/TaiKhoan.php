<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\TaiKhoanModel;

class taikhoan extends BaseController
{

    public function index()
    {


        $taikhoan_model = new TaiKhoanModel();
        $taikhoans = $taikhoan_model->findAll();
        $data['title'] = "Tài Khoản";
        $data['taikhoans'] = $taikhoans;
        $data['left'] = view("Views/admin/layout/left");
        $data['head'] = view("Views/admin/layout/head");
        $data['content'] = view("Views/admin/pages/taikhoan", $data);
        return view('Views/admin/main', $data);
    }
    public function add()
    {
        $taikhoan_model = new TaiKhoanModel();

        $image = $this->request->getFile('image');
        if ($image->isValid()) {

            $image->move('./assets/avatars');
        }
        $imagename = $image->getName();
        $data = [

            'vUserName' => $_POST['username'],
            'vEmail' => $_POST['mail'],
            'vPassword'    => $_POST['password'],
            'vImageLogin'    => $imagename,
            'vRole' => $_POST['role'],
        ];

        $taikhoan_model->insert($data);
        return '<script>window.location.assign("/admin/taikhoan")</script>';
    }
    public function edit()
    {
        $taikhoan_model = new TaiKhoanModel();
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
        $data = [

            'vUserName' => $_POST['username'],
            'vEmail' => $_POST['email'],
            'vPassword'    => $_POST['password'],
            'vImageLogin'    => $imagename,
        ];
        $session = session();
        $taikhoan_model->update($_POST['id'], $data);

        $session = session();
      
        if ($session->get('s_id')==$_POST['id']) {
            $rs = $taikhoan_model->where('nID', $this->request->getPost('id'))->first();
            $session->set('s_id', $rs['nID']);
            $session->set('s_username', $rs['vUserName']);
            $session->set('s_password', $rs['vPassword']);
            $session->set('s_mail', $rs['vEmail']);
            $session->set('s_image', $rs['vImageLogin']);
            $session->set('s_role', $rs['vRole']);
            return '<script>window.location.assign("/admin/taikhoan")</script>';
        }
        return '<script>window.location.assign("/admin/taikhoan")</script>';
    }

    public function delete()
    {

        if ($_POST['image'] != "") {
            unlink('./assets/avatars/' . $_POST['image']);
        }

        $taikhoan_model = new TaiKhoanModel();
        $taikhoan_model->delete($_POST['id']);
        $session = session();
        if ($session->get('s_id')==$_POST['id']) {
            $session = session();
            $session->destroy();
            return ('<script>window.location.assign("/admin/login   ")</script>');
        }
        return ('<script>window.location.assign("/admin/taikhoan")</script>');
    }

    public function loginPage()
    {
        $session = session();
        $session->destroy();

        return view('/admin/pages/login');
    }
    public function loginAction()
    {

        $session = session();
        $taikhoan_model = new TaiKhoanModel();
        $rs = $taikhoan_model->where('vUserName', $this->request->getPost('username'))
            ->where('vPassword', $this->request->getPost('password'))->first();
        if ($rs) {
            $session->set('s_id', $rs['nID']);
            $session->set('s_username', $rs['vUserName']);
            $session->set('s_password', $rs['vPassword']);
            $session->set('s_mail', $rs['vEmail']);
            $session->set('s_image', $rs['vImageLogin']);
            $session->set('s_role', $rs['vRole']);
            return '<script>window.location.assign("/admin")</script>';
        } else {
            return '<script>window.location.assign("/admin/login")</script>';
        }
    }
    public function doimatkhau()
    {
        $taikhoan_model = new TaiKhoanModel();
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

        $data = [

            'vUserName' => $_POST['username'],
            'vEmail' => $_POST['mail'],
            'vPassword'    => $_POST['newpassword'],
            'vImageLogin'    => $imagename,
        ];

        $taikhoan_model->update($_POST['id'], $data);
        $session = session();
        $rs = $taikhoan_model->where('vUserName', $this->request->getPost('username'))
            ->where('vPassword', $this->request->getPost('newpassword'))->first();
        if ($rs) {
            $session->set('s_id', $rs['nID']);
            $session->set('s_username', $rs['vUserName']);
            $session->set('s_password', $rs['vPassword']);
            $session->set('s_mail', $rs['vEmail']);
            $session->set('s_image', $rs['vImageLogin']);
            $session->set('s_role', $rs['vRole']);
            return '<script>window.location.assign("/admin")</script>';
        }
    }
}
