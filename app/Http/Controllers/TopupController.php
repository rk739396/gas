<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Topup;
use App\Models\Companybalance;
use DB;
use Mail;

class TopupController extends Controller
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
        $data['topup'] = DB::table('topups')->where('status', '0')->where('distributor_id', $distributorid)->where('user_id', $loginUser)->orderby('id', 'DESC')->take(5)->get();
        // $data['company'] = DB::table('companies')->where('distributor_id', $distributorid)->get();
        $data['company'] = DB::table('companies')
        ->join(
            'company_access_requests',
            'companies.id',
            '=',
            'company_access_requests.company_id'
        )
        // ->where('companies.distributor_id', $distributorid)
        ->where('company_access_requests.user_id', $loginUser)
        ->where('company_access_requests.status', 1) // Approved only
        ->select('companies.*')
        ->distinct()
        ->get();
        
        return view('topup.add-topup', $data);
    }

    public function view_topup(Request $request){
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $loginRole = $request->session()->get('loginRole');
        if($loginRole == '2'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('topup_type', '1')->orderby('id','DESC')->get();
        }
        else if($loginRole == '3'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('topup_type', '1')->orderby('id','DESC')->get();
        }
        else if($loginRole == '5'){
            $data['topup'] = DB::table('topups')->where('distributor_id', $distributorid)->where('user_id',  $loginUser)->where('topup_type', '1')->orderby('id','DESC')->get();
        }
        
        return view('topup.view-topup', $data); 
    }

    public function create(Request $request)
    {
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $supdistid = $request->session()->get('loginsupdist');
        $fosid = $request->session()->get('loginfos');
        $topup_id = 'tp' . date('md') . rand(1000, 9999);
        $topup = new Topup();
        $topup->company_id = $request->input('company_id');
        $topup->topup_id = $topup_id;
        $topup->amount = $request->input('amount');
        $topup->retailer_remarks = $request->input('retailer_remarks');
        $topup->user_id = $loginUser;
        $topup->distributor_id = $distributorid;
        $topup->sup_dist_id = $supdistid;
        $topup->fos_id = $fosid;
        $topup->topup_type = '1';
        $topup->total_amount = '0.00';
        $topup->date = date('Y-m-d');
        $topup->month = date('Y-m');
        $balance =   DB::table('topups')->where('user_id',$loginUser)->where('distributor_id', $distributorid)->orderby('id', 'desc')->select('total_balance')->first();
        // if($balance){
        //     $topup->total_balance = $balance->total_balance;
        // }
        // else{
        //     $topup->total_balance = '0';
        // }
        $topup->status = '0';
        $pending_topup = DB::table('topups')->where('user_id',$loginUser)->where('distributor_id', $distributorid)->where('status', '0')->orderby('id', 'desc')->first();
        if($pending_topup){
        return back()->with('status', 'We Can not Proceed.Topup Request Already Pending !!!');
        }else{
        $topup->save();
        $company_d = DB::table('companies')->where('id', $request->input('company_id'))->first();
        $user = DB::table('users')->where('user_id', $loginUser)->first();
        $distributor = DB::table('users')->where('user_id', $user->distributor_id)->first();
        Mail::send('TopupMail', array( 
            'topup_id' => $topup_id,
            'shop_name' => $user->shop,
            'Retailer_name' => $user->name,  
            'amount' => $request->input('amount'),
            'company_name' => $company_d->name,
            'date' => date('Y-m-d'), 
            'subject' => 'Topup Request Detail', 
            'form_message' => "Topup Request Detail !!", 

        ), function($message) use ($user, $distributor){
            $message->from('info@globalaccountingsystem.com');
            $message->to([$user->email,$distributor->email], 'User')->subject('GAS Topup Request Detail');
        }); 
        }
        return redirect(route('view-topup'))->with('status', 'Topup Request Send Successfully');
    }

    public function edit(Request $request, $id)
    {
        $data['topup'] = Topup::find($id);
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $data['company'] = DB::table('companies')->get();
        return view('topup.update-topup', $data);
    }

    public function accept_update(Request $request, $id)
    {
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $topup = Topup::find($id);
        $topup->status = $request->input('status');
        $topup->topup_remarks = $request->input('remarks');
        $topup->approver_id = $loginUser;
        $topup->payment_status = '0';
        $topup->total_amount = '0';
        if($request->input('status') == '1'){
        $distributor_com = DB::table('companies')->where('id',$topup->company_id)->where('distributor_id',$distributorid)->orderby('id', 'desc')->select('amount')->first();
        if(floatval($distributor_com->amount) >= floatval($topup->amount)){
            $company_amt = floatval($distributor_com->amount);
            $paid_amt = floatval($topup->amount);
            $bal_amt = $company_amt - $paid_amt;
            DB::table('companies')
            ->where('id', $topup->company_id)
            ->where('distributor_id', $topup->distributor_id)
            ->update(['amount' => $bal_amt]);

            $balance =   DB::table('topups')->where('user_id',$topup->user_id)->where('distributor_id',$distributorid)->orderby('id', 'desc')->select('total_balance')->first();
            if($balance){
            $post_balance = floatval($balance->total_balance);
            $new_balance = floatval($topup->amount);
            $total_balance = $post_balance + $new_balance;
            $topup->total_balance = $total_balance;
            }
            else{
              $topup->total_balance = $topup->amount;
            }
        }
        }
        $topup->save();
        if($topup){
            $company = DB::table('companybalances')->where('retailer_id',$topup->user_id)->where('company_id',$topup->company_id)->where('distributor_id',$distributorid)->first();
            if($company){
                $company_balance = floatval($company->amount);
                $add_amt = floatval($topup->amount);
                $tcb = $company_balance + $add_amt;
                DB::table('companybalances')->where('retailer_id',$topup->user_id)->where('company_id',$topup->company_id)->where('distributor_id',$distributorid)->update(['amount' => $tcb]);
            }
            else{
                $cb = new Companybalance();
                $cb->company_id = $topup->company_id;
                $cb->amount = $topup->amount;
                $cb->retailer_id = $topup->user_id;
                $cb->distributor_id	 = $topup->distributor_id;
                $cb->fos_id = $topup->fos_id;
                $cb->save();
            }

            $company_d = DB::table('companies')->where('id', $topup->company_id)->first();
            $user_d = DB::table('users')->where('user_id', $topup->user_id)->first();
            $fos_d = DB::table('users')->where('user_id', $topup->fos_id)->first();
            $dis_d = DB::table('users')->where('user_id', $topup->distributor_id)->first();
            Mail::send('AcceptMail', array( 
                'topup_id' =>  $topup->topup_id,
                'shop_name' => $user_d->shop,
                'Retailer_name' => $user_d->name,  
                'amount' => $topup->amount,
                'company_name' => $company_d->name,
                'date' => date('Y-m-d'), 
                'email' => $user_d->email,
                'subject' => 'Topup Request Accept Detail', 
                'form_message' => "Topup Request Accept Detail !!", 
             ), function($message) use ($user_d, $dis_d, $fos_d){
                $message->from('info@globalaccountingsystem.com');
                $message->to([$user_d->email,$fos_d->email,$dis_d->email], 'User')->subject('GAS Topup Request Detail');
            }); 
        }
        return redirect(route('view-topup'))->with('status', 'Details Submitted Successfully');
    }


    public function edit_payment(Request $request, $id)
    {
        $data['topup'] = Topup::find($id);
        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('payment.recharge-payment', $data);
    }

    public function payment(Request $request, $id)
    {
        $loginUser = $request->session()->get('loginUser');
        $topup = Topup::find($id);
        $topup->payment = '1';
        $topup->payment_mode = $request->input('payment_mode');
        $topup->payment_date = date('Y-m-d');
        $topup->transaction_id = $request->input('transaction_id');
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();  
            $filename = time().'.'.$extension;
            $file->move('uploads/image/',$filename);
            $topup->image = $filename;
        }
        $topup->save();
        return redirect(route('view-pending-payment'))->with('status', 'Payment Details Submitted Successfully');
    }

    public function payment_collect(Request $request, $id)
    {
        $data['topup'] = Topup::find($id);
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
        $topup = Topup::find($id);
        $topup->paycollection_id = $loginUser;
        $topup->collect_date = date('Y-m-d');
        $topup->payment_collect = '1';
        $topup->remarks = $request->input('remarks');
        $topup->save();
        return back()->with('status', 'Payment Details Submitted Successfully');
    }
    
    public function commissionIndex(Request $request)
    {
        $distributorid = $request->session()->get('logindistributor');

        $data['company'] = DB::table('companies')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');

        $data['companies'] = DB::table('companies')
            ->where('distributor_id', $distributorid)
            ->orderBy('name')
            ->get();

        return view('commission.index', $data);
    }
    
    public function view_commision(Request $request)
    {
        $distributorid = session('logindistributor');

        $data['loginId'] = session('loginId');
        $data['loginEmail'] = session('loginEmail');
        $data['loginName'] = session('loginName');
        $data['loginRole'] = session('loginRole');
        $data['loginUser'] = session('loginUser');

        $data['commissions'] = DB::table('topups')
            ->leftJoin('companies', 'companies.id', '=', 'topups.company_id')
            ->select(
                'topups.*',
                'companies.name as company_name'
            )
            ->where('topups.distributor_id', $distributorid)
            ->where('topups.topup_type', 3)
            ->orderBy('topups.id', 'DESC')
            ->get();

        return view('commission.view-commision', $data);
    }    
    
    public function commissionStore(Request $request)
    {
        $loginUser = session('loginUser');
        $distributorid = session('logindistributor');
        $supdistid = session('loginsupdist');
        $fosid = session('loginfos');
    
        $lastBalance = DB::table('topups')
            ->where('user_id',$request->user_id)
            ->where('status',1)
            ->orderByDesc('id')
            ->value('total_balance');
    
        $openingBalance = $lastBalance ?? 0;
    
        $closingBalance = $openingBalance + $request->amount;
    
        $topup = new Topup();
    
        $topup->topup_id = 'CM'.date('ymdHis');
    
        $topup->user_id = $request->user_id;
    
        $topup->company_id = $request->company_id;
    
        $topup->distributor_id = $distributorid;
    
        $topup->sup_dist_id = $supdistid;
    
        $topup->fos_id = $fosid;
    
        $topup->amount = $request->amount;
    
        $topup->opening_balance = $openingBalance;
    
        $topup->total_balance = $closingBalance;
    
        $topup->topup_type = 3;
    
        $topup->status = 1;
    
        $topup->approver_id = $loginUser;
    
        $topup->topup_remarks = $request->remarks;
    
        $topup->date = date('Y-m-d');
    
        $topup->month = date('Y-m');
    
        $topup->save();
    
        return back()->with('status','Commission Added Successfully');
    }    
    
    public function accountStatement(Request $request)
    {
        $distributorid = $request->session()->get('logindistributor');
        $loginUser     = $request->session()->get('loginUser');
        $loginName     = $request->session()->get('loginName');
        $loginRole     = $request->session()->get('loginRole');
    
        if (!$loginUser) {
            abort(403, 'Unauthorized.');
        }
    
        $request->validate([
            'from_date'   => 'nullable|date',
            'to_date'     => 'nullable|date|after_or_equal:from_date',
            'retailer_id' => 'nullable|string',
            'company_id'  => 'nullable|integer',
        ]);
    
        $fromDate = $request->filled('from_date')
            ? $request->input('from_date')
            : now()->startOfMonth()->format('Y-m-d');
    
        $toDate = $request->filled('to_date')
            ? $request->input('to_date')
            : now()->endOfMonth()->format('Y-m-d');
    
        $query = DB::table('topups as t')
            ->join('users as u', 'u.user_id', '=', 't.user_id')
            ->join('companies as c', 'c.id', '=', 't.company_id')
            ->where('t.user_id', $loginUser)
            ->whereDate('t.date', '>=', $fromDate)
            ->whereDate('t.date', '<=', $toDate)
            // Topups (type 1) included as-is; debits (type 2) only count once collected
            ->where(function ($q) {
                $q->where('t.topup_type', '1')
                  ->orWhere(function ($q2) {
                      $q2->where('t.topup_type', '2')
                         ->where('t.payment_collect', '1');
                  });
            })
            ->select(
                't.id',
                't.topup_id',
                't.date',
                't.company_id',
                't.topup_type',
                't.amount',
                't.total_amount',
                't.total_balance',
                't.status',
                't.payment_collect',
                'u.name as retailer_name',
                'u.shop as shop_name',
                'c.name as company_name'
            );
    
        if ($request->filled('company_id')) {
            $query->where('t.company_id', $request->input('company_id'));
        }
    
        $all = (clone $query)->orderBy('t.date')->orderBy('t.id')->get();
    
        $statement = $query->orderBy('t.date')->orderBy('t.id')->paginate(50)->withQueryString();
    
        $companies = DB::table('companies')->where('distributor_id', $distributorid)->select('id', 'name')->get();
    
        $summary = [
            'total_topup'     => $all->where('topup_type', '1')->sum('amount'),
            'total_debit'     => $all->where('topup_type', '2')->sum('total_amount'),
            'closing_balance' => optional($all->last())->total_balance ?? 0,
        ];
    
        $grouped = $all->groupBy(function ($row) {
            return $row->company_name . '|' . $row->date;
        })->map(function ($rows) {
            $first  = $rows->first();
            $credit = $rows->where('topup_type', '1')->sum('amount');
            $debit  = $rows->where('topup_type', '2')->sum('total_amount');
    
            return (object) [
                'company_name' => $first->company_name,
                'date'         => $first->date,
                'credit'       => $credit,
                'debit'        => $debit,
                'total'        => $credit - $debit,
            ];
        })->sortBy('date')->values();
    
        return view('topup.account-statement', compact(
            'statement', 'companies', 'summary', 'grouped',
            'fromDate', 'toDate', 'loginName', 'loginRole'
        ));
    } 

    public function destroy(string $id)
    {
        $topup = Topup::find($id);
        $topup->delete();
        return redirect(route('view-topup'))->with('status', 'Topup Delete Successfully');
    }
}
