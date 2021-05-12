<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    //
    public function index()
    {
       // $department = Department::all(); 
        //หรือ $department = DB::table('departments')->get();
        $department = Department::paginate(5);  //แสดงข้อมูลเท่าที่ต้องการ
        $trashDepartment = Department::onlyTrashed()->paginate(5); //ดึงข้อมูลถังขยะ
        return view('admin.department.index',compact('department','trashDepartment'));        
    }
    public function insert(Request $request)
    {
        //ตรวจสอบข้อมูล
        $request->validate([
            'department_name'=>'required|unique:departments|max:255' //ห้ามป้อนค่าวว่าง ห้ามซ้ำ ห้ามยาว
        ],
        [
        'department_name.required'=>'กรุณาป้อนชื่อแผนก',
        'department_name.max'=>'ห้ามป้อนข้อความเกิน 255 ตัวอักษร',
        'department_name.unique'=>'แผนกนี้มีในระบบแล้วว กรุณาตรวจสอบอีกครั้ง'
        ]
    );
    //บันทึกข้อมูลแบบทั่วไป
    /*$department = new Department;
    $department->department_name = $request->department_name; //ตาราง -> ชื่อ textfeild name ที่ส่งมา
    $department->user_id = Auth::user()->id; //import use Illuminate\Support\Facades\Auth; ด้วย
    $department->save();    */

    //บันทึกข้แมูลแบบ query builder
    $data = array();
    $data["department_name"]=$request->department_name;
    $data["user_id"] = Auth::user()->id;
    //inport use Illuminate\Support\Facades\DB;
    DB::table('departments')->insert($data);
    return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
      /* dd($request->department_name);    //การ debug   */
    }
    public function edit($id)
    {
        $department = Department::find($id); //หาข้อมูล
        return view('admin.department.edit',compact('department'));
        //dd($department->department_name);
        
    }

    public function update(Request $request ,$id)
    {
        $request->validate([
            'department_name'=>'required|unique:departments|max:255' //ห้ามป้อนค่าวว่าง ห้ามซ้ำ ห้ามยาว
        ],
        [
        'department_name.required'=>'กรุณาป้อนชื่อแผนก',
        'department_name.max'=>'ห้ามป้อนข้อความเกิน 255 ตัวอักษร',
        'department_name.unique'=>'แผนกนี้มีในระบบแล้วว กรุณาตรวจสอบอีกครั้ง'
        ]
    );

    //update ข้อมูล
    $update = Department::find($id)->update([
        'department_name'=>$request->department_name,
        'user_id'=>Auth::user()->id
    ]);
    return redirect()->route('department')->with('success','บันทึกข้อมูลเรียบร้อย');

    }
    public function softdelete ($id)
    {
        $delete = Department::find($id)->delete();
        return redirect()->route('department')->with('success','ลบข้อมูลเรียบร้อย');
    }

    public function restore ($id)
    {
       $restore = Department::withTrashed()->find($id)->restore(); //ไปค้นถังขยะ
       return redirect()->route('department')->with('success','กู้คืนข้อมูลเรียบร้อย');
    }
    public function focedelete ($id)
    {
       $focedelete = Department::onlyTrashed()->find($id)->forceDelete();
       return redirect()->route('department')->with('success','ลบข้อมูลถาวร');
    }
    }
    