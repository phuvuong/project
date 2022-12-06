@extends('admin_layout')
@section('admin_content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Delivery List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Show Delivery</li>
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
                    <div><a class="alert alert-success btn-lg "  role="alert" href="{{ URL::to('/add-delivery') }}"><i class="fa fa-plus"></i></a></div>
              </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Thành phố</th>
                    <th>Quận huyện</th>
                    <th>Xã phường</th>
                    <th>Phí vận chuyển</th>
                    <th style="width:30px;"></th>
                   
                </tr>
                </thead>
                <tbody>
                    @foreach($feeship as $key => $fee)
                <tr>
                    <td>{{ $fee->city->name_city }}</td>
                    <td>{{ $fee->province->name_quanhuyen}}</td>
                    <td>{{ $fee->wards->name_xaphuong }}</td>
                    <td>{{ number_format($fee->fee_feeship,0,',','.') }}</td>
                  <td><div class="alert alert-danger text-center" role="alert"><a onclick="return confirm('Bạn có chắc là muốn xoá mã giảm giá này ko?')" href="{{URL::to('/delete-delivery/'.$fee->fee_id)}}"  ><i class="fas fa-trash-alt"></i></a></div></td>

                   

    
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                   <td> {!!$feeship->links()!!}</td> 
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