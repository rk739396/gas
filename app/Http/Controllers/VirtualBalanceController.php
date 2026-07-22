<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VirtualBalance;
use App\Models\Company;
use DB;

class VirtualBalanceController extends Controller
{
    // Show add form
    public function index(Request $request)
    {
        $data['loginName'] = $request->session()->get('loginName');
        $data['loginRole'] = $request->session()->get('loginRole');
        $data['loginUser'] = $request->session()->get('loginUser');
        $data['distributorid'] = $request->session()->get('logindistributor');

        // ✅ Get companies with ONLY id + name (for dropdown)
        $data['companies'] = Company::select('id', 'name')
            ->where('distributor_id', $data['loginUser'])
            ->orderBy('name', 'asc')
            ->get();

        // ✅ Get virtual balance history with company name (for table)
        $data['virtual_balances'] = DB::table('virtual_balances')
            ->join('companies', 'companies.id', '=', 'virtual_balances.company_id')
            ->select(
                'virtual_balances.*',
                'companies.name as company_name'
            )
            ->orderBy('virtual_balances.id', 'desc')
            ->get();

        return view('virtual-balance.index', $data);
    }

    // Store virtual balance
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'remarks' => 'nullable|string'
        ]);

        $loginUser = $request->session()->get('loginUser');
        $distributorid = $request->session()->get('logindistributor');

        DB::beginTransaction();

        try {

            $vb = new VirtualBalance();
            $vb->company_id = $request->company_id;
            $vb->user_id = $loginUser;
            $vb->distributor_id = $distributorid;
            $vb->amount = $request->amount;
            $vb->remarks = $request->remarks;

            // ❌ REMOVE THESE TWO LINES
            // $vb->date = date('Y-m-d');
            // $vb->month = date('Y-m');

            $vb->save();

            // OPTIONAL: update company balance
            DB::table('companies')
                ->where('id', $request->company_id)
                ->increment('amount', $request->amount);

            DB::commit();

            return back()->with('status', 'Virtual Balance Added Successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('status', 'Something went wrong: ' . $e->getMessage());
        }
    }
    // Delete record
    public function destroy($id)
    {
        $vb = VirtualBalance::find($id);

        if (!$vb) {
            return back()->with('status', 'Record not found');
        }

        $vb->delete();

        return back()->with('status', 'Deleted Successfully');
    }
}