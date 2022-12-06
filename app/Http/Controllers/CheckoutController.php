<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryProduct;
use App\Brand;
use App\Product;
use App\Customer;
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class CheckoutController extends Controller
{
    public function login_checkout(Request $request){


        $cate_product = CategoryProduct::where('category_status','1')->orderBy('category_id','DESC')->get();
        $brand_product = Brand::where('brand_status','1')->orderBy('brand_id','DESC')->get();
        $product = Product::where('product_status','1')->orderBy('product_id','DESC')->limit(8)->get();
        

        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product',$product);

   }

   public function add_customer(Request $request){
    $rules = [
        'customer_email'=>'required|email|max:255|unique:tbl_customers',
        'customer_name'=>'required|max:255',
        'customer_password'=>'required|min:6|max:255',
        'customer_phone'=>'required|numeric'
       
    ];
    $messages = [
        'required'=>" :attribute bắt buộc phải nhập",
        'max'=>" :attribute không được lớn hơn :max ký tự",
        'min'=>" :attribute không được ít hơn :min ký tự",
        'unique'=>":attribute đã tồn tại",
        'email'=>":attribute không phải form email",
        'numeric'=>":attribute phải là số"
    ];
    $attributes = [
        'customer_email'=>"Email khách hàng",
        'customer_name'=>"Tên khách hàng",
        'customer_password'=>"Password khách hàng",
        'customer_phone'=>"SĐT khách hàng"
    ];
    $validator = Validator::make($request->all(),$rules,$messages,$attributes);
    if($validator->fails()) {
        $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
       
    }else{
            $data = $request->all();
            $customer = new Customer();
            $customer->customer_email = $data['customer_email'];
            $customer->customer_phone = $data['customer_phone'];
            $customer->customer_password = md5($data['customer_password']);
            $customer->customer_name = $data['customer_name'];
            $customer->save();
           

            Session::put('message','Thêm tài khoản khách hàng thành công');
            return redirect()->route('login-checkout');
    }
    return back()->withErrors($validator);
    }
    public function login_customer(Request $request){

        $rules = [
        'email_account'=>'required|email|max:255',
        'password_account'=>'required|max:255'
    
       
    ];
    $messages = [
        'required'=>" :attribute bắt buộc phải nhập",
        'max'=>" :attribute không được lớn hơn :max ký tự",

        'email'=>":attribute không phải form email"
        
    ];
    $attributes = [
        'email_account'=>"Email khách hàng",
        'password_account'=>"Password khách hàng",
        
    ];
    $validator = Validator::make($request->all(),$rules,$messages,$attributes);
    if($validator->fails()) {
        $validator->errors()->add('msg1','Đăng nhập thất bại!');
       
    }else{
        $email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
    	
    	
    	if($result){
           
    		Session::put('customer_id',$result->customer_id);
    		return Redirect::to('/checkout');
    	}else{
            Session::put('message','Thông tin tài khoản chưa chính xác');
    		return Redirect::to('/login-checkout');
    	}
        Session::save();
  
    }
    return back()->withErrors($validator);
    }
    public function logout_checkout(){
    	Session::forget('customer_id');
    	return Redirect::to('/login-checkout');
    }
    public function checkout(Request $request){
        $cate_product = CategoryProduct::where('category_status','1')->orderBy('category_id','DESC')->get();
        $brand_product = Brand::where('brand_status','1')->orderBy('brand_id','DESC')->get();
        $product = Product::where('product_status','1')->orderBy('product_id','DESC')->limit(8)->get();
        $city = City::orderby('matp','ASC')->get();


        return view('pages.checkout.checkout')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product',$product)->with('city',$city);
    }
    
  

    public function confirm_order(Request $request){


        
        $data = $request->all();

        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);

 
        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();

        if(Session::get('cart')==true){
           foreach(Session::get('cart') as $key => $cart){
               $order_details = new OrderDetails;
               $order_details->order_code = $checkout_code;
               $order_details->product_id = $cart['product_id'];
               $order_details->product_name = $cart['product_name'];
               $order_details->product_price = $cart['product_price'];
               $order_details->product_sales_quantity = $cart['product_qty'];
               $order_details->product_coupon =  $data['order_coupon'];
               $order_details->product_feeship = $data['order_fee'];
               $order_details->product_feeship = $data['order_fee'];

               $order_details->save();
           }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
   }
}
