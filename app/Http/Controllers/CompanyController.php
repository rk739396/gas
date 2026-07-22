<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Validation\Rule;
use DB;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('company.add-company', $data);
    }

    public function view_company(Request $request){
        $distributorid = $request->session()->get('logindistributor');
        $loginUser = $request->session()->get('loginUser');
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $data['company'] = DB::table('companies')->where('distributor_id', $loginUser)->orderby('id')->get();
        return view('company.view-company', $data); 
    }

    public function create(Request $request)
    {
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $supdistid = $request->session()->get('loginsupdist');
        $company = new Company();
        $company->name = $request->input('name');
        $company->amount = 0;
        $company->user_id = $loginUser;
        $company->distributor_id = $loginUser;
        $company->sup_dist_id = $distributorid;
        $company->date = date('d-m-Y');
        $company->save();
        return redirect(route('view-company'))->with('status', 'Company Added Successfully');
    }

    public function edit(Request $request, $id)
    {
        $data['company'] = Company::find($id);
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('company.update-company', $data);
    }

    public function update(Request $request , $id)
    {
        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->amount = $request->input('amount');
        $company->date = date('d-m-Y');
        $company->save();
        return redirect(route('view-company'))->with('status', 'Company Updated Successfully');
    }

    public function destroy(string $id)
    {
        $user = Company::find($id);
        $user->delete();
        return back()->with('status', 'Company Delete Successfully');
    }
}
