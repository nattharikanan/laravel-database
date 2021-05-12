<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes; 
    
    // กำหนดค่าแบบฟอร์มที่จะบันทึกลงใน model ของเราได้ เราสามารถที่จะกำหนดค่าได้
    protected $fillable = [
        'user_id',
        'department_name'
    ];
    
    public function user()
    {
     return $this->hasOne(User::class,'id','user_id'); //เป็นความสัมพันธ์ 1:1 มาทำ table ที่ต้องการดึง primary keyเขามา
    //ในกรณีนี้คือ department อยากได้ชื่อจากตัว user โดน (User::class,'primary key ของ user','fk ของ departments');
    }
}