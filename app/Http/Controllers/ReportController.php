<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Topup;
use App\Models\Debitpayment;
use Session;
use DB;

class ReportController extends Controller
{

    public function filter(Request $request){
        $request->session()->put('acc_fr_sess', $request->acc_fr_date);
        $request->session()->put('acc_to_sess', $request->acc_to_date);
        $request->session()->put('acc_ret_sess', $request->acc_retail);
        $request->session()->put('com_fr_sess', $request->com_fr_date);
        $request->session()->put('com_to_sess', $request->com_to_date);
        $request->session()->put('company_sess', $request->company_name);
        $request->session()->put('com_ret_sess', $request->com_retail);
        $request->session()->put('inc_fr_sess', $request->inc_fr_date);
        $request->session()->put('inc_to_sess', $request->inc_to_date);
        $request->session()->put('inc_com_sess', $request->inc_com_name);
        $request->session()->put('inc_ret_sess', $request->inc_retail);
        $request->session()->put('tp_fr_sess', $request->tp_fr_date);
        $request->session()->put('tp_to_sess', $request->tp_to_date);
        $request->session()->put('tp_com_sess', $request->tp_com_name);
        $request->session()->put('tp_ret_sess', $request->tp_retail);
        $request->session()->put('tt_fr_sess', $request->tt_fr_date);
        $request->session()->put('tt_to_sess', $request->tt_to_date);
        $request->session()->put('tt_ret_sess', $request->tt_ret_name);
        $request->session()->put('tt_com_sess', $request->tt_com_name);
        $request->session()->put('ttfs_fr_sess', $request->ttfs_fr_date);
        $request->session()->put('ttfs_to_sess', $request->ttfs_to_date);
        $request->session()->put('ttfs_fos_sess', $request->ttfs_fos_name);
        return back();
  }

  public function refresh()
  {  
      Session::pull('acc_fr_sess');
      Session::pull('acc_to_sess');
      Session::pull('acc_ret_sess');
      Session::pull('com_fr_sess');
      Session::pull('com_to_sess');
      Session::pull('company_sess');
      Session::pull('com_ret_sess');
      Session::pull('inc_fr_sess');
      Session::pull('inc_to_sess');
      Session::pull('inc_com_sess');
      Session::pull('inc_ret_sess');
      Session::pull('tp_fr_sess');
      Session::pull('tp_to_sess');
      Session::pull('tp_com_sess');
      Session::pull('tp_ret_sess');
      Session::pull('tt_fr_sess');
      Session::pull('tt_to_sess');
      Session::pull('tt_ret_sess');
      Session::pull('tt_com_sess');
      Session::pull('ttfs_fr_sess');
      Session::pull('ttfs_to_sess');
      Session::pull('ttfs_fos_sess');
      return back();
  }


    public function account_stmt(Request $request){
        $acc_fr_sess = $request->session()->get('acc_fr_sess');
        $acc_to_sess = $request->session()->get('acc_to_sess');
        $acc_ret_sess = $request->session()->get('acc_ret_sess');
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $fosid = $request->session()->get('loginfos');
        $loginRole = $request->session()->get('loginRole');
        if($loginRole == '0'){
        $data['retailer'] = DB::table('users')->where('role', '5')->orderby('id')->get();
        }else{
         $data['retailer'] = DB::table('users')->where('distributor_id', $distributorid)->where('role', '5')->orderby('id')->get();
        }
        if (isset($acc_fr_sess) || isset($acc_to_sess) ||  isset($acc_ret_sess) ) {
        if($loginRole == '0'){
            $data['retailer'] = DB::table('users')->where('role', '5')->orderby('id')->get();
            $res = DB::table('topups')->where('status', '1');
            if (!empty($acc_fr_sess)) {
                if (!empty($acc_to_sess)) {
                $res->whereBetween('date', [$acc_fr_sess,  $acc_to_sess]);
                }
            }

            if (!empty($acc_ret_sess)) {
                $res->where('user_id', $acc_ret_sess);
            }
            $data['topup'] = $res->get();

        }
        else  if($loginRole == '2'){
            $res = DB::table('topups')->where('distributor_id', $loginUser)->where('status', '1');
            if (!empty($acc_fr_sess)) {
                if (!empty($acc_to_sess)) {
                $res->whereBetween('date', [$acc_fr_sess,  $acc_to_sess]);
                }
            }

            if (!empty($acc_ret_sess)) {
                $res->where('user_id', $acc_ret_sess);
            }
            $data['topup'] = $res->get();

        }
        else if($loginRole == '3'){
            $res = DB::table('topups')->where('distributor_id', $distributorid)->where('status', '1');
            if (!empty($acc_fr_sess)) {
                if (!empty($acc_to_sess)) {
                $res->whereBetween('date', [$acc_fr_sess,  $acc_to_sess]);
                }
            }

            if (!empty($acc_ret_sess)) {
                $res->where('user_id', $acc_ret_sess);
            }
            $data['topup'] = $res->get();
        }
        else if($loginRole == '4'){
            $res = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('status', '1');
            if (!empty($acc_fr_sess)) {
                if (!empty($acc_to_sess)) {
                $res->whereBetween('date', [$acc_fr_sess,  $acc_to_sess]);
                }
            }

            if (!empty($acc_ret_sess)) {
                $res->where('user_id', $acc_ret_sess);
            }
            $data['topup'] = $res->get();
        }
        else if($loginRole == '5'){
            $res = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->where('status', '1');
            if (!empty($acc_fr_sess)) {
                if (!empty($acc_to_sess)) {
                $res->whereBetween('date', [$acc_fr_sess,  $acc_to_sess]);
                }
            }
            $data['topup'] = $res->get();
        }
    }
    else
    {
        if($loginRole == '0'){
            $data['topup'] = DB::table('topups')->where('status', '1')->orderby('created_at', 'DESC')->get();
        }
        else if($loginRole == '2'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $loginUser)->where('status', '1')->get();
        }
        else if($loginRole == '3'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('status', '1')->get();
        }
        else if($loginRole == '4'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('status', '1')->get();
        }
        else if($loginRole == '5'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->where('status', '1')->get();
        }

    }
        return view('report.account-statement', $data); 
    }
    
    
  public function total_topup(Request $request){
        $tt_fr_sess = $request->session()->get('tt_fr_sess');
        $tt_to_sess = $request->session()->get('tt_to_sess');
        $tt_ret_sess = $request->session()->get('tt_ret_sess');
        $tt_com_sess = $request->session()->get('tt_com_sess');
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $fosid = $request->session()->get('loginfos');
        $loginRole = $request->session()->get('loginRole');
        if($loginRole == '0'){
        $data['retailer'] = DB::table('users')->where('role', '5')->get();
        }else{
         $data['retailer'] = DB::table('users')->where('distributor_id', $distributorid)->where('role', '5')->get();
        }
        if (isset($tt_fr_sess) || isset($tt_to_sess) ||  isset($tt_ret_sess) ||  isset($tt_com_sess)) {
        if($loginRole == '0'){
            $data['retailer'] = DB::table('users')->where('role', '5')->get();
            $res = DB::table('topups')->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(total_amount) as paid_amount'))->where('status', '1')->groupby('user_id');
            if (!empty($tt_fr_sess)) {
                if (!empty($tt_to_sess)) {
                $res->whereBetween('date', [$tt_fr_sess,  $tt_to_sess]);
                }
            }
             if (!empty($tt_com_sess)) {
                    $res->where('company_id', $tt_com_sess);
                }

            if (!empty($tt_ret_sess)) {
                $res->where('user_id', $tt_ret_sess);
            }
            $data['topup'] = $res->get();

        }
        else  if($loginRole == '2'){
            $res = DB::table('topups')->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(total_amount) as paid_amount'))->where('distributor_id', $loginUser)->where('status', '1')->groupby('user_id');
            if (!empty($tt_fr_sess)) {
                if (!empty($tt_to_sess)) {
                $res->whereBetween('date', [$tt_fr_sess,  $tt_to_sess]);
                }
            }
            if (!empty($tt_com_sess)) {
                    $res->where('company_id', $tt_com_sess);
                }

            if (!empty($tt_ret_sess)) {
                $res->where('user_id', $tt_ret_sess);
            }
            $data['topup'] = $res->get();

        }
        else if($loginRole == '3'){
            $res = DB::table('topups')->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(total_amount) as paid_amount'))->where('distributor_id', $distributorid)->where('status', '1')->groupby('user_id');
            if (!empty($tt_fr_sess)) {
                if (!empty($tt_to_sess)) {
                $res->whereBetween('date', [$tt_fr_sess,  $tt_to_sess]);
                }
            }
            if (!empty($tt_com_sess)) {
                    $res->where('company_id', $tt_com_sess);
                }

            if (!empty($tt_ret_sess)) {
                $res->where('user_id', $tt_ret_sess);
            }
            $data['topup'] = $res->get();
        }
        else if($loginRole == '4'){
            $res = DB::table('topups')->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(total_amount) as paid_amount'))->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('status', '1')->groupby('user_id');
            if (!empty($tt_fr_sess)) {
                if (!empty($tt_to_sess)) {
                $res->whereBetween('date', [$tt_fr_sess,  $tt_to_sess]);
                }
            }
            if (!empty($tt_com_sess)) {
                    $res->where('company_id', $tt_com_sess);
                }

            if (!empty($tt_ret_sess)) {
                $res->where('user_id', $tt_ret_sess);
            }
            $data['topup'] = $res->get();
        }
        else if($loginRole == '5'){
            $res = DB::table('topups')->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(total_amount) as paid_amount'))->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->where('status', '1')->groupby('user_id');
            if (!empty($tt_fr_sess)) {
                if (!empty($tt_to_sess)) {
                $res->whereBetween('date', [$tt_fr_sess,  $tt_to_sess]);
                }
            }
            if (!empty($tt_com_sess)) {
                    $res->where('company_id', $tt_com_sess);
                }
            $data['topup'] = $res->get();
        }
    }
    else
    {
        if($loginRole == '0'){
            $data['topup'] = DB::table('topups')->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(total_amount) as paid_amount'))->where('status', '1')->groupby('user_id')->get();
        }
        else if($loginRole == '2'){
            $data['topup'] = DB::table('topups')->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(total_amount) as paid_amount'))->where('distributor_id', $loginUser)->where('status', '1')->groupby('user_id')->get();
        }
        else if($loginRole == '3'){
            $data['topup'] = DB::table('topups')->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(total_amount) as paid_amount'))->where('distributor_id', $distributorid)->where('status', '1')->groupby('user_id')->get();
        }
        else if($loginRole == '4'){
            $data['topup'] = DB::table('topups')->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(total_amount) as paid_amount'))->where('distributor_id', $distributorid)->where('fos_id', $fosid)->groupby('user_id')->where('status', '1')->get();
        }
        else if($loginRole == '5'){
            $data['topup'] = DB::table('topups')->select('user_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(total_amount) as paid_amount'))->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->groupby('user_id')->where('status', '1')->get();
        }

    }
        return view('report.total-retailer-topup', $data); 
    }
    


  public function total_fos_collect(Request $request){
        $ttfs_fr_sess = $request->session()->get('ttfs_fr_sess');
        $ttfs_to_sess = $request->session()->get('ttfs_to_sess');
        $ttfs_fos_sess = $request->session()->get('ttfs_fos_sess');
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $loginRole = $request->session()->get('loginRole');
         if($loginRole == '0'){
        $data['fos'] = DB::table('users')->where('role', '4')->get();
        $data['company'] = DB::table('companies')->get();
        }else{
         $data['fos'] = DB::table('users')->where('distributor_id', $distributorid)->where('role', '4')->get();
         $data['company'] = DB::table('companies')->where('distributor_id', $distributorid)->get();
        }
        $fosid = $request->session()->get('loginfos');

        if (isset($ttfs_fr_sess) || isset($ttfs_to_sess) || isset($ttfs_fos_sess) ) {
              if($loginRole == '0'){
                $res = DB::table('debitpayments')->where('payment_collect', '1')->where('payment_mode', 'cash');
                $res_total = DB::table('debitpayments')->where('payment_collect', '1')->where('payment_mode', 'cash');
                if (!empty($ttfs_fr_sess)) {
                    if (!empty($ttfs_to_sess)) {
                    $res->whereBetween('payment_date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                    $res_total->whereBetween('payment_date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                    }
                }
                if (!empty($ttfs_fos_sess)) {
                    $res->where('fos_id', $ttfs_fos_sess);
                    $res_total->where('fos_id', $ttfs_fos_sess);
                }
                $data['debit'] = $res->get();
                $data['debit_total'] = $res_total->sum('total_amount');
            }
            if($loginRole == '2'){
                $res = DB::table('debitpayments')->where('distributor_id', $loginUser)->where('payment_collect', '1')->where('payment_mode', 'cash');
                 $res_total = DB::table('debitpayments')->where('distributor_id', $loginUser)->where('payment_collect', '1')->where('payment_mode', 'cash');
                if (!empty($ttfs_fr_sess)) {
                    if (!empty($ttfs_to_sess)) {
                    $res->whereBetween('payment_date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                    $res_total->whereBetween('payment_date', [$ttfs_fr_sess,  $ttfs_to_sess]);

                    }
                }
                if (!empty($ttfs_fos_sess)) {
                    $res->where('fos_id', $ttfs_fos_sess);
                    $res_total->where('fos_id', $ttfs_fos_sess);
                }
                $data['debit'] = $res->get();
                $data['debit_total'] = $res_total->sum('total_amount');
    
            }
            else if($loginRole == '3'){
                $res = DB::table('debitpayments')->where('distributor_id', $distributorid)->where('payment_collect', '1')->where('payment_mode', 'cash');
                $res_total = DB::table('debitpayments')->where('distributor_id', $distributorid)->where('payment_collect', '1')->where('payment_mode', 'cash');
                if (!empty($ttfs_fr_sess)) {
                    if (!empty($ttfs_to_sess)) {
                    $res->whereBetween('payment_date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                    $res_total->whereBetween('payment_date', [$ttfs_fr_sess,  $ttfs_to_sess]);

                    }
                }
                if (!empty($ttfs_fos_sess)) {
                    $res->where('fos_id', $ttfs_fos_sess);
                    $res_total->where('fos_id', $ttfs_fos_sess);
                }
                $data['debit'] = $res->get();
                $data['debit_total'] = $res_total->sum('total_amount');
            }
            else if($loginRole == '4'){
                $res = DB::table('debitpayments')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('payment_collect', '1')->where('payment_mode', 'cash');
                $res_total = DB::table('debitpayments')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('payment_collect', '1')->where('payment_mode', 'cash');
                if (!empty($ttfs_fr_sess)) {
                    if (!empty($ttfs_to_sess)) {
                    $res->whereBetween('payment_date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                    $res_total->whereBetween('payment_date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                    }
                }
                if (!empty($ttfs_fos_sess)) {
                    $res->where('fos_id', $ttfs_fos_sess);
                    $res_total->where('fos_id', $ttfs_fos_sess);
                }
                $data['debit'] = $res->get();
                $data['debit_total'] = $res_total->sum('total_amount');
            }
            else if($loginRole == '5'){
                $res =  DB::table('debitpayments')->where('distributor_id', $distributorid)->where('retailer_id', $loginUser)->where('payment_collect', '1')->where('payment_mode', 'cash');
                  $res_total = DB::table('debitpayments')->where('distributor_id', $distributorid)->where('retailer_id', $loginUser)->where('payment_collect', '1')->where('payment_mode', 'cash');
                if (!empty($ttfs_fr_sess)) {
                    if (!empty($ttfs_to_sess)) {
                    $res->whereBetween('payment_date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                    $res_total->whereBetween('payment_date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                    }
                }
                $data['debit'] = $res->get();
                $data['debit_total'] = $res_total->sum('total_amount');
            }
        }
        else
        {

             if($loginRole == '0'){
                $data['debit'] = DB::table('debitpayments')->where('payment_collect', '1')->where('payment_mode', 'cash')->orderby('created_at', 'DESC')->get();
                $data['debit_total'] = DB::table('debitpayments')->where('payment_collect', '1')->where('payment_mode', 'cash')->orderby('created_at', 'DESC')->sum('total_amount');
            }
            else if($loginRole == '2'){
                $data['debit'] = DB::table('debitpayments')->where('distributor_id', $loginUser)->where('payment_collect', '1')->where('payment_mode', 'cash')->orderby('created_at', 'DESC')->get();
                $data['debit_total'] = DB::table('debitpayments')->where('distributor_id', $loginUser)->where('payment_collect', '1')->where('payment_mode', 'cash')->orderby('created_at', 'DESC')->sum('total_amount');
            }
            else if($loginRole == '3'){
                $data['debit'] = DB::table('debitpayments')->where('distributor_id', $distributorid)->where('payment_collect', '1')->where('payment_mode', 'cash')->orderby('created_at', 'DESC')->get();
                $data['debit_total'] = DB::table('debitpayments')->where('distributor_id', $distributorid)->where('payment_collect', '1')->where('payment_mode', 'cash')->orderby('created_at', 'DESC')->sum('total_amount');
            }
            else if($loginRole == '4'){
                $data['debit'] = DB::table('debitpayments')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('payment_collect', '1')->where('payment_mode', 'cash')->orderby('created_at', 'DESC')->get();
                  $data['debit_total'] = DB::table('debitpayments')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('payment_collect', '1')->where('payment_mode', 'cash')->orderby('created_at', 'DESC')->sum('total_amount');
            }
            else if($loginRole == '5'){
                $data['debit'] = DB::table('debitpayments')->where('distributor_id', $distributorid)->where('retailer_id', $loginUser)->where('payment_collect', '1')->where('payment_mode', 'cash')->orderby('created_at', 'DESC')->get();
                   $data['debit_total'] = DB::table('debitpayments')->where('distributor_id', $distributorid)->where('retailer_id', $loginUser)->where('payment_collect', '1')->where('payment_mode', 'cash')->orderby('created_at', 'DESC')->sum('total_amount');
            }

    }

        return view('report.total-fos-collect', $data); 
    }
    public function topup_report(Request $request){
        $tp_fr_sess = $request->session()->get('tp_fr_sess');
        $tp_to_sess = $request->session()->get('tp_to_sess');
        $tp_com_sess = $request->session()->get('tp_com_sess');
        $tp_ret_sess = $request->session()->get('tp_ret_sess');
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $loginRole = $request->session()->get('loginRole');
         if($loginRole == '0'){
        $data['retailer'] = DB::table('users')->where('role', '5')->get();
        $data['company'] = DB::table('companies')->get();
        }else{
         $data['retailer'] = DB::table('users')->where('distributor_id', $distributorid)->where('role', '5')->get();
         $data['company'] = DB::table('companies')->where('distributor_id', $distributorid)->get();
        }
        $fosid = $request->session()->get('loginfos');

        if (isset($tp_fr_sess) || isset($tp_to_sess) ||  isset($tp_com_sess) || isset($tp_ret_sess) ) {
              if($loginRole == '0'){
                $res = DB::table('topups')->where('payment_collect', '1')->where('topup_type', '2');
                if (!empty($tp_fr_sess)) {
                    if (!empty($tp_to_sess)) {
                    $res->whereBetween('payment_date', [$tp_fr_sess,  $tp_to_sess]);
                    }
                }
                if (!empty($tp_com_sess)) {
                    $res->where('company_id', $tp_com_sess);
                }

                if (!empty($tp_ret_sess)) {
                    $res->where('retailer_id', $tp_ret_sess);
                }
                $data['debit'] = $res->get();
    
            }
            if($loginRole == '2'){
                $res = DB::table('topups')->where('distributor_id', $loginUser)->where('payment_collect', '1')->where('topup_type', '2');
                if (!empty($tp_fr_sess)) {
                    if (!empty($tp_to_sess)) {
                    $res->whereBetween('payment_date', [$tp_fr_sess,  $tp_to_sess]);
                    }
                }
                if (!empty($tp_com_sess)) {
                    $res->where('company_id', $tp_com_sess);
                }

                if (!empty($tp_ret_sess)) {
                    $res->where('retailer_id', $tp_ret_sess);
                }
                $data['debit'] = $res->get();
    
            }
            else if($loginRole == '3'){
                $res = DB::table('topups')->where('distributor_id', $distributorid)->where('payment_collect', '1')->where('topup_type', '2');
                if (!empty($tp_fr_sess)) {
                    if (!empty($tp_to_sess)) {
                    $res->whereBetween('payment_date', [$tp_fr_sess,  $tp_to_sess]);
                    }
                }
                if (!empty($tp_com_sess)) {
                    $res->where('company_id', $tp_com_sess);
                }

                if (!empty($tp_ret_sess)) {
                    $res->where('retailer_id', $tp_ret_sess);
                }
                $data['debit'] = $res->get();
            }
            else if($loginRole == '4'){
                $res = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('payment_collect', '1')->where('topup_type', '2');
                if (!empty($tp_fr_sess)) {
                    if (!empty($tp_to_sess)) {
                    $res->whereBetween('payment_date', [$tp_fr_sess,  $tp_to_sess]);
                    }
                }
                if (!empty($tp_com_sess)) {
                    $res->where('company_id', $tp_com_sess);
                }

                if (!empty($tp_ret_sess)) {
                    $res->where('retailer_id', $tp_ret_sess);
                }
                $data['debit'] = $res->get();
            }
            else if($loginRole == '5'){
                $res =  DB::table('topups')->where('distributor_id', $distributorid)->where('user_id', $loginUser)->where('payment_collect', '1')->where('topup_type', '2');
                if (!empty($tp_fr_sess)) {
                    if (!empty($tp_to_sess)) {
                    $res->whereBetween('payment_date', [$tp_fr_sess,  $tp_to_sess]);
                    }
                }
                if (!empty($tp_com_sess)) {
                    $res->where('company_id', $tp_com_sess);
                }
                $data['debit'] = $res->get();
            }
        }
        else
        {

             if($loginRole == '0'){
                $data['debit'] = DB::table('topups')->where('payment_collect', '1')->where('topup_type', '2')->orderby('created_at', 'DESC')->get();
            }
            else if($loginRole == '2'){
                $data['debit'] = DB::table('topups')->where('distributor_id', $loginUser)->where('payment_collect', '1')->where('topup_type', '2')->orderby('created_at', 'DESC')->get();
            }
            else if($loginRole == '3'){
                $data['debit'] = DB::table('topups')->where('distributor_id', $distributorid)->where('payment_collect', '1')->where('topup_type', '2')->orderby('created_at', 'DESC')->get();
            }
            else if($loginRole == '4'){
                $data['debit'] = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('payment_collect', '1')->where('topup_type', '2')->orderby('created_at', 'DESC')->get();
            }
            else if($loginRole == '5'){
                $data['debit'] = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id', $loginUser)->where('payment_collect', '1')->where('topup_type', '2')->orderby('created_at', 'DESC')->get();
            }

    }

        return view('report.topup-report', $data); 
    }
    
    
        public function topup_credit_report(Request $request){
        $tp_fr_sess = $request->session()->get('tp_fr_sess');
        $tp_to_sess = $request->session()->get('tp_to_sess');
        $tp_com_sess = $request->session()->get('tp_com_sess');
        $tp_ret_sess = $request->session()->get('tp_ret_sess');
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $loginRole = $request->session()->get('loginRole');
         if($loginRole == '0'){
        $data['retailer'] = DB::table('users')->where('role', '5')->get();
        $data['company'] = DB::table('companies')->get();
        }else{
         $data['retailer'] = DB::table('users')->where('distributor_id', $distributorid)->where('role', '5')->get();
         $data['company'] = DB::table('companies')->where('distributor_id', $distributorid)->get();
        }
        $fosid = $request->session()->get('loginfos');

        if (isset($tp_fr_sess) || isset($tp_to_sess) ||  isset($tp_com_sess) || isset($tp_ret_sess) ) {
              if($loginRole == '0'){
                $res = DB::table('topups')->where('topup_type', '1');
                if (!empty($tp_fr_sess)) {
                    if (!empty($tp_to_sess)) {
                    $res->whereBetween('payment_date', [$tp_fr_sess,  $tp_to_sess]);
                    }
                }
                if (!empty($tp_com_sess)) {
                    $res->where('company_id', $tp_com_sess);
                }

                if (!empty($tp_ret_sess)) {
                    $res->where('retailer_id', $tp_ret_sess);
                }
                $data['debit'] = $res->get();
    
            }
            if($loginRole == '2'){
                $res = DB::table('topups')->where('distributor_id', $loginUser)>where('topup_type', '1');
                if (!empty($tp_fr_sess)) {
                    if (!empty($tp_to_sess)) {
                    $res->whereBetween('payment_date', [$tp_fr_sess,  $tp_to_sess]);
                    }
                }
                if (!empty($tp_com_sess)) {
                    $res->where('company_id', $tp_com_sess);
                }

                if (!empty($tp_ret_sess)) {
                    $res->where('retailer_id', $tp_ret_sess);
                }
                $data['debit'] = $res->get();
    
            }
            else if($loginRole == '3'){
                $res = DB::table('topups')->where('distributor_id', $distributorid)>where('topup_type', '1');
                if (!empty($tp_fr_sess)) {
                    if (!empty($tp_to_sess)) {
                    $res->whereBetween('payment_date', [$tp_fr_sess,  $tp_to_sess]);
                    }
                }
                if (!empty($tp_com_sess)) {
                    $res->where('company_id', $tp_com_sess);
                }

                if (!empty($tp_ret_sess)) {
                    $res->where('retailer_id', $tp_ret_sess);
                }
                $data['debit'] = $res->get();
            }
            else if($loginRole == '4'){
                $res = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id', $fosid)>where('topup_type', '1');
                if (!empty($tp_fr_sess)) {
                    if (!empty($tp_to_sess)) {
                    $res->whereBetween('payment_date', [$tp_fr_sess,  $tp_to_sess]);
                    }
                }
                if (!empty($tp_com_sess)) {
                    $res->where('company_id', $tp_com_sess);
                }

                if (!empty($tp_ret_sess)) {
                    $res->where('retailer_id', $tp_ret_sess);
                }
                $data['debit'] = $res->get();
            }
            else if($loginRole == '5'){
                $res =  DB::table('topups')->where('distributor_id', $distributorid)->where('user_id', $loginUser)>where('topup_type', '1');
                if (!empty($tp_fr_sess)) {
                    if (!empty($tp_to_sess)) {
                    $res->whereBetween('payment_date', [$tp_fr_sess,  $tp_to_sess]);
                    }
                }
                if (!empty($tp_com_sess)) {
                    $res->where('company_id', $tp_com_sess);
                }
                $data['debit'] = $res->get();
            }
        }
        else
        {

             if($loginRole == '0'){
                $data['debit'] = DB::table('topups')>where('topup_type', '1')->orderby('created_at', 'DESC')->get();
            }
            else if($loginRole == '2'){
                $data['debit'] = DB::table('topups')->where('distributor_id', $loginUser)->where('topup_type', '1')->orderby('created_at', 'DESC')->get();
            }
            else if($loginRole == '3'){
                $data['debit'] = DB::table('topups')->where('distributor_id', $distributorid)->where('topup_type', '1')->orderby('created_at', 'DESC')->get();
            }
            else if($loginRole == '4'){
                $data['debit'] = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('topup_type', '1')->orderby('created_at', 'DESC')->get();
            }
            else if($loginRole == '5'){
                $data['debit'] = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id', $loginUser)->where('topup_type', '1')->orderby('created_at', 'DESC')->get();
            }

    }

        return view('report.credit-report', $data); 
    }
    
    
    

    public function companywise_report(Request $request){
        $com_fr_sess = $request->session()->get('com_fr_sess');
        $com_to_sess = $request->session()->get('com_to_sess');
        $company_sess = $request->session()->get('company_sess');
        $com_ret_sess = $request->session()->get('com_ret_sess');
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $loginRole = $request->session()->get('loginRole');
        $fosid = $request->session()->get('loginfos');
        if($loginRole == '0'){
        $data['retailer'] = DB::table('users')->where('role', '5')->get();
        $data['company'] = DB::table('companies')->get();
        }else{
         $data['retailer'] = DB::table('users')->where('distributor_id', $distributorid)->where('role', '5')->get();
         $data['company'] = DB::table('companies')->where('distributor_id', $distributorid)->get();
        }
        if (isset($com_fr_sess) || isset($com_to_sess) ||  isset($company_sess) || isset($com_ret_sess) ) {
                 if($loginRole == '0'){
                $res = DB::table('topups')->where('status', '1');
                if (!empty($com_fr_sess)) {
                    if (!empty($com_to_sess)) {
                    $res->whereBetween('date', [$com_fr_sess,  $com_to_sess]);
                    }
                }
    
                if (!empty($company_sess)) {
                    $res->where('company_id', $company_sess);
                }

                if (!empty($com_ret_sess)) {
                    $res->where('user_id', $com_ret_sess);
                }
                $data['topup'] = $res->get();
    
            }
            if($loginRole == '2'){
                $res = DB::table('topups')->where('distributor_id', $loginUser)->where('status', '1');
                if (!empty($com_fr_sess)) {
                    if (!empty($com_to_sess)) {
                    $res->whereBetween('date', [$com_fr_sess,  $com_to_sess]);
                    }
                }
    
                if (!empty($company_sess)) {
                    $res->where('company_id', $company_sess);
                }

                if (!empty($com_ret_sess)) {
                    $res->where('user_id', $com_ret_sess);
                }
                $data['topup'] = $res->get();
    
            }
            else if($loginRole == '3'){
                $res = DB::table('topups')->where('distributor_id', $distributorid)->where('status', '1');
                if (!empty($com_fr_sess)) {
                    if (!empty($com_to_sess)) {
                    $res->whereBetween('date', [$com_fr_sess,  $com_to_sess]);
                    }
                }
    
                if (!empty($company_sess)) {
                    $res->where('company_id', $company_sess);
                }
                if (!empty($com_ret_sess)) {
                    $res->where('user_id', $com_ret_sess);
                }
                $data['topup'] = $res->get();
            }
            else if($loginRole == '4'){
                $res = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('status', '1');
                if (!empty($com_fr_sess)) {
                    if (!empty($com_to_sess)) {
                    $res->whereBetween('date', [$com_fr_sess,  $com_to_sess]);
                    }
                }
    
                if (!empty($company_sess)) {
                    $res->where('company_id', $company_sess);
                }

                if (!empty($com_ret_sess)) {
                    $res->where('user_id', $com_ret_sess);
                }

                $data['topup'] = $res->get();
            }
            else if($loginRole == '5'){
                $res = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->where('status', '1');
                if (!empty($com_fr_sess)) {
                    if (!empty($com_to_sess)) {
                    $res->whereBetween('date', [$com_fr_sess,  $com_to_sess]);
                    }
                }
                if (!empty($company_sess)) {
                    $res->where('company_id', $company_sess);
                }
                if (!empty($com_ret_sess)) {
                    $res->where('user_id', $com_ret_sess);
                }
                $data['topup'] = $res->get();
            }
        }
        else
        {

        if($loginRole == '0'){
            $data['topup'] = DB::table('topups')->where('status', '1')->orderby('user_id', 'DESC')->get();
        }
        else if($loginRole == '2'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $loginUser)->where('status', '1')->orderby('user_id', 'DESC')->get();
        }
        else if($loginRole == '3'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('status', '1')->orderby('user_id', 'DESC')->get();
        }
        else if($loginRole == '4'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('status', '1')->orderby('user_id', 'DESC')->get();
        }
        else if($loginRole == '5'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->where('status', '1')->orderby('user_id', 'DESC')->get();
        }

    }
        return view('report.companywise-report', $data); 
    }

    public function income_report(Request $request){
        $inc_fr_sess = $request->session()->get('inc_fr_sess');
        $inc_to_sess = $request->session()->get('inc_to_sess');
        $inc_com_sess = $request->session()->get('inc_com_sess');
        $inc_ret_sess = $request->session()->get('inc_ret_sess');
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $loginRole = $request->session()->get('loginRole');
        $fosid = $request->session()->get('loginfos');
           if($loginRole == '0'){
        $data['retailer'] = DB::table('users')->where('role', '5')->get();
        $data['company'] = DB::table('companies')->get();
        }else{
         $data['retailer'] = DB::table('users')->where('distributor_id', $distributorid)->where('role', '5')->get();
         $data['company'] = DB::table('companies')->where('distributor_id', $distributorid)->get();
        }

        if (isset($inc_fr_sess) || isset($inc_to_sess) ||  isset($inc_com_sess) || isset($inc_ret_sess) ) {
               if($loginRole == '0'){
                $res = DB::table('topups')->where('status', '1');
                if (!empty($inc_fr_sess)) {
                    if (!empty($inc_to_sess)) {
                    $res->whereBetween('date', [$inc_fr_sess,  $inc_to_sess]);
                    }
                }
                if (!empty($inc_com_sess)) {
                    $res->where('company_id', $inc_com_sess);
                }

                if (!empty($inc_ret_sess)) {
                    $res->where('user_id', $inc_ret_sess);
                }
                $data['topup'] = $res->get();
    
            }
            else if($loginRole == '2'){
                $res = DB::table('topups')->where('distributor_id', $loginUser)->where('status', '1');
                if (!empty($inc_fr_sess)) {
                    if (!empty($inc_to_sess)) {
                    $res->whereBetween('date', [$inc_fr_sess,  $inc_to_sess]);
                    }
                }
                if (!empty($inc_com_sess)) {
                    $res->where('company_id', $inc_com_sess);
                }

                if (!empty($inc_ret_sess)) {
                    $res->where('user_id', $inc_ret_sess);
                }
                $data['topup'] = $res->get();
    
            }
            else if($loginRole == '3'){
                $res = DB::table('topups')->where('distributor_id', $distributorid)->where('status', '1');
                if (!empty($inc_fr_sess)) {
                    if (!empty($inc_to_sess)) {
                    $res->whereBetween('date', [$inc_fr_sess,  $inc_to_sess]);
                    }
                }
                if (!empty($inc_com_sess)) {
                    $res->where('company_id', $inc_com_sess);
                }

                if (!empty($inc_ret_sess)) {
                    $res->where('user_id', $inc_ret_sess);
                }
                $data['topup'] = $res->get();
            }
            else if($loginRole == '4'){
                $res = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('status', '1');
                if (!empty($inc_fr_sess)) {
                    if (!empty($inc_to_sess)) {
                    $res->whereBetween('date', [$inc_fr_sess,  $inc_to_sess]);
                    }
                }
                if (!empty($inc_com_sess)) {
                    $res->where('company_id', $inc_com_sess);
                }

                if (!empty($inc_ret_sess)) {
                    $res->where('user_id', $inc_ret_sess);
                }

                $data['topup'] = $res->get();
            }
            else if($loginRole == '5'){
                $res = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->where('status', '1');
                if (!empty($inc_fr_sess)) {
                    if (!empty($inc_to_sess)) {
                    $res->whereBetween('date', [$inc_fr_sess,  $inc_to_sess]);
                    }
                }
                if (!empty($inc_com_sess)) {
                    $res->where('company_id', $inc_com_sess);
                }
                $data['topup'] = $res->get();
            }
        }
        else
        {
            
            
        if($loginRole == '0'){
            $data['topup'] = DB::table('topups')->where('status', '1')->orderby('user_id', 'DESC')->get();
        }
        if($loginRole == '2'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $loginUser)->where('status', '1')->orderby('user_id', 'DESC')->get();
        }
        else if($loginRole == '3'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('status', '1')->orderby('user_id', 'DESC')->get();
        }
        else if($loginRole == '4'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('status', '1')->orderby('user_id', 'DESC')->get();
        }
        else if($loginRole == '5'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->where('status', '1')->orderby('user_id', 'DESC')->get();
        }

    }
        return view('report.income-report', $data); 
    }
}
