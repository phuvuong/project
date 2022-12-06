@extends('admin_layout')
@section('admin_content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Order</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Manage Order</li>
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
                  <th>Thứ tự</th>
                  <th>Mã đơn hàng</th>
                  <th>Ngày tháng đặt hàng</th>
                  <th style="width:250px;">Tình trạng đơn hàng</th>
                  <th style="width:30px;"></th>
                  <th style="width:30px;"></th>
                </tr>
                </thead>
                <tbody>
                    @php 
                    $i = 0;
                    @endphp
                    @foreach($order as $key => $ord)
                    @php 
                    $i++;
                    @endphp
                    <tr>
                    <td>{{$i}}</td>
                    <td>{{ $ord->order_code }}</td>
                    <td>{{ $ord->created_at }}</td>
                    <td>@if($ord->order_status==1)
                        <div class="alert alert-success text-center" role="alert">Đơn hàng mới</div>
                         @else 
                         <div class="alert alert-secondary text-center" role="alert">Đã xử lý</div>
                         @endif
                     </td>
                    <td><div class="alert alert-primary text-center" role="alert"><a href="{{URL::to('/view-order/'.$ord->order_code)}}"><i class="fas fa-edit"></i></a></div></td>
                    
                    <td><div class="alert alert-danger text-center" role="alert"><a onclick="return confirm('Bạn có chắc là muốn xóa thương hiệu này ko?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}"  ><i class="fas fa-trash-alt"></i></a></div></td>

                   

    
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    {!!$order->links()!!}
                </tr>
                </tfoot>
              </table>
            </div>
           
          </div>
       

          
        
        </div>
       
      </div>
    
    </div>
    
  </section>
@endsection