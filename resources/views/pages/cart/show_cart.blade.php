<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="{{asset('https://fonts.gstatic.com')}}">
    <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap')}}"> 

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css')}}"> 
    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{asset('shop/lib/animate/animate.min.css')}}"> 
    <link rel="stylesheet" href="{{asset('shop/lib/owlcarousel/assets/owl.carousel.min.css')}}"> 

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{asset('shop/css/style.css')}}"> 
    <link rel="stylesheet" href="{{asset('backend/dist/css/sweetalert.css')}}" >
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">About</a>
                    <a class="text-body mr-3" href="">Contact</a>
                    <a class="text-body mr-3" href="">Help</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                
                 
                <?php
                           $customer_id = Session::get('customer_id');
                           
                           if($customer_id!=NULL){ 
                         ?>
                         
                          <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i>Logout</a></li>
                        
                        <?php
                    }else{
                         ?>
                         <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i>Login</a></li>
                         <?php 
                     }
                         ?>
            
       
        
    </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="{{ URL::to('/trang-chu')}}" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    @foreach($category as $key => $cate)

                    <div class="navbar-nav w-100">
                        {{--  <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dresses <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="" class="dropdown-item">Men Dresses</a>
                                <a href="" class="dropdown-item">Women Dresses</a>
                                <a href="" class="dropdown-item">Baby Dresses</a>
                            </div>
                        </div>   --}}
                        
                        <a href="{{ URL::to('/danh-muc-san-pham/'.$cate->category_id) }}" class="nav-item nav-link">{{ $cate->category_name }}</a>
                      
                    </div>
                    @endforeach
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ URL::to('/trang-chu')}}" class="nav-item nav-link">Home</a>
                            <a href="{{ URL::to('/trang-chu')}}" class="nav-item nav-link">Shop</a>
                            <a href="{{ URL::to('/show-cart')}}" class="nav-item nav-link">Shopping Cart</a>
                            <a href="detail.html" class="nav-item nav-link">Checkout</a>
                            
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        
        <div class="row px-xl-5">
            
            <div class="col-lg-8 table-responsive mb-5">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                    
                @endif
               
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <form action="{{url ('/update-cart') }}" method="post">
                        @csrf
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                          
                       
                        <tbody class="align-middle">
                            @if(Session::get('cart')==true)
                            @php
                            $total = 0;
                        @endphp
                         @foreach(Session::get('cart') as $key =>$cart)
                        @php
                        $subtotal = $cart['product_price']*$cart['product_qty'];
                        $total+=$subtotal;
                        @endphp
                        <tr>
                            <td class="align-middle cart_product"><img src="{{asset('uploads/backend/product/'.$cart['product_image'])}}" alt="" style="width: 50px;"> {{$cart['product_name']}}</td>
                            <td class="align-middle cart-price">{{number_format($cart['product_price'],0,',','.')}}VND</td>
                            <td class="align-middle">
                                
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                       
                                    <input type="number" name="cart_qty[{{$cart['session_id']}}]" class="form-control form-control-sm bg-secondary border-0 text-center cart_quantity" min="1" value="{{$cart['product_qty']}}">
                                        
                                    </div>
                               
                                
                            </td>
                            <td class="align-middle cart_total">{{number_format($subtotal,0,',','.')}}VND</td>
                            <td class="align-middle cart_delete"><a href="{{url('delete-cart/'.$cart['session_id'])}}" class="btn btn-sm btn-danger cart_quantity_delete"><i class="fa fa-times"></i> </td>
                        </tr>
                       
                       
                        
                        @endforeach
                       <td><input type="submit" name="update_qty" class="btn btn-primary" value="Cập nhật giỏ hàng"></input></td> 
                       <td><a  href="{{url('/delete-all-cart')}}" class="btn btn-primary">Xoá hết giỏ hàng</a></td> 

                       <td>
                        @if(Session::get('coupon'))
                        <a  href="{{url('/unset-coupon')}}" class="btn btn-primary">Xoá mã khuyến mãi</a>
                        @endif
                        </td> 
                        
                       @else
                       <tr>
                        <div class="alert alert-warning">Làm ơn thêm sản phẩm</div>
                       </tr>
                       @endif
                       
                    </tbody>
                    
                    </form>
                        
                 
                  
                </table>
                

            </div>
           

            @if(Session::get('cart')==true)
            @php
            $total = 0;
            @endphp
         @foreach(Session::get('cart') as $key =>$cart)
        @php
        $subtotal = $cart['product_price']*$cart['product_qty'];
        $total+=$subtotal;
        @endphp
        @endforeach
            <div class="col-lg-4">
                @if(Session::get('cart'))
                <form class="mb-30" action="{{ url('/check-coupon') }}" method="post" enctype="multipart/form">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" name="coupon" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-primary check_coupon" value="Apply Coupon"></input>
                        </div>
                    </div>
                </form>
                @endif


                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Delivery</span></h5>
                
                <div class="bg-light p-30">
                    <form> 
                        @csrf
                        <div class="card-body">
                          <div class="form-group">
                              <label for="exampleInputPassword1">Chọn thành phố</label>
                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                              
                                      <option value="">--Chọn tỉnh thành phố--</option>
                                      @foreach($city as $key => $ci)
                                      <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                      @endforeach
          
                                      
                              </select>
                           
                          </div>
                          <div class="form-group">
                              <label for="exampleInputPassword1">Chọn quận huyện</label>
                                <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                  
                                      <option value="">--Chọn quận huyện--</option>
                                      
                              </select>
                              
                          </div>
                          <div class="form-group">
                              <label for="exampleInputPassword1">Chọn xã phường</label>
                                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards  ">
                                  
                                      <option value="">--Chọn xã phường--</option>  
                                      
                              </select>
                            
                          </div>
                          
                         
                        </div>
                        <div class="card-footer">
                          <input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-block btn-primary font-weight-bold py-3 calculate_delivery">

                        </div>
                      </form>
                         
                </div>


                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    
                    <div class="border-bottom pb-2">
                        
                        <form action="{{url ('/update-cart') }}" method="post">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>{{number_format($total,0,',','.')}}VND</h6>
                        </div>
                    </form>
                    
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="font-weight-medium">Coupon</h6>

                            @if(Session::get('cart')==true)
                            @if(Session::get('coupon'))
                            <h6 class="font-weight-medium">
                                @foreach(Session::get('coupon') as $key => $cou)
                                @if($cou['coupon_condition']==1)
                                - {{$cou['coupon_number']}} %
                                @elseif($cou['coupon_condition']==2)
                                -{{number_format($cou['coupon_number'],0,',','.')}} VND
                                @endif
                                @endforeach

                            </h6>
                            @else
                            <h6 class="font-weight-medium">
                               
                                    0
                            </h6>
                            @endif 
                            @else
                            <h6 class="font-weight-medium">
                               

                            </h6>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">{{number_format(Session::get('fee'),0,',','.')}}VND</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                @php
                                $total_fee = $total + Session::get('fee')
                                @endphp
                                <h5>
                                    @if(Session::get('coupon'))
                                    
                                    <h5>
                                        @foreach(Session::get('coupon') as $key => $cou)
                                        @if($cou['coupon_condition']==1)
                                         {{number_format($total+ Session::get('fee')-$total_coupon = ($total*$cou['coupon_number'])/100,0,',','.')}}VND
                                        @elseif($cou['coupon_condition']==2)
                                         {{number_format($total_coupon = $total + Session::get('fee') - $cou['coupon_number'],0,',','.')}} VND
                                        @endif
                                        @endforeach
                                    </h5>
                                    @else
                                    <h5>
                                        {{number_format($total_fee,0,',','.')}}VND
                                    </h5>
                                    @endif 
                                    
                                </h5>
                            </div>
                        </div>
                        @if(Session::get('customer_id'))
                        @if(Session::get('fee'))
                                <a href="{{URL::to('/checkout')}}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
	                          	@else
                                  <div class="alert alert-warning">Làm ơn thêm phí vận chuyển</div>
                                  <a href="{{URL::to('/show-cart')}}"  class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                                @endif
                                @else
	                          	<a href="{{URL::to('/login-checkout')}}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
								@endif
                        
                    </div>
                </div>
            </div>
           
            @endif;
        </div>
     
    </div>

    <!-- Cart End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="{{asset('https://code.jquery.com/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('shop/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('shop/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('shop/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('shop/mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('shop/js/main.js')}}"></script>
    <script src="{{asset('backend/dist/js/sweetalert.min.js')}}" ></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh =='' && xaid ==''){
                    swal("Làm ơn chọn phí vận chuyển!")
                }else{
                    $.ajax({
                    url : '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(){
                       location.reload(); 
                    }
                    });
                } 
        });
    });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
           
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        });
        }); 
    </script>
</body>

</html>