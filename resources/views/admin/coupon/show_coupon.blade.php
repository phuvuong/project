@extends('admin_layout')
@section('admin_content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Coupon List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Show Coupon</li>
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
                <div class="card-header">
                    <div><a class="alert alert-success btn-lg "  role="alert" href="{{ URL::to('/add-coupon') }}"><i class="fa fa-plus"></i></a></div>
              </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Tên mã giảm giá</th>
                    <th>Mã giảm giá</th>
                    <th>Số lượng giảm giá</th>
                    <th>Điều kiện giảm giá</th>
                    <th>Số giảm</th>
                    <th style="width:30px;"></th>
                   
                </tr>
                </thead>
                <tbody>
                    @foreach($coupon as $key => $cou)
                <tr>
                    <td>{{ $cou->coupon_name }}</td>
                    <td>{{ $cou->coupon_code }}</td>
                    <td>{{ $cou->coupon_time }}</td>
                    <td><span class="text-ellipsis">
                      <?php
                       if($cou->coupon_condition==1){
                        ?>
                        Giảm theo %
                        <?php
                         }else{
                        ?>  
                        Giảm theo tiền
                        <?php
                       }
                      ?>
                    </span>
                  </td>
                  <td><span class="text-ellipsis">
                    <?php
                     if($cou->coupon_condition==1){
                      ?>
                      Giảm {{$cou->coupon_number}} %
                      <?php
                       }else{
                      ?>  
                      Giảm {{number_format($cou->coupon_number)}} VND
                      <?php
                     }
                    ?>
                  </span>
                </td>
                  <td><div class="alert alert-danger text-center" role="alert"><a onclick="return confirm('Bạn có chắc là muốn xoá mã giảm giá này ko?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}"  ><i class="fas fa-trash-alt"></i></a></div></td>

                   

    
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                   <td> {!!$coupon->links()!!}</td> 
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