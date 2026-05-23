<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Topup;
use App\Models\Product;
use Session;
use DB;
use file;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $distributorid = $request->session()->get('logindistributor');
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $data['product'] = DB::table('products')->where('distributor_id',  $distributorid)->orderBy('product_name')->get();
        return view('product.view-product', $data);
    }

    public function add_product(Request $request){
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('product.add-product', $data);
    }

    public function create(Request $request)
    {
         $validator = $request->validate([
        'product_name' => 'required|min:3|max:250|unique:products',
    ]);
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $product = new product();
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->distributor_id = $distributorid;
        $product->category = $request->category;
        $product->brand = $request->brand;
           if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();  
            $filename = time().'.'.$extension;
            $file->move('uploads/image/',$filename);
            $product->image = $filename;
        }
        $product->available_quantity = $request->available_quantity;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->created_by = $loginUser;
        $product->save();
        return redirect(route('add-product'))->with('status', 'Product Details Added Successfully!!!');
    }

    public function edit(Request $request, $id)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $data['product'] = DB::table('products')->where('id', $id)->first();
        return view('product.update-product', $data);
    }

    public function update(Request $request, $id)
    {
       $product = product::find($id);
       $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->category = $request->category;
        $product->brand = $request->brand;
           if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();  
            $filename = time().'.'.$extension;
            $file->move('uploads/image/',$filename);
            $product->image = $filename;
        }
        $product->available_quantity = $request->available_quantity;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->save();
       return redirect(route('view-product'))->with('status', 'Product Details Updated Successfully!!!');
       
    }

    public function destroy($id)
    {
        $product = product::find($id);
        $imagePath = public_path('uploads/image/' . $product->image);

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
        $product->delete();
        return back()->with('status', 'Product Delete Successfully');
    }
}
