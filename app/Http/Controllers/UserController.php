<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use DB;
use Hash;
use Session;
use Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginUser = $request->session()->get('loginUser');
        $data['fos'] = DB::table('users')->where('role', '4')->where('created_by', $loginUser)->get();
        return view('user.add-user', $data); 
    }
    
     public function view_profile(Request $request)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $loginId = $request->session()->get('loginId');
        $loginUser = $request->session()->get('loginUser');
        $data['user'] = DB::table('users')->where('id', $loginId)->first();
        return view('user.view-profile', $data); 
    }

    public function view_user(Request $request){
        $loginRole = $request->session()->get('loginRole');
        $loginUser = $request->session()->get('loginUser');
        if($loginUser){
        if($loginRole == '0'){
            $data['user'] = DB::table('users')->where('role','!=' ,'0')->get(); 
            $data['loginId'] = $request->session()->get('loginId');
            $data['loginEmail'] = $request->session()->get('loginEmail');
            $data['loginName'] = $request->session()->get('loginName');
            $data['loginRole'] = $request->session()->get('loginRole');
            $data['loginUser'] = $request->session()->get('loginUser');
            return view('user.view-user', $data); 
        }
        else if($loginRole == '1'){
        $data['user'] = DB::table('users')->where('created_by', $loginUser)->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('user.view-user', $data); 
        }
        else if($loginRole == '2'){
            $data['user'] = DB::table('users')->where('distributor_id', $loginUser)->get();
            $data['loginId'] = $request->session()->get('loginId');
            $data['loginEmail'] = $request->session()->get('loginEmail');
            $data['loginName'] = $request->session()->get('loginName');
            $data['loginRole'] = $request->session()->get('loginRole');
            $data['loginUser'] = $request->session()->get('loginUser');
            return view('user.view-user', $data); 
        }
        else{
            return redirect(route('dashboard'))->with('status', "You don't have Permission to access !!!"); 
        }
        }
        else{
           return back()->with('status', "Logout and Login Again !!!"); 
        }
    }

    public function view_retailer(Request $request, $fos){
        $data['user'] = DB::table('users')->where('fos', $fos)->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('user.view-user', $data); 
    }

    
    public function view_team(Request $request){
        $data['user'] = DB::table('users')->get();
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('user.view-team', $data); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|min:5|max:50',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'whatsapp' => 'required|unique:users',
            'adhaar' => 'required|unique:users',
            'pan' => 'required|unique:users',
        ]);
        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');
        $loginRole = $request->session()->get('loginRole');
        $password = rand(1000000, 9999999);
        $user_id = 'GAS' . date('md') . rand(1000, 9999);
        $user = new User();
        $user->name = $request->input('name');
        $user->user_id = $user_id;
        $user->distributor_id = $loginUser;
        if($loginRole == '1'){
        $user->sup_dist_id = $loginUser;
        }else{
        $user->sup_dist_id = $distributorid;  
        }
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->whatsapp = $request->input('whatsapp');
        $user->shop = $request->input('shop');
        $user->refrence = $request->input('refrence');
        $user->adhaar = $request->input('adhaar');
        $user->pan = $request->input('pan');
        $user->date = $request->input('date');
        $user->password = $password; // Hash the password for security
        $user->address = $request->input('address');
        $user->per_address = $request->input('per_address');
        $user->role = $request->input('role');
        if($request->input('role') == '5'){
        $user->fos = $request->input('fos');
        }
        $user->status = '1';
        $user->created_by = $loginUser;
        $user->save();
           if($user){
            Mail::send('UserMail', array( 
                'username' => $user_id, 
                'password' => $password,
                'email' => $request->input('email'),
                'subject' => 'GAS Login Detail', 
                'form_message' => "Don't Share these Details With Anyone !!", 
    
            ), function($message) use ($request){
                $message->from('info@globalaccountingsystem.com');
                $message->to($request->input('email'), 'User')->subject('GAS Login Detail');
            }); 
        }
    
        return redirect(route('view-user'))->with('status', 'User Added Successfully');
    }
    

    public function edit(Request $request, $id)
    {
        $data['user'] = User::find($id);
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        return view('user.edit-user', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->whatsapp = $request->input('whatsapp');
        $user->shop = $request->input('shop');
        $user->refrence = $request->input('refrence');
        $user->adhaar = $request->input('adhaar');
        $user->pan = $request->input('pan');
        $user->date = $request->input('date');
        $user->address = $request->input('address');
        $user->per_address = $request->input('per_address');
        $user->fos = $request->input('fos');
        $user->password = $request->input('password');
        $user->status = $request->input('status');
        $user->save();
        return redirect(route('view-user'))->with('status', 'User Update Successfully');
    }
    
    public function update_password(Request $request){
         $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        $loginId = $request->session()->get('loginId');
        $loginEmail = $request->session()->get('loginEmail');
        $loginName = $request->session()->get('loginName');
        $loginRole = $request->session()->get('loginRole');
        $loginUser = $request->session()->get('loginUser');
        $user = DB::table('users')->where('id', $loginId)->first();
        if($user){
            if($user->password == $request->current_password){
              $new_pass =  DB::table('users')->where('id', $loginId)->update(['password' => $request->new_password]);
              if($new_pass){
                 Mail::send('UserPass', array( 
                'username' => $loginUser, 
                'password' => $request->new_password,
                'email' => $loginEmail,
                'subject' => 'Your GAS password has been changed Successfully !!', 
                'form_message' => "Don't Share these Details With Anyone !!", 
    
            ), function($message) use ($request){
                $message->from('info@globalaccountingsystem.com');
                $loginEmails = $request->session()->get('loginEmail');
                $message->to($loginEmails, 'User')->subject('Your GAS password has been changed Successfully !!');
            }); 
            return back()->with('status', 'Your password has been changed Successfully !!');
              }
            }
            else{
                return back()->with('status', 'Your Current Password Not match !!');
            }
            
        }
        else{
            return back()->with('status', 'First login again!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function getUsersByRole(Request $request, $role_id){
        // $user = DB::table('users')->where('role', '=', $request->input('role'))->first();
        $users = DB::table('users')->where('role', '4')->select('user_id', 'name')->get();

        return response()->json($users);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('status', 'User Delete Successfully');
    }
}
