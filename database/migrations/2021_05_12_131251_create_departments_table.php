<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id(); //รหัสตำแหน่งงาน
            $table->integer('user_id');
            $table->string('department_name');
            $table->timestamps();
            $table->softDeletes(); //เป็นตัวเช็คว่าถ้าข้อมูลว่าถูกลบไปรึป่าว ในอนาคตสามารถกู้คืนได้ ไปเขียนเพิ่มใน Model
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}