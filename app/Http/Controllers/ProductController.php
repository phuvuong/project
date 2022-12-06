<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\CategoryProduct;
use App\Brand;


class ProductController extends Controller
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
    public function add_product()
    {
        $this->AuthLogin();
        $brand_product = Brand::orderBy('brand_id','DESC')->get();
        $cate_product = CategoryProduct::orderBy('category_id','DESC')->get();
        return view('admin.product.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $rules = [
            'product_name'=>'required|min:5|max:255|unique:tbl_product',
            'product_quantity'=>'required|min:0|numeric',
            'product_slug'=>'required|max:255',
            'product_price'=>'required|min:0|numeric',
            'product_image'=>'required|required|mimes:jpeg,jpg,png,gif|mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:10000',
            'product_desc'=>'required|max:255',
            'product_content'=>'required|max:255',
           


        ];
        $messages = [
            'required'=>" :attribute bắt buộc phải nhập",
            'max'=>" :attribute không được lớn hơn :max ký tự",
            'product_name.min'=>" :attribute phải nhiều hơn :min ký tự ",
            'min'=>" :attribute nhiều hơn :min ",
            'unique'=>":attribute đã tồn tại",
            'numeric'=>":attribute phải là số",
            'mimes'=>" :attribute không phù hợp",
        ];
        $attributes = [
            'product_name'=>"Tên sản phẩm",
            'product_quantity'=>"Số lượng sản phẩm",
            'product_slug'=>"Slug sản phẩm",
            'product_price'=>"Giá sản phẩm",
            'product_desc'=>"Mô tả sản phẩmsản phẩm",
            'product_image'=>"Hình ảnh sản phẩm",
            'product_content'=>"Nội dung sản phẩm "

        ];

        $validator = Validator::make($request->all(),$rules,$messages,$attributes);
    
        if($validator->fails()) {
            $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
           
        }
        else{
            $product = new Product();
            $product->product_name    = $request->product_name;
            $product->product_quantity    = $request->product_quantity;
            $product->product_slug    = $request->product_slug;
            $product->product_price    = $request->product_price;
            $product->product_desc    = $request->product_desc;
            $product->product_content    = $request->product_content;
            $product->category_id    = $request->product_cate;
            $product->brand_id    = $request->product_brand;
            $product->product_status    = $request->product_status;
            $get_image = $request->file('product_image');
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('uploads/backend/product',$new_image);
                $product->product_image = $new_image;
                $product->save();
                Session::put('message','Thêm sản phẩm thành công');
                return redirect()->route('add-product');
            }
            return redirect()->route('add-product');
        }
        return back()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_product()
    {
        $this->AuthLogin();

        $all_product = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderBy('tbl_product.product_id','desc')->paginate(5);
    	
    	$manager_product  = view('admin.product.show_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.product.show_product', $manager_product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = CategoryProduct::orderBy('category_id','desc')->get();
        $brand_product = Brand::orderBy('brand_id','desc')->get(); 
        $edit_product = Product::where('product_id',$product_id)->get();


        $manager_product  = view('admin.product.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.product.edit_product', $manager_product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $rules = [
            'product_name'=>'required|min:5|max:255',
            'product_quantity'=>'required|min:0|numeric',
            'product_slug'=>'required|max:255',
            'product_price'=>'required|min:0|numeric',
            'product_image'=>'required|required|mimes:jpeg,jpg,png,gif|mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:10000',
            'product_desc'=>'required|max:255',
            'product_content'=>'required|max:255',
           


        ];
        $messages = [
            'required'=>" :attribute bắt buộc phải nhập",
            'max'=>" :attribute không được lớn hơn :max ký tự",
            'product_name.min'=>" :attribute phải nhiều hơn :min ký tự ",
            'min'=>" :attribute nhiều hơn :min ",
            'unique'=>":attribute đã tồn tại",
            'numeric'=>":attribute phải là số",
            'mimes'=>" :attribute không phù hợp",
        ];
        $attributes = [
            'product_name'=>"Tên sản phẩm",
            'product_quantity'=>"Số lượng sản phẩm",
            'product_slug'=>"Slug sản phẩm",
            'product_price'=>"Giá sản phẩm",
            'product_desc'=>"Mô tả sản phẩmsản phẩm",
            'product_image'=>"Hình ảnh sản phẩm",
            'product_content'=>"Nội dung sản phẩm "

        ];

        $validator = Validator::make($request->all(),$rules,$messages,$attributes);
    
        if($validator->fails()) {
            $validator->errors()->add('msg','Vui lòng kiểm tra lại dữ liệu!');
           
        }
        else{
            $data = $request->all();
            $product = Product::find($product_id);
            $product->product_name = $data['product_name'];
            $product->product_quantity = $data['product_quantity'];
            $product->product_slug = $data['product_slug'];
            $product->product_price = $data['product_price'];
            $product->product_desc = $data['product_desc'];
            $product->product_content = $data['product_content'];
            $product->category_id = $data['product_cate'];
            $product->brand_id = $data['product_brand'];
            $product->product_status = $data['product_status'];
            $get_image = $request->file('product_image');
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('uploads/backend/product',$new_image);
                $product->product_image = $new_image;
                $product->save();
                Session::put('message','Cập nhật sản phẩm thành công');
                return redirect()->route('show-product');
            }
            Session::put('message','Cập nhật sản phẩm thành công');
            return redirect()->route('show-product');
        }
        return back()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_product($product_id)
    {
        $this->AuthLogin();
       
        $product = Product::findOrFail($product_id);
        $product->delete();
        return redirect('show-product')->with('message','Xóa danh mục thành công');
    }
    public function shop_detail($product_id){
        $cate_product = CategoryProduct::where('category_status','1')->orderBy('category_id','DESC')->get();

        $brand_product = Brand::where('brand_status','1')->orderBy('brand_id','DESC')->get();

        $product = Product::where('product_status','1')->orderBy('product_id','DESC')->limit(8)->get();

        $shop_detail = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_id',$product_id)->get(); 

        foreach($shop_detail as $key => $value) {
            $category_id = $value->category_id;
        }
        $related_product = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_category_product.category_id',$category_id)->
        whereNotIn('tbl_product.product_id',[$product_id])->get();

        return view('pages.product.shop_detail')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product',$product)->with('shop_detail',$shop_detail)->with('related_product',$related_product);
    }
}
