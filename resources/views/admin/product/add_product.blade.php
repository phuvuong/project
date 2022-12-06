@extends('admin_layout')
@section('admin_content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Product</li>
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
              <h3 class="card-title">ADD PRODUCT</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
   
            <form method="POST" action="{{ route('save-product') }}" id="product-form" enctype="multipart/form-data"> 
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
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                    <input type="text"  name="product_name" class="form-control " id="slug" placeholder="Tên danh mục" onkeyup="ChangeToSlug();"> 
                    @error('product_name')
                    <span style="color:red;" class="product_name_error">{{ $message }}</span>
                    @enderror
                </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">SL sản phẩm</label>
                    <input type="text" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng">
                    @error('product_quantity')
                    <span style="color:red;" class="product_quantity_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input type="text" name="product_slug" class="form-control " id="convert_slug" placeholder="Tên danh mục">
                    @error('product_slug')
                    <span style="color:red;" class="product_slug_error">{{ $message }}</span>
                    @enderror
                </div>
                     <div class="form-group">
                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                    <input type="text"  name="product_price" class="form-control" id="" placeholder="Tên danh mục">
                    @error('product_price')
                    <span style="color:red;" class="product_price_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="product_image" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Chọn File</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Tải lên</span>
                      </div>
                      
                    </div>
                    @error('product_image')
                      <span style="color:red;" class="product_image_error">{{ $message }}</span>
                      @enderror
                  </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                    <textarea style="resize: none"  rows="8" class="form-control" name="product_desc" id="ckeditor1" placeholder="Mô tả sản phẩm"></textarea>
                    @error('product_desc')
                    <span style="color:red;" class="product_desc_error">{{ $message }}</span>
                    @enderror
                </div>
                 <div class="form-group">
                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                    <textarea style="resize: none" rows="8" class="form-control" name="product_content"  id="id4" placeholder="Nội dung sản phẩm"></textarea>
                    @error('product_content')
                    <span style="color:red;" class="product_content_error">{{ $message }}</span>
                    @enderror
                </div>
                 <div class="form-group">
                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                      <select name="product_cate" class="form-control input-sm m-bot15">
                        @foreach($cate_product as $key => $cate)
                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                        @endforeach
                            
                    </select>
                </div>
                 <div class="form-group">
                    <label for="exampleInputPassword1">Thương hiệu</label>
                      <select name="product_brand" class="form-control input-sm m-bot15">
                        @foreach($brand_product as $key => $brand)
                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                        @endforeach
                            
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Hiển thị</label>
                      <select name="product_status" class="form-control input-sm m-bot15">
                         <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                            
                    </select>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit"   class="btn btn-info add-product">Thêm sản phẩm</button>
              </div>
            </form>
          </div>
          
        </div>
      
      </div>
    
    </div>
  </section>
@endsection