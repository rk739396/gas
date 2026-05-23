<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Topup;
use App\Models\Debitpayment;
use Session;
use DB;

class CallController extends Controller
{
    public function index(Request $request)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $data['note'] = DB::table('notes')->first();
        $distributorid = $request->session()->get('logindistributor');
        $loginRole = $request->session()->get('loginRole');
        $loginUser = $request->session()->get('loginUser');
        $data['recharge'] = DB::table('topups')->where('status', '1')->sum('amount');
        $data['month_recharge'] = DB::table('topups')->where('status', '1')->where('month', date('Y-m'))->sum('amount');
        $data['company'] = DB::table('topups')->where('status', '1')->distinct('company_id')->count();
        $data['companyrecharge'] = DB::table('topups')
            ->select('company_id', DB::raw('SUM(amount) as total_amount'))
            ->where('status', '1')
            ->groupBy('company_id')
            ->get();
        $data['total_amt'] = DB::table('topups')->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt'))->where('topup_type', '1')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
         $data['paid_amt'] = DB::table('topups')->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt'))->where('topup_type', '2')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
        $data['total_member'] = DB::table('users')->where('role', '!=','0')->count();
        $data['total_sup'] = DB::table('users')->where('role','1')->count();
        $data['total_dist'] = DB::table('users')->where('role','2')->count();
        $data['total_ret'] = DB::table('users')->where('role','5')->count();
        $data['user'] = DB::table('users')->where('created_by', $loginUser)->where('role', '1')->orderby('id', 'DESC')->take(10)->get();
        return view('pages.dashboard', $data);
    }

    public function sup_dash(Request $request){
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $data['note'] = DB::table('notes')->first();
        $data['recharge'] = DB::table('topups')->where('sup_dist_id', $loginUser)->where('status', '1')->sum('amount');
        $data['month_recharge'] = DB::table('topups')->where('sup_dist_id', $loginUser)->where('status', '1')->where('month', date('Y-m'))->sum('amount');
        $data['company'] = DB::table('topups')->where('sup_dist_id', $loginUser)->where('status', '1')->distinct('company_id')->count();
        $data['companyrecharge'] = DB::table('topups')
        ->select('company_id', DB::raw('SUM(amount) as total_amount'))
        ->where('sup_dist_id', $loginUser)
        ->where('status', '1')
        ->groupBy('company_id')
        ->get();
        $data['total_amt'] = DB::table('topups')->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt'))->where('sup_dist_id', $loginUser)->where('topup_type', '1')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
        $data['paid_amt'] = DB::table('topups')->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt'))->where('sup_dist_id', $loginUser)->where('topup_type', '2')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
        $data['total_member'] = DB::table('users')->where('role', '!=','0')->where('sup_dist_id', $loginUser)->count();
        $data['total_fos'] = DB::table('users')->where('sup_dist_id', $loginUser)->where('role','4')->count();
        $data['total_tt'] = DB::table('users')->where('sup_dist_id', $loginUser)->where('role','3')->count();
        $data['total_ret'] = DB::table('users')->where('sup_dist_id', $loginUser)->where('role','5')->count();
        $data['user'] = DB::table('users')->where('sup_dist_id', $loginUser)->orderby('id', 'DESC')->take(10)->get();
        return view('pages.super-dist-dashboard', $data);
    }


    public function dist_dash(Request $request){
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $data['note'] = DB::table('notes')->first();
        $data['recharge'] = DB::table('topups')->where('distributor_id', $loginUser)->where('status', '1')->sum('amount');
        $data['month_recharge'] = DB::table('topups')->where('distributor_id', $loginUser)->where('status', '1')->where('month', date('Y-m'))->sum('amount');
        $data['company'] = DB::table('companies')->where('user_id', $loginUser)->distinct('name')->count();
        $data['companyrecharge'] = DB::table('topups')
        ->select('company_id', DB::raw('SUM(amount) as total_amount'))
        ->where('distributor_id', $loginUser)
        ->where('status', '1')
        ->groupBy('company_id')
        ->get();
        $data['total_amt'] = DB::table('topups')->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt'))->where('distributor_id', $loginUser)->where('topup_type', '1')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
        $data['paid_amt'] = DB::table('topups')->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt'))->where('distributor_id', $loginUser)->where('topup_type', '2')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
        $data['total_member'] = DB::table('users')->where('role', '!=','0')->where('distributor_id', $loginUser)->count();
        $data['total_fos'] = DB::table('users')->where('distributor_id', $loginUser)->where('role','4')->count();
        $data['total_tt'] = DB::table('users')->where('distributor_id', $loginUser)->where('role','3')->count();
        $data['total_ret'] = DB::table('users')->where('distributor_id', $loginUser)->where('role','5')->count();
        $data['user'] = DB::table('users')->where('distributor_id', $loginUser)->orderby('id', 'DESC')->take(10)->get();
        return view('pages.dist-dashboard', $data);
    }


    public function top_dash(Request $request){
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $loginUser = $request->session()->get('loginUser');
        $data['note'] = DB::table('notes')->first();
        $data['recharge'] = DB::table('topups')->where('distributor_id', $distributorid)->where('status', '1')->sum('amount');
        $data['month_recharge'] = DB::table('topups')->where('distributor_id', $distributorid)->where('status', '1')->where('month', date('Y-m'))->sum('amount');
        $data['company'] = DB::table('companies')->where('distributor_id', $distributorid)->distinct('name')->count();
            $data['companyrecharge'] = DB::table('topups')
            ->select('company_id', DB::raw('SUM(amount) as total_amount'))
            ->where('distributor_id', $distributorid)
            ->where('status', '1')
            ->groupBy('company_id')
            ->get();
            $data['total_amt'] = DB::table('topups')->where('distributor_id', $distributorid)->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt'))->where('distributor_id', $distributorid)->where('topup_type', '1')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
            $data['paid_amt'] = DB::table('topups')->where('distributor_id', $distributorid)->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt'))->where('distributor_id', $distributorid)->where('topup_type', '2')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
            $data['total_ret'] = DB::table('users')->where('distributor_id', $distributorid)->where('role','5')->count();
            $data['user'] = DB::table('users')->where('distributor_id', $distributorid)->where('role','5')->orderby('id', 'DESC')->take(10)->get();
        return view('pages.topteam-dashboard', $data);
    }

    public function fos_dash(Request $request){
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $data['note'] = DB::table('notes')->first();
        $data['recharge'] = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id',  $loginUser)->where('status', '1')->sum('amount');
        $data['month_recharge'] = DB::table('topups')->where('distributor_id', $distributorid)->where('fos_id',  $loginUser)->where('status', '1')->where('month', date('Y-m'))->sum('amount');
        $data['company'] = DB::table('companies')->where('distributor_id', $distributorid)->distinct('name')->count();
        $data['companyrecharge'] = DB::table('topups')
        ->select('company_id', DB::raw('SUM(amount) as total_amount'))
        ->where('distributor_id', $distributorid)
        ->where('fos_id',  $loginUser)->where('status', '1')
        ->groupBy('company_id')
        ->get();
        $data['total_amt'] = DB::table('topups')->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt')) ->where('distributor_id', $distributorid)
        ->where('fos_id',  $loginUser)->where('topup_type', '1')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
        $data['paid_amt'] = DB::table('topups')->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt')) ->where('distributor_id', $distributorid)
        ->where('fos_id',  $loginUser)->where('topup_type', '2')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
        $data['total_ret'] = DB::table('users')->where('distributor_id', $distributorid)->where('fos',  $loginUser)->where('role','5')->count();
        $data['user'] = DB::table('users')->where('distributor_id', $distributorid)->where('fos',  $loginUser)->where('role','5')->orderby('id', 'DESC')->take(10)->get();
        return view('pages.fos-dashboard', $data);
    }

    public function ret_dash(Request $request){
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $data['note'] = DB::table('notes')->first();
        $data['recharge'] = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->where('status', '1')->sum('amount');
        $data['month_recharge'] = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->where('status', '1')->where('month', date('Y-m'))->sum('amount');
        $data['company'] = DB::table('companies')->where('distributor_id', $distributorid)->distinct('name')->count();
        $data['companyrecharge'] = DB::table('topups')
        ->select('company_id', DB::raw('SUM(amount) as total_amount'))
        ->where('distributor_id', $distributorid)
        ->where('user_id',  $loginUser)->where('status', '1')
        ->groupBy('company_id')
        ->get();
        $data['total_amt'] = DB::table('topups')->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt'))->where('distributor_id', $distributorid)
        ->where('user_id',  $loginUser)->where('topup_type', '1')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
        $data['paid_amt'] = DB::table('topups')->select('month', DB::raw('SUM(amount) as order_amt'), DB::raw('SUM(total_amount) as paid_amt'))->where('distributor_id', $distributorid)
        ->where('user_id',  $loginUser)->where('topup_type', '2')->groupBy('month')->orderby('month', 'desc')->take(5)->get();
        $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->take(5)->get();
        return view('pages.ret-dashboard', $data);
    }
}
