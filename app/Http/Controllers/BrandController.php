<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Brand;


use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function  AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand()
    {
        $this->AuthLogin();
      
        return view('admin.brand.add_brand');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_brand()
    {
        $this->AuthLogin();
        $all_brand_product = Brand::orderBy('brand_id','DESC')->paginate(5);
    	$manager_brand_product  = view('admin.brand.show_brand')->with('all_brand_product',$all_brand_product);
    	return view('admin_layout')->with('admin.brand.show_brand', $manager_brand_product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_brand(Request $request)
    {
        $this->AuthLogin();
        $rules = [
            'brand_name'=>'required|min:3|max:255|unique:tbl_brand',
            'brand_slug'=>'required|max:255',
            'brand_image'=>'required|mimes:jpeg,jpg,png,gif|mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:10000',
            'brand_desc'=>'required|max:255',
            'brand_status'=>'required|max:255'
        ];
        $messages = [
            'required'=>" :attribute bắt buộc phải nhập",
            'max'=>" :attribute không được nhiều hơn :max ký tự",
            'min'=>" :attribute nhiều hơn :min ký tự",
            'mimes'=>" :attribute không phù hợp",
            'unique'=>":attribute đã tồn tại"
        ];
        $attributes = [
            'brand_name'=>"Tên thương hiệu",
            'brand_slug'=>"Slug thương hiệu",
            'brand_image'=>"Hình ảnh thương hiệu",
            'brand_desc'=>"Mô tả danh mục",
            'brand_status'=>"Trạng thái thương hiệu"
        ];
        $validator = Validator::make($request->all(),$rules,$messages,$attributes);
        if($validator->fails()) {
            $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
           
        }
        else{
                $brand = new Brand();
                $brand->brand_name    = $request->brand_name;
                $brand->brand_slug    = $request->brand_slug;
                $brand->brand_desc    = $request->brand_desc;
                $brand->brand_status    = $request->brand_status;
                $get_image = $request->file('brand_image');
                if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('uploads/backend/brand',$new_image);
                    $brand->brand_image = $new_image;
                    $brand->save();
                    Session::put('message','Thêm thương hiệu thành công');
                    return redirect()->route('add-brand');
                }
              Session::put('message','Thêm thương hiệu thành công');

                return redirect()->route('add-brand');

                    
        }
        return back()->withErrors($validator);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_brand($brand_id)
    
    {
        $this->AuthLogin();
        $edit_brand_product = Brand::where('brand_id',$brand_id)->get();
        $manager_brand_product  = view('admin.brand.edit_brand')->with('edit_brand_product',$edit_brand_product);

        return view('admin_layout')->with('admin.brand.edit_brand', $manager_brand_product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_brand(Request $request, $brand_id)
    {
        $this->AuthLogin();
        $rules = [
            'brand_name'=>'required|min:3|max:255',
            'brand_slug'=>'required|max:255',
            'brand_image'=>'required|mimes:jpeg,jpg,png,gif|mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:10000',
            'brand_desc'=>'required|max:255',
            'brand_status'=>'required|max:255'
        ];
        $messages = [
            'required'=>" :attribute bắt buộc phải nhập",
            'max'=>" :attribute không được nhiều hơn :max ký tự",
            'min'=>" :attribute nhiều hơn :min ký tự",
            'mimes'=>" :attribute không phù hợp",
            'unique'=>":attribute đã tồn tại"
        ];
        $attributes = [
            'brand_name'=>"Tên thương hiệu",
            'brand_slug'=>"Slug thương hiệu",
            'brand_image'=>"Hình ảnh thương hiệu",
            'brand_desc'=>"Mô tả danh mục",
            'brand_status'=>"Trạng thái thương hiệu"
        ];
        $validator = Validator::make($request->all(),$rules,$messages,$attributes);
        if($validator->fails()) {
            $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
           
        }
        else{
            $data = $request->all();
            $brand = Brand::find($brand_id);
            $brand->brand_name = $data['brand_name'];
            $brand->brand_slug = $data['brand_slug'];
            $brand->brand_desc = $data['brand_desc'];
            $brand->brand_status = $data['brand_status'];
            $get_image = $request->file('brand_image');
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('uploads/backend/brand',$new_image);
                $brand->brand_image = $new_image;
                $brand->save();
                Session::put('message','Cập nhật thương hiệu thành công');
                return Redirect::to('show-brand');
            }
            $brand->save();
            Session::put('message','Cập nhật thương hiệu thành công');
            return Redirect::to('show-brand');

        }
        return back()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_brand($brand_id)
    {
        $this->AuthLogin();
        $brand = Brand::findOrFail($brand_id);
        $brand->delete();
        return redirect('show-brand')->with('message','Xóa danh mục thành công');
    }
}
