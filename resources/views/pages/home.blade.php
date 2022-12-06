
@extends('layout')

@section('content')

<h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
<div class="row px-xl-5">
            @foreach ($product as $key => $pro)
            <div  class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <form>
                    @csrf
                    <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                    <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                  
                    <input type="hidden" value="{{$pro->product_quantity}}" class="cart_product_quantity_{{$pro->product_id}}">
                    
                    <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                    <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                    <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img  class="img-fluid w-100" src="{{URL::to('uploads/backend/product/'.$pro->product_image)}}" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{ URL::to('/chi-tiet-san-pham/'.$pro->product_id) }}"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="{{ URL::to('/chi-tiet-san-pham/'.$pro->product_id) }}">{{ $pro->product_name }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{number_format( $pro->product_price).'VND' }}</h5><h6 class="text-muted ml-2"><del>{{number_format( $pro->product_price).'VND' }}</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                        <div>
                            <button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-id_product="{{$pro->product_id}}"><i class="fa fa-shopping-cart mr-1">Add to cart</i></button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            @endforeach
           
            </div>
@endsection