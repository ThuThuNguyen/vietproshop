<?php

namespace App\Http\Controllers\backend;
use App\Http\Requests\{AddProductRequest,EditProductRequest};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{Product,Category};
class ProductController extends Controller
{
    function GetAddProduct(){
        $data['category']=category::all()->toarray();
        return view("backend.product.addproduct",$data);
    }
    function PostAddProduct(AddProductRequest $r)
    {
        $product=new Product();

        $product->code=$r->code;
        $product->name=$r->name;
        $product->price=$r->price;
        $product->slug = Str::slug($r->name, '-');
        $product->featured=$r->featured;
        $product->state=$r->state;
        $product->info=$r->info;
        $product->describe=$r->describe;
        if($r->hasFile('img'))
        {
         
            $file=$r->img;
            $file_name=Str::slug($r->name).'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$file_name);
            $product->img=$file_name;
        }
        else
        {
            $product->img='no-img.jpg';
        }

        $product->category_id=$r->category;
        $product->save();
        return redirect('admin/product')->with('thongbao','Đã thêm sản phẩm thành công!');

    }
    function GetEditProduct($id_product){
        $data['product']=Product::find($id_product);
        $data['category']=category::all()->toarray();
        return view("backend.product.editproduct",$data);
    }
    function PostEditProduct($id_product,EditProductRequest $r){
        $prd = Product::find($id_product);
        $prd->code = $r->code;
        $prd->name = $r->name;
        $prd->slug = Str::slug($r->name);
        $prd->price = $r->price;
        $prd->featured = $r->featured;
        $prd->state = $r->state;
        $prd->info = $r->info;
        $prd->describe = $r->describe;
        if ($r->hasFile('img')) {

            if($prd->img!='no-img.jpg')
            {
                if(file_exists('backend/img/'.$prd->img))
                {
                    //xóa file nếu tồn tại trong public
                    unlink('backend/img/'.$prd->img);
                }

            }
            //lấy đường dẫn file tương đối
            $file = $r->img;
            //lấy tên file để upload lên serve
            $filename = Str::slug($r->name). '.' . $file->getClientOriginalExtension();
            //UPload file lên serve
            //  $file->move('đường dẫn lưu file','tên file được lưu trên serve')
            $file->move('backend/img', $filename);
            //lưu tên file vào CSDL
            $prd->img = $filename;
        }

        $prd->category_id = $r->category;
        $prd->save();
        return redirect('admin/product')->with('thongbao','Đã sửa Thành Công');
    }
    function DelProduct($id_product){
        Product::destroy($id_product);
        return redirect('admin/product')->with('thongbao','Đã xóa sản phẩm thành công');
    }
    function GetListProduct(){
        $data['product']=Product::paginate(3);
        return view("backend.product.listproduct",$data);
    }
}
