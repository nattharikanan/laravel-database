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
                  <div class="card-header">Service</div>
                  <div class="container">
                    <div class="row">
                      <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">ลำดับ</th>
                              <th scope="col">รูป Service</th>
                              <th scope="col">ชื่อ Service</th>
                              <th scope="col">วันที่บันทึก</th>
                              <th scope="col">Edit</th>
                              <th scope="col">Delete</th>
            
                            </tr>
                          </thead>
                          <tbody>
                              @php ($i=1)
                              @foreach ($service as $row) 
                              {{-- ตัวแปรที่ส่งค่ามาจาก route --}}
                             
                            <tr>
                              <th scope="row">{{$service->firstItem()+$loop->index}}</th> 
                              <td><img src="{{asset($row->service_image)}}" width="100px" height="100px"></td>
                              <td >{{$row->service_name}}</td>
                              <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                              <td><a href="{{url('/service/edit/'.$row->id)}}" class="btn btn-primary">แก้ไข</a></td>
                              <td><a href="{{url('/service/softdelete/'.$row->id)}}" class="btn btn-danger">ลบ</a></td>
                
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {{$service->links()}}
                    </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                    <div class="card-header">แบบฟอร์มบริการ</div>
                    <div class="card-body">
                        <form action="{{route('insertService')}}" method="POST" enctype="multipart/form-data">
                            @csrf 
                        {{-- ป้องกันการป้อน script --}}
                            <div class="form-group">
                                <label for="service_name">ชื่อบริการ</label>
                                <input type="text" class="form-control" name="service_name">
                            </div>
                        @error('service_name')
                        <div class="my-2"> <span class="text-danger">{{$message}}</span></div>
                        @enderror
                            <div class="form-group">
                                <label for="service_image">ภาพประกอบ</label>
                                <input type="file" class="form-control" name="service_image">
                            </div>
                        @error('service_image')
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
