<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Product;
use App\CategoryProduct;
use App\Brand;


use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
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
    public function add_category()
    {
        $this->AuthLogin();
      
        return view('admin.category.add_category');
    }
    public function show_category(){
        $this->AuthLogin();
        $all_category_product = CategoryProduct::orderBy('category_id','DESC')->paginate(8);
        $manager_category_product = view('admin.category.show_category')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.category.show_category',$manager_category_product);
    }
    public function save_category(Request $request){
        $this->AuthLogin();
        $rules = [
            'category_name'=>'required|max:255|unique:tbl_category_product',
            'meta_keywords'=>'required|max:255',
            'slug_category_product'=>'required|max:255',
            'category_desc'=>'required|max:255',
            'category_status'=>'required|max:255'
        ];
        $messages = [
            'required'=>" :attribute bắt buộc phải nhập",
            'max'=>" :attribute không được lớn hơn :max ký tự",
            'unique'=>":attribute đã tồn tại"
        ];
        $attributes = [
            'category_name'=>"Tên danh mục",
            'meta_keywords'=>"Từ khóa danh mục",
            'slug_category_product'=>"Slug danh mục",
            'category_desc'=>"Mô tả danh mục",
            'category_status'=>"Trạng thái danh mục"
        ];

        $validator = Validator::make($request->all(),$rules,$messages,$attributes);
        //   $validator -> validate();
        if($validator->fails()) {
            $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
           
        }
        else{
            
            $category = new CategoryProduct();

    
            $category->category_name    = $request->category_name;
            $category->meta_keywords   = $request->meta_keywords;
            $category->slug_category_product   = $request->slug_category_product;
            $category->category_desc = $request->category_desc;
            $category->category_status = $request->category_status;
    
            $category->save();
            Session::put('message','Thêm danh mục thành công');
            return redirect()->route('add-category');
        }
        return back()->withErrors($validator);
       
       
    }
    public function edit_category($category_id){
        $this->AuthLogin();
        $edit_category_product = CategoryProduct::where('category_id',$category_id)->get();
        $manager_category_product  = view('admin.category.edit_category')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.category.edit_category', $manager_category_product);
    }
    public function update_category(Request $request,$category_id){
        $this->AuthLogin();
        $rules = [
            'category_name'=>'required|max:255|',
            'meta_keywords'=>'required|max:255',
            'slug_category_product'=>'required|max:255',
            'category_desc'=>'required|max:255',
            'category_status'=>'required|max:255'
        ];
        $messages = [
            'required'=>" :attribute bắt buộc phải nhập",
            'max'=>" :attribute không được lớn hơn :max ký tự",
            'unique'=>":attribute đã tồn tại"
        ];
        $attributes = [
            'category_name'=>"Tên danh mục",
            'meta_keywords'=>"Từ khóa danh mục",
            'slug_category_product'=>"Slug danh mục",
            'category_desc'=>"Mô tả danh mục",
            'category_status'=>"Trạng thái danh mục"
        ];

        $validator = Validator::make($request->all(),$rules,$messages,$attributes);
        //   $validator -> validate();
        if($validator->fails()) {
            $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
           
        }
        else{
            $data = $request->all();
            $category = CategoryProduct::find($category_id);

            $category->category_name = $data['category_name'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->slug_category_product = $data['slug_category_product'];
            $category->category_desc = $data['category_desc'];
            $category->category_status = $data['category_status'];
        
          
    
            $category->save();
            Session::put('message','Cập nhật danh mục sản phẩm thành công');
            return Redirect::to('show-category');
        }
        return back()->withErrors($validator);
    }
    public function delete_category($category_id){
        $this->AuthLogin();
        $category = CategoryProduct::findOrFail($category_id);
        $category->delete();
        return redirect('show-category')->with('message','Xóa danh mục thành công');
    }
    public function show_category_home($category_id)
    {
        $cate_product = CategoryProduct::where('category_status','1')->orderBy('category_id','DESC')->get();
        $product = Product::where('product_status','1')->orderBy('product_id','DESC')->get();
        $brand_product = Brand::where('brand_status','1')->orderBy('brand_id','DESC')->get();
        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_category_product.category_id',$category_id)->get();

        return view('pages.category.show_category_home')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product',$product)->with('category_by_id',$category_by_id);  
    }
}
