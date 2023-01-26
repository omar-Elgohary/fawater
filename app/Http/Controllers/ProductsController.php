<?php
namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Sections;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::get();
        $sections = Sections::get();
        return view('products.products' , compact('products' , 'sections'));
    }



    public function store(Request $request)
    {
        // $products = $request->validate([
        //     'Product_name' => 'required|unique:products|max:50',
        //     'description' => 'required',
        // ],[
        //     'Product_name.required' =>'يرجي ادخال اسم المنتج',
        //     'Product_name.unique' =>'اسم المنتج مسجل مسبقا',
        //     'description.required' =>'يرجى ادخال وصف المنتج',
        // ]);

        Products::create([
            'Product_name' => $request->Product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('/products');
    }



    public function update(Request $request)
    {
        // $pro_id = $request->pro_id;
        // $products = $request->validate([
        //     'Product_name' => 'required|unique:products|max:50'.$pro_id,
        //     'description' => 'required',
        // ],[
        //     'Product_name.required' =>'يرجي ادخال اسم المنتج',
        //     'Product_name.unique' =>'اسم المنتج مسجل مسبقا',
        //     'description.required' =>'يرجى ادخال وصف المنتج',
        // ]);

        $id = Sections::where('section_name' , $request->section_name)->first()->id;
        $products = Products::find($request->pro_id);
        $products->update([
            'Product_name' => $request->Product_name,
            'description' => $request->description,
            'section_id' => $id,
        ]);
        session()->flash('Edit', 'تم تعديل المنتج بنجاح ');
        return redirect('/products');
    }



    public function destroy(Request $request)
    {
        $products = Products::find($request->pro_id)->delete();
        session()->flash('delete', 'تم تعديل المنتج بنجاح ');
        return redirect('/products');
    }
}
