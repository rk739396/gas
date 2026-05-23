@include('component.head')
@include('component.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Credit Topup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Credit Topup</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header bg-dark">
                    <h3 class="card-title text-white">Credit Topup</h3>

                    <div class="card-tools text-white">
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button> -->
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @if(session()->has('status'))
                <div class="alert my-3 p-3 alert-danger">
                    {{session('status')}}
                </div>
                @endif

                @if ($errors->any())
     @foreach ($errors->all() as $error)
           <div class="alert alert-danger" role="alert">
                 {{ $error }}
           </div>
    @endforeach
@endif
                <form action="{{route('save-topup-request')}}" method="POST">
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                        <div class="form-group col-md-6">
                                <label for="input-3">Company Name</label>
                                <select class="form-control" id="company_id" name="company_id">
                                    <option value="" >Choose...</option>
                                    @foreach($company as $companies)
                                    <option value="{{$companies->id}}">{{$companies->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputUsername1">Current Balance</label>
                                <input type="text" class="form-control"  id="balance_amount" disabled>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="exampleInputUsername1">Amount</label>
                                <input type="text" class="form-control" name="amount" placeholder="Enter Amount">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="exampleInputUsername1">Remarks</label>
                                <textarea class="form-control"  name="retailer_remarks" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <button type="reset" class="btn btn-default float-right">Cancel</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.container-fluid -->

        <div class="container-fluid mt-5">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-dark">
                <h3 class="card-title text-white">View Topup Request</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                     <th>Sr No.</th>
                    <th>Company Name</th>
                    <th>Amount</th>
                    <th>Retailer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Shop</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php 
                    $count = 1;
                    @endphp
                @foreach($topup as $topups)
                  <tr>
                  <td>{{$count}}</td>
                  @php $company_name =  DB::table('companies')->where('id', $topups->company_id)->select('name')->first();  @endphp
                    <td>{{$company_name->name}}</td>
                    <td>{{$topups->amount}} 
                    @if($topups->status == '1')
                    <small class="label pull-right bg-green p-1">Done</small>
                    @else
                    <small class="label pull-right bg-red p-1">Pending</small>
                    @endif</td></td>
                    @php $retailer =  DB::table('users')->where('user_id', $topups->user_id)->first();  @endphp
                    <td> {{$retailer->name}}</td>
                    <td>{{$retailer->email}}</td>
                    <td>{{$retailer->phone}} </td>
                    <td>{{$retailer->shop}} </td>
                  </tr>
                  @php 
                    $count++;
                    @endphp
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                     <th>Sr No.</th>
                    <th>Company Name</th>
                    <th>Amount</th>
                    <th>Retailer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Shop</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('component.footer')
