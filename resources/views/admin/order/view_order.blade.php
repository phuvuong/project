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

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Thông tin đăng nhập</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                
                    <th style="width: 30%">
                        Tên khách hàng
                    </th>
                    <th style="width: 30%">
                        Số điện thoại
                    </th>
                    <th>
                        Email
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                <td>{{$customer->customer_name}}</td>
                <td>{{$customer->customer_phone}}</td>
                <td>{{$customer->customer_email}}</td>
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
<div class="card">
      <div class="card-header">
        <h3 class="card-title"> Thông tin vận chuyển hàng</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                   
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Ghi chú</th>
                    <th>Hình thức thanh toán</th>
                </tr>
            </thead>
            <tbody>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
             <td>{{$shipping->shipping_phone}}</td>
             <td>{{$shipping->shipping_email}}</td>
             <td>{{$shipping->shipping_notes}}</td>
             <td>@if($shipping->shipping_method==0) Chuyển khoản @else Tiền mặt @endif</td>
            </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Chi tiết đơn hàng</h3>
  
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                        <th>STT</th>
                      <th>Tên sản phẩm</th>
                      <th>Số lượng kho còn</th> 
                      <th>Số lượng</th>
                      <th>Giá sản phẩm</th>
                      <th>Tổng tiền</th>
                  </tr>
              </thead>
              <tbody>
                
                    @php 
                    $i = 0;
                    $total = 0;
                    @endphp
                  @foreach($order_details as $key => $details)
          
                    @php 
                    $i++;
                    $subtotal = $details->product_price*$details->product_sales_quantity;
                    $coupon = $details->product_coupon;
                    $total+=$subtotal;
                    @endphp
                    <tr>
                    <td><i>{{$i}}</i></td>
                    <td>{{$details->product_name}}</td>
                    <td>{{$details->product->product_quantity}}</td>

                
                  <td >
                    {{$details->product_sales_quantity}}
                    <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
                    <input type="hidden" name="product_sales_quantity" value="{{$details->product_sales_quantity}}">
                  </td>
                  <td>{{number_format($details->product_price ,0,',','.')}}VND</td>
                  <td>{{number_format($subtotal ,0,',','.')}}VND</td>
                </tr>
                    @endforeach
               
                
              </tbody>
              <div class="card-body p-0">
                    <table class="table ">
                        <tr>
                            <td>Tổng tiền: {{number_format($total ,0,',','.')}}VND</td>
                            
                        </tr>
                        <tr>
                            <td>Mã giảm giá:
                              @if ($coupon_condition==1)
                                  {{ $coupon }}(-{{ $coupon_number }}%)
                                  @elseif($coupon_condition==2)
                                  {{ $coupon }}(-{{number_format($coupon_number ,0,',','.')}}VND)
                                 @else
                                    {{ $coupon }}
                              @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Phí vận chuyển: {{number_format($details->product_feeship ,0,',','.')}}VND </td>
                        </tr>
                        <tr>
                          <td>Thanh toán: 
                            @php 
                            $total_coupon = 0;
                            @endphp
                            @if ($coupon_condition==1)
                            @php
                            $total_after_coupon = ($total*$coupon_number)/100;
                            $total_coupon = $total + $details->product_feeship - $total_after_coupon ;
                            @endphp
                            {{number_format($total_coupon,0,',','.')}}VND
                            @else
                            @php
                            $total_coupon = $total + $details->product_feeship - $coupon_number ;
                            @endphp
                            {{number_format($total_coupon,0,',','.')}}VND
                            @endif
                          </td>
                        </tr>
                        <tr>
                          
                            <td>
                              @foreach($order as $key => $or)
                              @if($or->order_status==1)
                              <form>
                                @csrf

                                <select class="form-control order_details">
                                
                                  <option id="{{$or->order_id}}" selected value="1">Đơn hàng mới -Chưa xử lý</option>
                                  <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                                </select>
                              </form>
                              @else
                              <form>
                                @csrf
                                <select class="form-control order_details">
                                 
                                  <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                                  <option id="{{$or->order_id}}" selected  value="2">Đã xử lý-Đã giao hàng</option>
                                </select>
                              </form>
                              @endif
                              @endforeach
                            </td>
                           
                        </tr>
                    </table>
            </div>

            </table>
        </div>
        
        <!-- /.card-body -->
      </div>
  </section>
@endsection