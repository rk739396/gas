    
        
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
        $fosid = $request->session()->get('loginfos');
        $loginRole = $request->session()->get('loginRole');
        if($loginRole == '0'){
        $data['fos'] = DB::table('users')->where('role', '4')->get();
        }else{
         $data['fos'] = DB::table('users')->where('distributor_id', $distributorid)->where('role', '4')->get();
        }
        if (isset($ttfs_fr_sess) || isset($ttfs_to_sess) ||  isset($ttfs_fos_sess) ||  isset($ttfs_com_sess)) {
        if($loginRole == '0'){ 
            $data['fos'] = DB::table('users')->where('role', '4')->get();
            $res = DB::table('topups')->select('fos_id', DB::raw('SUM(total_amount) as paid_amount'))->where('payment_mode', 'cash')->where('status', '1')->groupby('fos_id');
            if (!empty($ttfs_fr_sess)) {
                if (!empty($ttfs_to_sess)) {
                $res->whereBetween('date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                }
            }
            if (!empty($ttfs_fos_sess)) {
                $res->where('fos_id', $ttfs_fos_sess);
            }
            $data['topup'] = $res->get();

        }
        else  if($loginRole == '2'){
            $res = DB::table('topups')->select('fos_id', DB::raw('SUM(total_amount) as paid_amount'))->where('payment_mode', 'cash')->where('distributor_id', $loginUser)->where('status', '1')->groupby('fos_id');
            if (!empty($ttfs_fr_sess)) {
                if (!empty($ttfs_to_sess)) {
                $res->whereBetween('date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                }
            }
            if (!empty($ttfs_fos_sess)) {
                $res->where('fos_id', $ttfs_fos_sess);
            }
            $data['topup'] = $res->get();

        }
        else if($loginRole == '3'){
            $res = DB::table('topups')->select('fos_id', DB::raw('SUM(total_amount) as paid_amount'))->where('payment_mode', 'cash')->where('distributor_id', $distributorid)->where('status', '1')->groupby('fos_id');
            if (!empty($ttfs_fr_sess)) {
                if (!empty($ttfs_to_sess)) {
                $res->whereBetween('date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                }
            }
            if (!empty($ttfs_fos_sess)) {
                $res->where('fos_id', $ttfs_fos_sess);
            }
            $data['topup'] = $res->get();
        }
        else if($loginRole == '4'){
            $res = DB::table('topups')->select('fos_id', DB::raw('SUM(total_amount) as paid_amount'))->where('payment_mode', 'cash')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->where('status', '1')->groupby('fos_id');
            if (!empty($ttfs_fr_sess)) {
                if (!empty($ttfs_to_sess)) {
                $res->whereBetween('date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                }
            }
            if (!empty($ttfs_fos_sess)) {
                $res->where('fos_id', $ttfs_fos_sess);
            }
            $data['topup'] = $res->get();
        }
        else if($loginRole == '5'){
            $res = DB::table('topups')->select('fos_id', DB::raw('SUM(total_amount) as paid_amount'))->where('payment_mode', 'cash')->where('distributor_id', $distributorid)->where('fos_id',  $loginUser)->where('status', '1')->groupby('fos_id');
            if (!empty($ttfs_fr_sess)) {
                if (!empty($ttfs_to_sess)) {
                $res->whereBetween('date', [$ttfs_fr_sess,  $ttfs_to_sess]);
                }
            }
            $data['topup'] = $res->get();
        }
    }
    else
    {
        if($loginRole == '0'){
            $data['topup'] = DB::table('topups')->select('fos_id', DB::raw('SUM(total_amount) as paid_amount'))->where('payment_mode', 'cash')->where('status', '1')->groupby('fos_id')->get();
        }
        else if($loginRole == '2'){
            $data['topup'] = DB::table('topups')->select('fos_id', DB::raw('SUM(total_amount) as paid_amount'))->where('payment_mode', 'cash')->where('distributor_id', $loginUser)->where('status', '1')->groupby('fos_id')->get();
        }
        else if($loginRole == '3'){
            $data['topup'] = DB::table('topups')->select('fos_id', DB::raw('SUM(total_amount) as paid_amount'))->where('payment_mode', 'cash')->where('distributor_id', $distributorid)->where('status', '1')->groupby('fos_id')->get();
        }
        else if($loginRole == '4'){
            $data['topup'] = DB::table('topups')->select('fos_id', DB::raw('SUM(total_amount) as paid_amount'))->where('payment_mode', 'cash')->where('distributor_id', $distributorid)->where('fos_id', $fosid)->groupby('fos_id')->where('status', '1')->get();
        }
        else if($loginRole == '5'){
            $data['topup'] = DB::table('topups')->select('fos_id', DB::raw('SUM(total_amount) as paid_amount'))->where('payment_mode', 'cash')->where('distributor_id', $distributorid)->where('fos_id',  $loginUser)->groupby('fos_id')->where('status', '1')->get();
        }

    }
        return view('report.total-fos-collect', $data); 
    }

