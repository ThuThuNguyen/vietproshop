<?php

namespace App\Http\Controllers\backend;
use App\Http\Requests\{AddCategoryRequest,EditCategory};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
class CategoryController extends Controller
{
    function GetCategory(){
        $data['category']=Category::all()->toArray();
         return view("backend.category.category",$data);
    }
    function PostCategory(AddCategoryRequest $r){
        // dd($r->all());
        if(GetLevel(Category::all()->toArray(),$r->parent,1)>3){
            return redirect()->back()->with('error','Giao diện web không hỗ trợ danh mục lớn hơn 2 cấpcấp !');
        }
        $cate=new Category;
        $cate->name=$r->name;
        $cate->slug = Str::slug($r->name, '-');
        $cate->parent=$r->parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã thêm danh mục thành công!');
    }
    function GetEditCategory($id_cate){
        $data['cate']=Category::find($id_cate);
        $data['category']=Category::all()->toArray();
        return view("backend.category.editcategory",$data);
    }
    function PostEditCategory($id_cate,EditCategory $r){
        if(GetLevel(Category::all()->toArray(),$r->parent,1)>3){
            return redirect()->back()->with('error','Giao diện web không hỗ trợ danh mục lớn hơn 2 cấp !');
        }
        $cate=Category::find($id_cate);
        $cate->name=$r->name;
        $cate->slug = Str::slug($r->name, '-');
        $cate->parent=$r->parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã sửa danh mục thành công');
    }
    function DeleteCategory($id_cate){
        $cate=Category::find($id_cate);
        Category::where('parent',$id_cate)->update(['parent'=>$cate->parent]);
        Category::destroy($id_cate);
        return redirect()->back()->with('thongbao','Đã xóa danh mục thành công');
    }
}
