@extends('admin_layout')
@section('admin_content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Category</li>
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
              <h3 class="card-title">ADD CATEGORY</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
   
            <form method="POST" action="{{ route('save-category') }}" id="category-form"> 
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
                    <label for="exampleInputEmail1">Tên danh mục</label>
                    <input type="text"  class="form-control category_name" onkeyup="ChangeToSlug();" value="{{ old('category_name') }}"  name="category_name"  id="slug" placeholder="Danh mục" >
                    @error('category_name')
                        <span style="color:red;" class="category_name_error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input type="text" name="slug_category_product" class="form-control slug_category_product" id="convert_slug" placeholder="Tên danh mục">
                    @error('slug_category_product')
                    <span style="color:red;" class="slug_category_product_error">{{ $message }}</span>
                    @enderror
                  </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                    <textarea style="resize: none" rows="8" class="form-control category_desc" name="category_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                    @error('category_desc')
                    <span style="color:red;" class="category_desc_error">{{ $message }}</span>
                    @enderror
                  </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Từ khóa danh mục</label>
                    <textarea style="resize: none" rows="8" class="form-control meta_keywords" name="meta_keywords" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                    @error('meta_keywords')
                    <span style="color:red;" class="meta_keywords_error">{{ $message }}</span>
                    @enderror
                  </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Hiển thị</label>
                      <select name="category_status" class="form-control input-sm m-bot15 category_status">
                           <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                            
                    </select>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit"   class="btn btn-info add-category">Thêm danh mục</button>
              </div>
            </form>
          </div>
          
        </div>
      
      </div>
    
    </div>
  </section>
@endsection