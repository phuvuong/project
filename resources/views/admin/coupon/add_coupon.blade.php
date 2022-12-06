@extends('admin_layout')
@section('admin_content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Coupon</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Coupon</li>
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
              <h3 class="card-title">ADD COUPON</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
   
            <form method="POST" action="{{ route('save-coupon') }}" id="coupon-form" enctype="multipart/form-data"> 
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
                <div class="form-group" >
                  <label for="exampleInputEmail1">Tên mã giảm giá</label>
                  <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" >
                    @error('coupon_name')
                        <span style="color:red;" class="coupon_name_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Mã giảm giá</label>
                  <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" >
                    @error('coupon_code')
                    <span style="color:red;" class="coupon_code_error">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Số lượng mã</label>
                    <input type="text" name="coupon_time" class="form-control" id="exampleInputEmail1" >
                    @error('coupon_time')
                      <span style="color:red;" class="coupon_time_error">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tính năng mã</label>
                     <select name="coupon_condition" class="form-control input-sm m-bot15">
                             <option value="0">----Chọn-----</option>
                            <option value="1">Giảm theo phần trăm</option>
                            <option value="2">Giảm theo tiền</option>
                            
                    </select>
                    @error('coupon_condition')
                    <span style="color:red;" class="coupon_condition_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                   <input type="text" name="coupon_number" class="form-control" id="exampleInputEmail1" >
                   @error('coupon_number')
                   <span style="color:red;" class="coupon_number_error">{{ $message }}</span>
                   @enderror
              </div>
              </div>
              <div class="card-footer">
                <button type="submit"   class="btn btn-info add-coupon">Thêm mã giảm giá</button>
              </div>
            </form>
          </div>
          
        </div>
      
      </div>
    
    </div>
  </section>
@endsection