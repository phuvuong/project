<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\CategoryProduct;
use App\Brand;
use App\Product;
use App\Coupon;
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
session_start();

class CartController extends Controller
{
    public function add_cart(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }
        else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
        
        Session::save();
    }
    public function show_cart(Request $request){
        $cate_product = CategoryProduct::where('category_status','1')->orderBy('category_id','DESC')->get();
        $brand_product = Brand::where('brand_status','1')->orderBy('brand_id','DESC')->get();
        $product = Product::where('product_status','1')->orderBy('product_id','DESC')->limit(8)->get();
        $city = City::orderby('matp','ASC')->get();

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product',$product)->with('city',$city);
    }
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            
            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;

                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){

                        $cart[$session]['product_qty'] = $qty;
                        return redirect()->back()->with('message','Cập nhật số lượng thành công');
                    
                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity'])
                    {
                        return redirect()->back()->with('error','Cập nhật số lượng thất bại');
                    }

                }

            }

            Session::put('cart',$cart);
            return redirect()->back()->with('message','Cập nhật số lượng thành công');
        }else{
            return redirect()->back()->with('message','Cập nhật số lượng thất bại');
        }
    }
    public function delete_cart($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                    
                }
            }
            Session::put('cart',$cart);
            Session::forget('coupon');
            Session::forget('fee');

            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
    }
    public function delete_all_cart(){
        $cart = Session::get('cart');
        if($cart==true){
           
            Session::forget('cart');
            Session::forget('coupon');
            Session::forget('fee');

            return redirect()->back()->with('message','Xóa hết giỏ thành công');
        }
    }
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,

                    );
                Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }
        }
        else
        {
            return redirect()->back()->with('error','Mã giảm giá không đúng');
        }
        
    }
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }

            }else{

                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
    }
    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::put('message','Thêm phí vận chuyển thành công');
                        Session::save();
                    }
                }else{ 
                    Session::put('fee',25000);
                    Session::put('message','Thêm phí vận chuyển thành công');
                    Session::save();
                }
            }
           
        }
    }
}
