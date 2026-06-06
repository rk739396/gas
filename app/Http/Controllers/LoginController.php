<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Session;
use Hash;


class LoginController extends Controller
{
    public function index(Request $request){
        if($request->session()->has('loginName'))
        {
        $data['user'] =  $request->session()->get('loginName');
        return view('pages.login', $data);
        }else{
            return view('pages.login');
        }
       }
    
    
      public function loginuser(Request $request){
            $validator = $request->validate([
                'user_id' => 'nullable|required_without:mobile',
                'mobile'  => 'nullable|required_without:user_id',
                'password' => 'required'
            ]);
           
    
            $user = DB::table('users')->where('user_id', '=', $request->user_id)->orWhere('phone', $request->phone)->first();
            if($user){
                if($request->input('password') == $user->password){
                    if($user->status == '1'){
                    $request->session()->put('loginId', $user->id );
                    $request->session()->put('loginEmail', $user->email);
                    $request->session()->put('loginName', $user->name);
                    $request->session()->put('loginRole', $user->role);
                    $request->session()->put('loginUser', $user->user_id);
                    $request->session()->put('logindistributor', $user->distributor_id);
                    $request->session()->put('loginsupdist', $user->sup_dist_id);
                    $request->session()->put('loginfos', $user->fos);
                    if($user->role == '0'){
                        return redirect(route('dashboard'));
                    }
                    else if($user->role == '1'){
                        return redirect(route('sup-dashboard'));
                    }
                    else if($user->role == '2'){
                        return redirect(route('dist-dashboard'));
                    }
                    else if($user->role == '3'){
                        return redirect(route('tt-dashboard'));
                    }
                    else if($user->role == '4'){
                        return redirect(route('fos-dashboard'));
                    }
                    else{
                        return redirect(route('ret-dashboard'));
                    }
                    }
                    else{
                        return back()->with('status','Permission Denied !!!');
                    }
                }
                else{
                    return back()->with('status','Password not matches !!!');
                }
            }
            else{
                    return back()->with('status','Fill Your Details Properly !!!');
                }
        }
        
        public function logout(){
            if (Session::has('loginUser')){
                Session::flush();
                return redirect(route('login'));
            }
        }
    
}
