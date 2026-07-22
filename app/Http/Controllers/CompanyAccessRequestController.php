<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyAccessRequest;

class CompanyAccessRequestController extends Controller
{
    // Retailer Request Page
    public function index(Request $request)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $distributorid = $request->session()->get('logindistributor');        
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');

        // $data['companies'] = DB::table('companies')->orderBy('name')->get();
        $data['companies'] = DB::table('companies')->where('distributor_id',$distributorid)->orderBy('name')->get();        

        return view('company_access_request.index', $data);
    }

    // Save Request
    public function store(Request $request)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');

        $loginUser = $data['loginUser']; // ✅ FIXED

        $exists = CompanyAccessRequest::where('company_id', $request->company_id)
            ->where('user_id', $loginUser)
            ->first();

        if ($exists) {
            return back()->with(
                'status',
                'Company access request already submitted.'
            );
        }

        CompanyAccessRequest::create([
            'company_id' => $request->company_id,
            'user_id'    => $loginUser,
            'status'     => 0
        ]);

        return back()->with(
            'status',
            'Company access request submitted successfully.'
        );
    }

    // Topup Team View Requests
    public function view(Request $request)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');

        $data['requests'] = DB::table('company_access_requests')
            ->join(
                'companies',
                'companies.id',
                '=',
                'company_access_requests.company_id'
            )
            ->join(
                'users',
                'users.user_id',
                '=',
                'company_access_requests.user_id'
            )
            ->whereIn('company_access_requests.status', [0, 1])
            ->select(
                'company_access_requests.*',
                'companies.name as company_name',
                'users.name as retailer_name',
                'users.shop',
                'users.phone'
            )
            ->orderBy('company_access_requests.id', 'desc')
            ->get();

            
        return view(
            'company_access_request.view',
            $data
        );
    }

    // Approve Request
    public function approve(Request $request, $id)
    {
        $loginUser = $request->session()->get('loginUser');
        $request = CompanyAccessRequest::find($id);

        if (!$request) {
            return redirect()->back()->with('error', 'Request not found.');
        }

        $request->status = 1;
        $request->approved_by = $loginUser; // or Auth::id()
        $request->created_at = now();
        $request->save();

        return redirect()
            ->route('view-company-access-request')
            ->with('success', 'Company access request approved successfully.');
    }

    // Reject Request
    public function reject(Request $request, $id)
    {
        $loginUser = $request->session()->get('loginUser');

        $accessRequest = CompanyAccessRequest::find($id);

        if (!$accessRequest) {
            return back()->with(
                'status',
                'Request not found.'
            );
        }

        $accessRequest->update(['status' => 2,'approved_by' => $loginUser]);

        return back()->with(
            'status',
            'Company access rejected successfully.'
        );
    }

    public function myRequests(Request $request)
    {
        $loginUser = $request->session()->get('loginUser');

        $requests = CompanyAccessRequest::join(
                'companies',
                'companies.id',
                '=',
                'company_access_requests.company_id'
            )
            ->where(
                'company_access_requests.user_id',
                $loginUser
            )
            ->select(
                'company_access_requests.*',
                'companies.name as company_name'
            )
            ->orderBy('company_access_requests.id', 'desc')
            ->get();

        return view(
            'company_access_request.my_requests',
            compact('requests')
        );
    }    
}