<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;
class ServiceController extends Controller
{
    //
    public function index()
    {
        $service = Service::paginate(5);  //แสดงข้อมูลเท่าที่ต้องการ
        return view('admin.service.index',compact('service'));        
    }

    public function insert(Request $request)
    {
        //ตรวจสอบข้อมูล
        $request->validate([
            'service_name'=>'required|unique:services|max:255', //ห้ามป้อนค่าวว่าง ห้ามซ้ำ ห้ามยาว
            'service_image'=>'required|mimes:jpg,jpeg,png'
        ],
        [
        'service_name.required'=>'กรุณาป้อนชื่อบริการ',
        'service_name.max'=>'ห้ามป้อนข้อความเกิน 255 ตัวอักษร',
        'department_nameservice_name.unique'=>'ชื่อบริการนี้นี้มีในระบบแล้วว กรุณาตรวจสอบอีกครั้ง',
        'service_image.required'=> 'กรุณาใส่รูปภาพ'
        ]
    );

        //การเข้ารหัสรุปภาพ
        $service_image = $request->file('service_image');
        //genชื่อภาพ
        $name_gen = hexdec(uniqid());
        //ดึงนาสกถลไฟล์ภาพ
        $img_ext = strtolower($service_image->getClientOriginalExtension());
        
        $img_name = $name_gen .'.'.$img_ext;
        
        //อัพโหลดและบันทึกข้อทูล
        $upload_location = 'image/services/';
        $full_path =  $upload_location.$img_name;

       //บันทึกข้อมูล
       Service::insert([
           'service_name'=>$request->service_name,
           'service_image'=>$full_path,
           'created_at'=>Carbon::now()
       ]);
        $service_image->move($upload_location,$img_name);
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }
}