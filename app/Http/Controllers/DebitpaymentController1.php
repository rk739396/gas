<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Topup;
use App\Models\Debitpayment;
use Session;
use DB;
use Mail;

class DebitpaymentController extends Controller
{
    public function index(Request $request)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $data['company'] = DB::table('companies')->where('distributor_id', $distributorid)->get();
        return view('payment.debit-payment', $data);
    }

    public function fetchbalance(Request $request)
    {
        $loginUser = $request->session()->get('loginUser');
        $cb = DB::table('companybalances')
            ->where('retailer_id', $loginUser)
            ->where('company_id', $request->company_id)
            ->select('amount')
            ->first();
    
        if ($cb) {
            $data['balance_amount'] = $cb->amount;
        } else {
            $data['balance_amount'] = 0;
        }
    
        return response()->json($data);
    }

    public function debit_payment(Request $request)
    {
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $fosid = $request->session()->get('loginfos');
        $debit = new Debitpayment();
        $balance =   DB::table('topups')->where('user_id',$loginUser)->where('status', '1')->orderby('id', 'desc')->select('total_balance')->first();
        if(floatval($balance->total_balance) >= floatval($request->input('amount'))){
        $debit->retailer_id = $loginUser;
        $debit->distributor_id = $distributorid;
        $debit->fos_id = $fosid;
        $debit->company_id = $request->input('company_id');
        $debit->total_balance = $balance->total_balance;
        $debit->opening_balance = $balance->total_balance;
        $debit->total_amount = $request->input('amount');
        $debit->payment_status = '1';
        $debit->payment_mode = $request->input('payment_mode');
        $debit->payment_date = date('Y-m-d');
        $debit->transaction_id = $request->input('transaction_id');
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();  
            $filename = time().'.'.$extension;
            $file->move('uploads/image/',$filename);
            $debit->image = $filename;
        }
        $debit->payment_remarks = $request->input('payment_remarks');
        $debit->save();
        if($debit){
           $topup =  DB::table('topups')->where('user_id',$loginUser)->where('status', '1')->orderby('id', 'desc')->take(1)->update(['payment_status' => '1', 'total_amount' => $request->input('amount'),'payment_mode' => $request->input('payment_mode'),
            'payment_date' => date('Y-m-d'),'transaction_id' => $request->input('transaction_id'),'payment_remarks' => $request->input('payment_remarks'),'opening_balance' => $balance->total_balance
           ]);
           
            $company_d = DB::table('companies')->where('id', $request->input('company_id'))->first();
            $user_d = DB::table('users')->where('user_id', $loginUser)->first();
            $fos_d = DB::table('users')->where('user_id', $fosid)->first();
            $dis_d = DB::table('users')->where('user_id', $distributorid)->first();
           Mail::send('PaymentMail', array( 
            'shop_name' => $user_d->shop,
            'Retailer_name' => $user_d->name,  
            'amount' => $request->input('amount'),
            'company_name' => $company_d->name,
            'date' => date('Y-m-d'), 
            'email' => $user_d->email,
            'subject' => 'Payment Detail', 
            'form_message' => "Payment Detail !!", 
        ), function($message) use ($user_d, $dis_d, $fos_d){
            $message->from('info@globalaccountingsystem.com');
            $message->to([$user_d->email,$fos_d->email,$dis_d->email], 'User')->subject('GAS Payment Detail');
        }); 
        }
        return back()->with('status', 'Debit Payment Details Submitted Successfully');
    }
    else{
        return back()->with('status', 'Check Your Details First !!');
    }
    }

    public function view_pending(Request $request){
        $distributorid = $request->session()->get('logindistributor');
        $loginUser = $request->session()->get('loginUser');
        $loginRole = $request->session()->get('loginRole');
        if($loginRole == '4'){
            $data['debit'] = DB::table('debitpayments')
            ->where('distributor_id', $distributorid)
            ->where('fos_id', $loginUser)
            ->where('payment_collect', '=', '0')
            ->where('payment_mode', 'cash')
            ->orWhereNull('payment_collect')
            ->get();
        }
        else if($loginRole == '5'){
            $data['debit'] = DB::table('debitpayments')
            ->where('distributor_id', $distributorid)
            ->where('retailer_id', $loginUser)
            ->where('payment_collect', '=', '0')
            ->orWhereNull('payment_collect')
            ->get();
        }
        else{
            $data['debit'] = DB::table('debitpayments')
            ->where('distributor_id', $distributorid)
            ->where('payment_collect', '=', '0')
            ->orWhereNull('payment_collect')
            ->get(); 
        }
        $data['company'] = DB::table('companies')->where('distributor_id', $distributorid)->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('payment.pending-payment', $data); 
    }

    public function payment_collect(Request $request, $id)
    {
        $data['debit'] = Debitpayment::find($id);
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('payment.payment-collect', $data);
    }

    public function collect_update(Request $request, $id)
    {
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $debit = Debitpayment::find($id);
        if($request->input('payment_collect') == '1'){
            $post_balance = floatval($debit->total_balance);
            $new_amount = floatval($debit->total_amount);
            $total_balance = $post_balance - $new_amount;
            $debit->total_balance = $total_balance;
        DB::table('topups')->where('user_id',$debit->retailer_id)->where('status', '1')->orderby('id', 'desc')->take(1)->update(['total_balance' => $total_balance, 'paycollection_id'
     => $loginUser,'payment_collect' => $request->input('payment_collect'),'collect_date' => date('Y-m-d') ,'paycollection_id' => $loginUser]);
        }
        $debit->paycollection_id = $loginUser;
        $debit->collect_date = date('Y-m-d');
        $debit->payment_collect = $request->input('payment_collect');
        $debit->collect_remarks = $request->input('remarks');
        $debit->save();
        if($debit){
          $cb =   DB::table('companybalances')->where('company_id',$debit->company_id)->where('retailer_id',$debit->retailer_id)->where('distributor_id',$distributorid)->select('amount')->first();
          if($cb){
          $cpb = floatval($cb->amount);
          $npa = floatval($debit->total_amount);
          $tcb =  $cpb - $npa;
          DB::table('companybalances')->where('company_id',$debit->company_id)->where('retailer_id',$debit->retailer_id)->where('distributor_id',$distributorid)->update(['amount' => $tcb]);
          }
          $company_d = DB::table('companies')->where('id', $debit->company_id)->first();
          $user_d = DB::table('users')->where('user_id', $debit->retailer_id)->first();
          $fos_d = DB::table('users')->where('user_id', $debit->fos_id)->first();
          $dis_d = DB::table('users')->where('user_id', $debit->distributor_id)->first();
         Mail::send('PaymentAcceptMail', array( 
          'shop_name' => $user_d->shop,
          'Retailer_name' => $user_d->name,  
          'amount' => $debit->total_amount,
          'company_name' => $company_d->name,
          'date' => date('Y-m-d'), 
          'email' => $user_d->email,
          'subject' => 'Payment Accept Detail', 
          'form_message' => "Payment Accept Detail !!", 
      ), function($message) use ($user_d, $dis_d, $fos_d){
          $message->from('info@globalaccountingsystem.com');
          $message->to([$user_d->email,$fos_d->email,$dis_d->email], 'User')->subject('GAS Payment Accept Detail');
      }); 
        }
        return back()->with('status', 'Payment Details Submitted Successfully');
    }

    public function view_collect(Request $request){
        $distributorid = $request->session()->get('logindistributor');
        $data['debit'] = DB::table('debitpayments')
        ->where('distributor_id', $distributorid)
        ->where('payment_collect','1')
        ->get();
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('payment.payment-complete', $data); 
    }
}
