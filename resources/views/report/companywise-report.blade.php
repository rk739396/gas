@include('component.table-head')
@include('component.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Company Wise Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">COMPANY WISE OB_TOPUP_CREDIT_PENDING</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <form action="{{route('filter')}}" method="post">
                    @csrf
            <div class="card">
             <div class="row p-3">
             @if($loginRole == '5')
                            <div class="form-group col-md-3">
                                <label for="input-3">From</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="com_fr_date">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="input-3">To</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="com_to_date">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="input-3">Company</label>
                                <select class="form-control"  name="company_name">
                                    <option value = "">Choose...</option>
                                    @foreach($company as $companies)
                                    <option value="{{$companies->id}}">{{$companies->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                           
                            <div class="box-footer col-md-3 m-auto pt-3">
                            <button type="submit" class="btn btn-info pull-right">Filter</button>
                            <button type="submit" class="btn btn-default">Cancel</button>  
                            </div>

                            @else
                            <div class="form-group col-md-2">
                                <label for="input-3">From</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="com_fr_date">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="input-3">To</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="com_to_date">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="input-3">Company</label>
                                <select class="form-control"  name="company_name">
                                    <option value = "">Choose...</option>
                                    @foreach($company as $companies)
                                    <option value="{{$companies->id}}">{{$companies->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="input-3">Retailer</label>
                                <select class="form-control" id="User_role" name="com_retail">
                                    <option value = "">Choose...</option>
                                    @foreach($retailer as $retailers)
                                    <option value="{{$retailers->user_id}}">{{$retailers->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="box-footer col-md-2 m-auto pt-3">
                            <button type="submit" class="btn btn-info pull-right">Filter</button>
                            <button type="submit" class="btn btn-default">Cancel</button>  
                            </div>
                           @endif

                            </div>
                            </div>
                            </form>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">COMPANY WISE OB_TOPUP_CREDIT_PENDING</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped d-block" style="overflow-x: auto;">                  
                  <thead>
                  <tr>
                    <th style="text-wrap : nowrap !important" >Sr No.</th>
                    <th style="text-wrap : nowrap !important" >Date & Time</th>
                    <th style="text-wrap : nowrap !important" >TXN ID</th>
                    <th style="text-wrap : nowrap !important" >Retailer Detail</th>
                    <th style="text-wrap : nowrap !important" >OB</th>
                    <th style="text-wrap : nowrap !important" >Credit</th>
                    <th style="text-wrap : nowrap !important" >Debit</th>
                    <th style="text-wrap : nowrap !important" >Pending</th>
                    <th style="text-wrap : nowrap !important" >Company name</th>
                    <th style="text-wrap : nowrap !important" >Remarks</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php 
                    $count = 1;
                    @endphp
                @foreach($topup as $topups)
                  <tr>
                    <td>{{$count}}</td>
                    <td>{{$topups->created_at}}</td>
                    <td>{{$topups->topup_id}}</td>
                    <td> 
                    @php $retailer =  DB::table('users')->where('user_id', $topups->user_id)->first();  @endphp
                    <ul>
                        <li>Name : {{$retailer->name}}</li>
                        <li>Shop Name : {{$retailer->shop}}</li>
                    </ul>
                    </td>
                    @php
                    $company = DB::table('companies')->where('id', $topups->company_id)->first();
                    @endphp
                    <td>{{$topups->opening_balance ?? '0.00'}}</td>
                    <td>{{$topups->amount}}</td>
                    <td>{{$topups->total_amount}}</td>
                    <td>{{$topups->total_balance}}</td>
                    <td>{{$company->name}}</td>
                    @if($topups->payment_remarks)
                    <td>{{$topups->payment_remarks}}</td>
                    @else
                    <td>No Remarks</td>
                    @endif
                  </tr>
                  @php 
                    $count++;
                    @endphp
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                   <th style="text-wrap : nowrap !important" >Sr No.</th>
                    <th style="text-wrap : nowrap !important" >Date & Time</th>
                    <th style="text-wrap : nowrap !important" >TXN ID</th>
                    <th style="text-wrap : nowrap !important" >Retailer Detail</th>
                    <th style="text-wrap : nowrap !important" >OB</th>
                    <th style="text-wrap : nowrap !important" >Credit</th>
                    <th style="text-wrap : nowrap !important" >Debit</th>
                    <th style="text-wrap : nowrap !important" >Pending</th>
                    <th style="text-wrap : nowrap !important" >Company name</th>
                    <th style="text-wrap : nowrap !important" >Remarks</th>
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
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('component.table-footer')