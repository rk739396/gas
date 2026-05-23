<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fosassign;
use Illuminate\Validation\Rule;
use DB;
use Hash;
use Session;


class FosassignController extends Controller
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
        $data['fos'] = DB::table('users')->where('role', '4')->where('created_by', $loginUser)->orderby('id')->get();
        return view('fos.fos-assign', $data); 
    }


    public function fetchretailer(Request $request)
    {
        $data['retailers'] = User::where("fos", $request->current_fos)->where('role', '5')->distinct()->select(['user_id', 'name'])->get();
        return Response()->json($data);
    }

    public function create(Request $request)
    {
           $validator = $request->validate([
                'current_fos' => 'required',
                'newfos' => 'required',
                'retailer' => 'required'
            ]);
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $all_retailer = $request->input('retailer');
        foreach ($all_retailer as $retailers) {
            $fos = new Fosassign();
            $fos->old_fos_id = $request->input('current_fos');
            $fos->fos_id = $request->input('newfos');
            $fos->retailer_id = $retailers;
            $fos->distributor_id = $distributorid;
            $fos->created_by = $loginUser;
            $fos->date = date('d-m-Y');
            $fos->save();
            if($fos){
                DB::table('users')->where('user_id',$retailers)->where('role', '5')->update(['fos' => $request->input('newfos')]);
            }
        }
        return redirect(route('view-fos'))->with('status', 'FOS Assign Successfully');
    }

    public function view_fos(Request $request){
        $distributorid = $request->session()->get('logindistributor');
        $data['fos'] = DB::table('fosassigns')->where('distributor_id', $distributorid)->orderby('id')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('fos.view-fosassign', $data); 
    }

    public function edit(Request $request, $id)
    {
        $loginUser = $request->session()->get('loginUser');
        $data['userfos'] = DB::table('users')->where('role', '4')->where('created_by', $loginUser)->orderby('id')->get();
        $data['fos'] = Fosassign::find($id);
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('fos.update-fosassign', $data);
    }

    public function update(Request $request , $id)
    {
        $loginUser = $request->session()->get('loginUser');
        $fos = Fosassign::find($id);
        $fos->old_fos_id = $request->input('current_fos');
        $fos->fos_id = $request->input('newfos');
        $fos->created_by = $loginUser;
        $fos->date = date('d-m-Y');
        $fos->save();
        if($fos){
            DB::table('users')->where('user_id',$fos->retailer_id)->where('role', '5')->update(['fos' => $request->input('newfos')]);
        }
        return redirect(route('view-fos'))->with('status', 'FOS Assign Updated Successfully');
}

}
