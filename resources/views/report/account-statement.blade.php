@include('component.table-head')
@include('component.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Account Statement</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Account Statement</li>
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
                            <div class="form-group col-md-4">
                                <label for="input-3">From</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="acc_fr_date">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="input-3">To</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="acc_to_date">
                            </div>
                            <div class="box-footer col-md-4 m-auto pt-3">
                            <button type="submit" class="btn btn-info pull-right">Filter</button>
                            <button type="submit" class="btn btn-default">Cancel</button>  
                            </div>
                            

                          @else
                          <div class="form-group col-md-3">
                                <label for="input-3">From</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="acc_fr_date">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="input-3">To</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="acc_to_date">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="input-3">Retailer</label>
                                <select class="form-control" id="User_role" name="acc_retail">
                                    <option value = "">Choose...</option>
                                    @foreach($retailer as $retailers)
                                    <option value="{{$retailers->user_id}}">{{$retailers->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="box-footer col-md-3 m-auto pt-3">
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
                <h3 class="card-title">Account Statement</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped d-block" style="overflow-x: auto;">                  
              <thead>
                  <tr>
                    <th style="text-wrap : nowrap !important" >Sr No.</th>
                    <th style="text-wrap : nowrap !important" >Transaction Date</th>
                    <th style="text-wrap : nowrap !important" >Transaction Id</th>
                    <th style="text-wrap : nowrap !important" >Retailer Detail</th>
                    <th style="text-wrap : nowrap !important" >Remarks</th>
                    <th style="text-wrap : nowrap !important" >OB</th>
                    <th style="text-wrap : nowrap !important" >Credit</th>
                    <th style="text-wrap : nowrap !important" >Debit</th>
                    <th style="text-wrap : nowrap !important" >Runing Balance</th>
                    <!--<th style="text-wrap : nowrap !important" >Total</th>-->
                  </tr>
                  </thead>
                  <tbody>
                    @php 
                    $count = 1;
                    @endphp
                @foreach($topup as $topups)
                  <tr>
                    <td style="text-wrap : nowrap !important">{{$count}}</td>
                    <td style="text-wrap : nowrap !important">{{$topups->created_at}}</td>
                    <td style="text-wrap : nowrap !important">{{$topups->topup_id}}</td>
                    <td style="text-wrap : nowrap !important"> 
                    @php $retailer =  DB::table('users')->where('user_id', $topups->user_id)->first();  @endphp
                    <ul>
                        <li>Name : {{$retailer->name}}</li>
                        <li>Shop Name : {{$retailer->shop}}</li>
                    </ul>
                    </td>
                    @php $company =  DB::table('companies')->where('id', $topups->company_id)->first();  @endphp
                    <td style="text-wrap : nowrap !important">@if($topups->topup_type == '1') @if($topups->status == '1') ACCEPT_ @else PENDING_ @endif CREDIT_TOPUP_ {{$company->name}} @elseif($topups->topup_type == '2')  @if($topups->	payment_collect == '1') ACCEPT_ @else PENDING_ @endif DEBIT_TOPUP_ {{$company->name}} @endif</td>
                    <!--<td style="text-wrap : nowrap !important">{{$topups->opening_balance ?? '0.00' }}</td>-->
                    <td style="text-wrap : nowrap !important">{{'0.00' }}</td>                    
                    <td style="text-wrap : nowrap !important">{{$topups->amount}}</td>
                    <td style="text-wrap : nowrap !important">{{$topups->total_amount ?? '0.00' }}</td>
                    <td style="text-wrap : nowrap !important">{{$topups->total_balance}}</td>
                    <!--<td style="text-wrap : nowrap !important">{{$topups->opening_balance ?? '0.00' }}</td>-->
                  </tr>
                  @php 
                    $count++;
                    @endphp
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="text-wrap : nowrap !important" >Sr No.</th>
                    <th style="text-wrap : nowrap !important" >Transaction Date</th>
                    <th style="text-wrap : nowrap !important" >Transaction Id</th>
                    <th style="text-wrap : nowrap !important" >Retailer Detail</th>
                    <th style="text-wrap : nowrap !important" >Remarks</th>
                    <th style="text-wrap : nowrap !important" >OB</th>
                    <th style="text-wrap : nowrap !important" >Credit</th>
                    <th style="text-wrap : nowrap !important" >Debit</th>
                    <th style="text-wrap : nowrap !important" >Runing Balance</th>
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