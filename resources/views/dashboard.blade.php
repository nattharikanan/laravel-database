<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดีคุณ{{Auth::user()->name}}
            <b class="float-right">จำนวนผู้ใช้ระบบ <span>{{count($user)}}</span>  ท่าน</b> 
        </h2>

    </x-slot>

    <div class="py-12">
      <div class="container">
          <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">e-mail</th>
                    <th scope="col">เริ่มใช้งานระบบ</th>
                  </tr>
                </thead>
                <tbody>
                    @php ($i=1)
                    @foreach ($user as $row) 
                    {{-- ตัวแปรที่ส่งค่ามาจาก route --}}
                   
                  <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
      </div>
    </div>
</x-app-layout>
