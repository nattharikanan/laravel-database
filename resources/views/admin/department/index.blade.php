<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
      <div class="container">
          <div class="row">
              <div class="col-md-8">
                  @if(session("success"))
                  <div class="alert alert-success">{{session('success')}}</div>
                  @endif
                  <div class="card-header">ตารางข้อมูลแผนก </div>
                  <div class="container">
                    <div class="row">
                      <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">ลำดับ</th>
                              <th scope="col">ชื่อตำแหน่ง</th>
                              <th scope="col">พนักงาน</th>
                              <th scope="col">วันที่บันทึกข้อมูล</th>
                              <th scope="col">แก้ไข</th>
                              <th scope="col">ลบข้อมูล</th>
                            </tr>
                          </thead>
                          <tbody>
                              @php ($i=1)
                              @foreach ($department as $row) 
                              {{-- ตัวแปรที่ส่งค่ามาจาก route --}}
                             
                            <tr>
                              <th scope="row">{{$department->firstItem()+$loop->index}}</th> 
                              <td>{{$row->department_name}}</td>
                              <td>{{$row->user->name}}</td>
                              <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                              <td><a href="{{url('/department/edit/'.$row->id)}}" class="btn btn-primary">แก้ไข</a></td>
                              <td><a href="{{url('/department/softdelete/'.$row->id)}}" class="btn btn-danger">ลบ</a></td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {{$department->links()}}
                    </div>
                </div>
                @if (count($trashDepartment)>0)
                <div class="card my-2">
                       
                    @if(session("success"))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="card-header"> ถังขยะ </div>
                    <div class="container">
                      <div class="row">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อตำแหน่ง</th>
                                <th scope="col">พนักงาน</th>
                                <th scope="col">วันที่บันทึกข้อมูล</th>
                                <th scope="col">กู้คืนข้อมูล</th>
                                <th scope="col">ลบข้อมูลถาวร</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php ($i=1)
                                @foreach ($trashDepartment as $row)  
                                {{-- ตัวแปรที่ส่งค่ามาจาก route --}}
                               
                              <tr>
                                <th scope="row">{{$trashDepartment->firstItem()+$loop->index}}</th> 
                                <td>{{$row->department_name}}</td>
                                <td>{{$row->user->name}}</td>
                                <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                                <td><a href="{{url('/department/restore/'.$row->id)}}" class="btn btn-primary">กู้คืนข้อมูล</a></td>
                                <td><a href="{{url('/department/focedelete/'.$row->id)}}" class="btn btn-danger">ลบข้อมูลถาวร</a></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          {{$trashDepartment->links()}}
                      </div>
                  </div>
                </div>
                @endif
              </div>
              <div class="col-md-4">
                <div class="card">
                    <div class="card-header">แบบฟอร์ม</div>
                    <div class="card-body">
                        <form action="{{route('insertDepartment')}}" method="POST">
                            @csrf 
                        {{-- ป้องกันการป้อน script --}}
                            <div class="form-group">
                                <label for="department_name">ชื่อแผนก</label>
                                <input type="text" class="form-control" name="department_name">
                            </div>
                        @error('department_name')
                        <div class="my-2"> <span class="text-danger">{{$message}}</span></div>
                           
                        @enderror
                            <br>
                            <input type="submit" value="บันทึก" class="btn btn-primary">
                        </form>
                    </div>  
                </div>
               
              </div>
             

          </div>
      </div>
    </div>
</x-app-layout>
