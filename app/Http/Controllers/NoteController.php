<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;
use DB;
use Hash;
use Session;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $data['loginId'] = $request->session()->get('loginId');
        $data['loginEmail'] = $request->session()->get('loginEmail');
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $data['note'] = DB::table('notes')->first();
        return view('notes.add-notes', $data); 
    }

    
    public function create(Request $request)
    {
        $loginRole = $request->session()->get('loginRole');
        $note = DB::table('notes')->first();
        if($loginRole == '0'){
            DB::table('notes')->where('id',$note->id)->update(['message1' => $request->input('message1'),'message2' => $request->input('message2')]);
        }
        return back()->with('status', 'Details Changed Successfully!!');
}
}
