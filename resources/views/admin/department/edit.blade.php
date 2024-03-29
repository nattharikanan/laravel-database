<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
      <div class="container">
          <div class="row">
              <div class="col-md-8">
                <div class="card">
                    <div class="card-header">แแบบฟอร์มแก้ไขข้อมูล</div>
                    <div class="card-body">
                        <form action="{{url('/department/update/'.$department->id)}}" method="POST">
                            @csrf 
                        {{-- ป้องกันการป้อน script --}}
                            <div class="form-group">
                                <label for="department_name">ชื่อแผนก</label>
                                <input type="text" class="form-control" name="department_name" value ="{{$department->department_name}}" >
                            </div>
                        @error('department_name')
                        <div class="my-2"> <span class="text-danger">{{$message}}</span></div>
                           
                        @enderror
                            <br>
                            <input type="submit" value="แก้ไข" class="btn btn-primary">
                        </form>
                    </div>  
                </div>
            
              </div>
           
             

          </div>
      </div>
    </div>
</x-app-layout>
