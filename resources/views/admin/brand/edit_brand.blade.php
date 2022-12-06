@extends('admin_layout')
@section('admin_content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Brand</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Brand</li>
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
              <h3 class="card-title">ADD BRAND</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @foreach($edit_brand_product as $key => $edit_value)

            <form method="POST" action="{{URL::to('/update-brand/'.$edit_value->brand_id)}}" id="brand-form" enctype="multipart/form-data"> 
                {{ csrf_field() }}
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
                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                    <input type="text" value="{{$edit_value->brand_name}}" name="brand_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên thương hiệu">
                    @error('brand_name')
                        <span style="color:red;" class="brand_name_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                     <input type="text" name="brand_slug" value="{{$edit_value->brand_slug}}" class="form-control" id="convert_slug" placeholder="Slug"placeholder="Slug thương hiệu">
                    @error('brand_slug')
                    <span style="color:red;" class="brand_slug_error">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="brand_image" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">{{$edit_value->brand_image}} </label>

                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Tải lên</span>
                      </div>
                    </div>
                    @error('brand_image')
                      <span style="color:red;" class="brand_image_error">{{ $message }}</span>
                      @enderror
                  </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                    <textarea style="resize: none" rows="8" class="form-control" name="brand_desc" id="exampleInputPassword1" placeholder="Mô tả thương hiệu">{{$edit_value->brand_desc}}</textarea>
                    @error('brand_desc')
                    <span style="color:red;" class="brand_desc_error">{{ $message }}</span>
                    @enderror
                  </div>
                
                  <div class="form-group">
                    <label for="exampleInputPassword1">Hiển thị</label>
                      <select name="brand_status" class="form-control input-sm m-bot15">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                            
                    </select>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit"   class="btn btn-info add-brand">Cập nhật thương hiệu</button>
              </div>
            </form>
            @endforeach
          </div>
          
        </div>
      
      </div>
    
    </div>
  </section>
@endsection