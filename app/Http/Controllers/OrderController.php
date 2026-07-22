<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Product;
use App\Models\Order;
use Session;
use DB;
use file;

class OrderController extends Controller
{
    public function add_order(Request $request)
    {
        $distributorid = $request->session()->get('logindistributor');
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $data['product'] = DB::table('products')->where('distributor_id',  $distributorid)->orderBy('product_name')->get();
        return view('order.add-order', $data);
    }

    public function create(Request $request){

       $order = Order::create($request->all());

        $products = $request->input('products', []);
        $quantitiess = $request->input('quantitiess', []);
        $prices = $request->input('prices', []);
        $tp_prices = $request->input('tp_prices', []);
            for ($product=0; $product < count($products); $product++) {
                if ($products[$product] != ''){
                    $order->products()->attach($products[$product], ['quantity' => $quantitiess[$product]]);
                }
            }
    
        return redirect()->back()->with('status', 'Details added Successfully !!!');
    }

    
   public function view(Request $request)
   {
       $data['orders'] = Order::with('products')->ORDERBY('id', 'DESC')->get();
       $data['loginId'] = $request->session()->get('loginId');
       $data['loginEmail'] = $request->session()->get('loginEmail');
       $data['loginName'] = $request->session()->get('loginName');
       $data['loginRole'] = $request->session()->get('loginRole');
       $data['loginUser'] = $request->session()->get('loginUser');
       return view('order.view-order', $data);
   }
}
