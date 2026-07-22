<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Topup;
use App\Models\Debitpayment;
use App\Models\Creditcharge;
use Session;
use DB;

class CreditchargeController extends Controller
{
    public function index(Request $request)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $data['company'] = DB::table('companies')->where('distributor_id', $loginUser)->get();
        $data['retailer'] = DB::table('users')->where('distributor_id', $loginUser)->where('role','5')->orderby('id')->get();
        return view('charges.add-charges', $data);
    }

    public function create(Request $request)
    {
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $charge = new Creditcharge();
        $charge->retailer_id = $request->input('retailer_id');
        $charge->company_id = $request->input('company_id');
        $charge->ch_amount = $request->input('ch_amount');
        $charge->operation = $request->input('operation');
        $charge->remarks = $request->input('remarks');
        $charge->distributor_id = $loginUser;
        $charge->sup_dist_id = $distributorid;
        $charge->date = date('d-m-Y');
        $cb_balance = DB::table('companybalances')->where('company_id', $request->company_id)->where('retailer_id', $request->input('retailer_id'))->select('amount')->first();
        $charge_amount = floatval($request->input('ch_amount'));
        $company_amount = floatval($cb_balance->amount);
        if($request->operation == "add"){
            $total_balance = $company_amount + $charge_amount;
            DB::table('companybalances')->where('id', $request->company_id)->where('retailer_id', $request->input('retailer_id'))->update(['amount' => $total_balance]);
            DB::table('topups')->where('company_id', $request->company_id)->where('user_id', $request->input('retailer_id'))->orderby('id', 'DESC')->limit(1)->update(['total_charge' => $charge_amount, 
            'total_balance' => $total_balance]);
        }
        else{
            if($company_amount > $charge_amount){
                $total_balance = $company_amount - $charge_amount;
                DB::table('companybalances')->where('company_id', $request->company_id)->where('retailer_id', $request->input('retailer_id'))->update(['amount' => $total_balance]);
                DB::table('topups')->where('company_id', $request->company_id)->where('user_id', $request->input('retailer_id'))->orderby('id', 'DESC')->limit(1) ->update(['total_charge' => $charge_amount, 
                'total_balance' => $total_balance]);
            }
            else{
                return back()->with('status', 'Invalid Amount !!');
            }
        }
        $charge->total_balance = $total_balance;
        $charge->save();
        return redirect(route('view-charges'))->with('status', 'Charges Credit Successfully');
    }

    public function view(Request $request){
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $loginRole = $request->session()->get('loginRole');
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        if($loginRole == '2'){
            $data['charge'] = DB::table('creditcharges')
            ->where('distributor_id', $loginUser)
            ->get();
        }
        else if($loginRole == '3'){
            $data['charge'] = DB::table('creditcharges')
            ->where('distributor_id', $distributorid)
            ->get();
        }
        else if($loginRole == '5'){
            $data['charge'] = DB::table('creditcharges')->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->get();
        }
        return view('charges.view-charges', $data); 
    }

}
