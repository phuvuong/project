<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
class DeliveryController extends Controller
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
    public function add_delivery(Request $request)
    {
        $this->AuthLogin();
        $city = City::orderby('matp','ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select_delivery(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="city"){
    			$select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option value="0">--Chọn quận huyện--</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}

    		}else{

    			$select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option value="0">--Chọn xã phường--</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    		echo $output;
    	}
    	
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_delivery(Request $request)
    {
        $this->AuthLogin();

        $rules = [
            'city'=>'required|not_in:0',
            'province'=>'required|not_in:0',
            'wards'=>'required|not_in:0',
            'fee_ship'=>'required|numeric'
        ];
        $messages = [
            'not_in'=>" :attribute bắt buộc phải chọn",
            'required'=>" :attribute bắt buộc phải nhập",
            'numeric'=>":attribute phải là số"
        ];
        $attributes = [
            'city'=>"Thành phố",
            'province'=>"Quận huyện",
            'wards'=>"Xã phường",
            'fee_ship'=>"Phí vận chuyển",
            
        ];

        $validator = Validator::make($request->all(),$rules,$messages,$attributes);
        if($validator->fails()) {
            $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
           
        }else{
            $data = $request->all();
            $fee_ship = new Feeship();
            $fee_ship->fee_matp = $data['city'];
            $fee_ship->fee_maqh = $data['province'];
            $fee_ship->fee_xaid = $data['wards'];
            $fee_ship->fee_feeship = $data['fee_ship'];
            $fee_ship->save();

            Session::put('message','Thêm phí vận chuyển thành công thành công');
            return redirect()->route('show-delivery');
        }
        return back()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_delivery()
    {
        $this->AuthLogin();

        $feeship = Feeship::orderby('fee_id','DESC')->paginate(8);
    	return view('admin.delivery.show_delivery')->with(compact('feeship'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_delivery($fee_id)
    {
        $feeship = Feeship::find($fee_id);
    	$feeship->delete();
    	Session::put('message','Xóa phí vận chuyển thành công');
        return redirect()->route('show-delivery');
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
