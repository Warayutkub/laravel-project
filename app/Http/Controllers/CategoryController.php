<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
   public function index()
    {
        $categorys = Category::all();
        return view('category/index', compact('categorys'));
    }
     public function search(Request $request) {
        $query = $request->q;
        if($query) {
        $categorys = Category::where('name', 'like', '%'.$query.'%')
        ->get();
        } else {
        $categorys = Category::all();
        }
        return view('category/index', compact('categorys'));
    }

      public function remove($id) {
        Category::find($id)->delete();
        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสําเร็จ');
    }
     public function edit($id=null)
    {
        $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ', '');
        if ($id) {
            return view('category/edit')
            ->with('categories', $categories);
        }else {
            return view('category/add')
            ->with('categories',$categories);
        }
            
        }
    public function insert(Request $request){
        $category = new category();
        $category->name = $request->name;
        $category->save();

     return redirect('category')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแลว้');
    }
    
}
