<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Adjustbalance;
use DB;

class AdjustbalanceController extends Controller
{
    public function index(Request $request)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $data['company'] = DB::table('companies')->where('user_id', $loginUser)->orderby('id')->get();
        return view('adjust.add-adjust', $data);
    }

    public function view_adjust(Request $request){
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $data['adjust'] = DB::table('adjustbalances')->where('user_id', $loginUser)->orderby('id')->get();
        return view('adjust.view-adjust', $data); 
    }

    public function create(Request $request)
    {
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $company = Company::where('id', $request->company_id)->where('user_id', $loginUser)->first();
        $company_amount = floatval($company->amount);
        $new_amount = floatval($request->input('amount'));
        if($request->operation == "add"){
            $total_balance = $company_amount + $new_amount;
            DB::table('companies')->where('id', $request->company_id)->where('user_id', $loginUser)->update(['amount' => $total_balance]);
        }
        else{
            if($company_amount > $new_amount){
                $total_balance = $company_amount - $new_amount;
                DB::table('companies')->update(['amount' => $total_balance]); 
            }
            else{
                return back()->with('status', 'Invalid Amount !!');
            }
        }

        $adjust = new Adjustbalance();
        $adjust->company_id = $request->input('company_id');
        $adjust->amount = $request->input('amount');
        $adjust->operation = $request->input('operation');
        $adjust->total_balance	= $total_balance;
        $adjust->user_id = $loginUser;
        $adjust->distributor_id = $distributorid;
        $adjust->date = date('d-m-Y');
        $adjust->remarks = $request->input('remarks');
        $adjust->save();
        return redirect(route('view-adjust'))->with('status', 'Adjustment Done Successfully');
    }

}
