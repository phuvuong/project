@extends('admin_layout')
@section('admin_content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Delivery</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Delivery</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">ADD DELIVERY</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
   
            <form method="POST" action="{{ route('save-delivery') }}" id="delivery-form" enctype="multipart/form-data"> 
              @csrf
               @error('msg')
                   <div class="alert alert-danger text-center">{{ $message }}</div>
               @enderror
               @php
               $message = Session::get('message');
               if($message){
                   echo '<div class="alert alert-success text-center">'.$message.'</div>';
                   Session::put('message',null);
               }
               @endphp
              <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Chọn thành phố</label>
                      <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                    
                            <option value="0">--Chọn tỉnh thành phố--</option>
                            @foreach($city as $key => $ci)
                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                            @endforeach

                            
                    </select>
                    @error('city')
                    <span style="color:red;" class="city_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                      <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                        
                            <option value="0">--Chọn quận huyện--</option>
                            
                    </select>
                    @error('province')
                    <span style="color:red;" class="province_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Chọn xã phường</label>
                      <select name="wards" id="wards" class="form-control input-sm m-bot15 wards  ">
                        
                            <option value="0">--Chọn xã phường--</option>  
                            
                    </select>
                    @error('wards')
                    <span style="color:red;" class="wards_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                    <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="Tên phí vận chuyển">
                    @error('fee_ship')
                    <span style="color:red;" class="fee_ship_error">{{ $message }}</span>
                    @enderror
                  </div>
               
              </div>
              <div class="card-footer">
                <button type="submit"   class="btn btn-info add-coupon">Thêm giá vận chuyển</button>
              </div>
            </form>
          </div>
          
        </div>
      
      </div>
    
    </div>
  </section>
@endsection