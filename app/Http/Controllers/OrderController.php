<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Feeship;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use App\Coupon;
use App\Product;

class OrderController extends Controller
{
    public function  AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function manage_order(){
        $this->AuthLogin();
        $order = Order::orderby('created_at','DESC')->paginate(7);

    	return view('admin.order.list_order')->with(compact('order'));
    }
    public function view_order($order_code){
        $this->AuthLogin();
		$order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
        $order = Order::where('order_code',$order_code)->get();
        foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
		}
        $customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

        foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
        if($product_coupon != '0'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
        return view('admin.order.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'));
    }
   public function update_order_qty(Request $request){
            $data = $request->all();
            $order = Order::find($data['order_id']);
            $order->order_status = $data['order_status'];
            $order->save();
            if($order->order_status==2){
                foreach($data['order_product_id'] as $key => $product_id){
				
                    $product = Product::find($product_id);
                    $product_quantity = $product->product_quantity;
                    $product_sold = $product->product_sold;
                    foreach($data['quantity'] as $key2 => $qty){
                            if($key==$key2){
                                    $pro_remain = $product_quantity - $qty;
                                    $product->product_quantity = $pro_remain;
                                    $product->product_sold = $product_sold + $qty;
                                    $product->save();
                            }
                    }
                }
            }
            elseif($order->order_status=2){
                foreach($data['order_product_id'] as $key => $product_id){
				
                    $product = Product::find($product_id);
                    $product_quantity = $product->product_quantity;
                    $product_sold = $product->product_sold;
                    foreach($data['quantity'] as $key2 => $qty){
                            if($key==$key2){
                                    $pro_remain = $product_quantity + $qty;
                                    $product->product_quantity = $pro_remain;
                                    $product->product_sold = $product_sold - $qty;
                                    $product->save();
                            }
                    }
                }
            }
   }
}
