<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CouponController extends Controller
{
    public function  AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_coupon()
    {
        $this->AuthLogin();
        return view('admin.coupon.add_coupon');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_coupon()
    {
        $this->AuthLogin();

        $coupon = Coupon::orderby('coupon_id','DESC')->paginate(5);
    	return view('admin.coupon.show_coupon')->with(compact('coupon'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_coupon(Request $request)
    {
        $this->AuthLogin();

        $rules = [
            'coupon_name'=>'required|min:6|max:255',
            'coupon_code'=>'required|min:6|max:255|unique:tbl_coupon',
            'coupon_time'=>'required|numeric',
            'coupon_condition'=>'required|not_in:0',
            'coupon_number'=>'required|numeric'
        ];
        $messages = [
            'coupon_condition.not_in'=>" :attribute bắt buộc phải chọn",
            'required'=>" :attribute bắt buộc phải nhập",
            'max'=>" :attribute không được lớn hơn :max ký tự",
            'unique'=>":attribute đã tồn tại",
            'numeric'=>":attribute phải là số"
        ];
        $attributes = [
            'coupon_name'=>"Tên mã giảm giá",
            'coupon_code'=>"Code mã giảm giá",
            'coupon_time'=>"Số lượng mã giảm giá",
            'coupon_condition'=>"Tính năng mã",
            'coupon_number'=>"Quà giảm giá"
        ];

        $validator = Validator::make($request->all(),$rules,$messages,$attributes);
        if($validator->fails()) {
            $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
           
        }
        else{
            $data = $request->all();

            $coupon = new Coupon;

            $coupon->coupon_name = $data['coupon_name'];
            $coupon->coupon_number = $data['coupon_number'];
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->coupon_time = $data['coupon_time'];
            $coupon->coupon_condition = $data['coupon_condition'];
            $coupon->save();
            Session::put('message','Thêm mã giảm giá thành công');
            return redirect()->route('show-coupon');
        }
            return back()->withErrors($validator);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_coupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
    	$coupon->delete();
    	Session::put('message','Xóa mã giảm giá thành công');
        return redirect()->route('show-coupon');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unset_coupon(){
		$coupon = Session::get('coupon');
        if($coupon==true){
          
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
