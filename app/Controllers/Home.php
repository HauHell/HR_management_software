<?php

namespace App\Controllers;
use App\Models\DoanhThuModel;

class Home extends BaseController
{
    public function index()
    {
        $doanhthu_model = new DoanhThuModel();
        $doanhthutongs = $doanhthu_model->findAll();
        $thang=getdate();
        $doanhthuthangs = $doanhthu_model->where('Month(dNgayThang)=',$thang['mon'])->findAll();
        $thangtruoc =$thang['mon']-1;
        if($thangtruoc==0){
            $thangtruoc=12;
        }
        $doanhthuthangtruocs = $doanhthu_model->where('Month(dNgayThang)=',$thangtruoc)->findAll();
        $data['doanhthutongs']=$doanhthutongs;
        $data['doanhthuthangs']=$doanhthuthangs;
        $data['doanhthuthangtruocs']=$doanhthuthangtruocs;
        $data['left'] = view("Views/admin/layout/left");
        $data['head'] = view("Views/admin/layout/head");
        $data['content'] = view("Views/admin/pages/index",$data);
        return view('Views/admin/main', $data);
    }
}
