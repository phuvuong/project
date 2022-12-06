@extends('admin_layout')
@section('admin_content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">List Brand</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">List  Brand</li>
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
                  <th>Tên danh mục</th>
                  <th>Logo</th>
                  <th>Slug</th>
                  <th style="width:150px;">Hiển thị</th>
                  <th style="width:30px;"></th>
                  <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($all_brand_product as $key => $brand_pro)
                    <tr>
                        <td>{{ $brand_pro->brand_name }}</td>
                        <td><img src="uploads/backend/brand/{{ $brand_pro->brand_image }}" height="100" width="100"></td>
                        <td>{{ $brand_pro->brand_slug }}</td>
                    <td>
                    <?php
                    if($brand_pro->brand_status ==0){
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
                    <td><div class="alert alert-primary text-center" role="alert"><a href="{{URL::to('/edit-brand/'.$brand_pro->brand_id)}}"><i class="fas fa-edit"></i></a></div></td>
                    
                    <td><div class="alert alert-danger text-center" role="alert"><a onclick="return confirm('Bạn có chắc là muốn xóa thương hiệu này ko?')" href="{{URL::to('/delete-brand/'.$brand_pro->brand_id)}}"  ><i class="fas fa-trash-alt"></i></a></div></td>

                   

    
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                   <td> {!!$all_brand_product->links()!!}</td> 
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