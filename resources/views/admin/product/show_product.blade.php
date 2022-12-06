@extends('admin_layout')
@section('admin_content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">List Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">List Product</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
           
                @php
                $message = Session::get('message');
                if($message){
                    echo '<div class="alert alert-success text-center">'.$message.'</div>';
                    Session::put('message',null);
                }
                @endphp
             
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Tên sản phẩm</th>
                  <th>Hình ảnh sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Slug</th>
                  <th>Giá</th>
                  <th>Danh mục</th> 
                  <th>Thương hiệu</th>
                  <th style="width:150px;">Hiển thị</th>
                  <th style="width:30px;"></th>
                  <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($all_product as $key => $pro)
                    <tr>
                        <td>{{ $pro->product_name }}</td>
                        <td><img src="uploads/backend/product/{{ $pro->product_image }}" height="100" width="100"></td>
                        <td>{{ $pro->product_quantity }}</td>
                        <td>{{ $pro->product_slug }}</td>
                        <td>{{ number_format($pro->product_price,0,',','.') }}đ</td>
                        <td>{{ $pro->category_name }}</td>
                        <td>{{ $pro->brand_name }}</td>
                    <td>
                    <?php
                    if($pro->product_status==0){
                     ?>
                     <div class="alert alert-danger text-center" role="alert">Ẩn</div>
                     <?php
                      }else{
                     ?>  
                     <div class="alert alert-success text-center" role="alert">Hiển thị</div>
                     <?php
                    }
                   ?>
                  </td>
                    <td><div class="alert alert-primary text-center" role="alert"><a href="{{URL::to('/edit-product/'.$pro->product_id)}}"><i class="fas fa-edit"></i></a></div></td>
                    
                    <td><div class="alert alert-danger text-center" role="alert"><a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này ko?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}"  ><i class="fas fa-trash-alt"></i></a></div></td>

                   

    
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                   <td>  {!!$all_product->links()!!}</td> 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection