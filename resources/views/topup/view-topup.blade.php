@include('component.table-head')
@include('component.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Topup Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Topup Request</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">View Topup Request</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Date & Time</th>
                    <th>Company Name</th>
                    <th>Amount</th>
                    <th>Retailer Name</th>
                    <th>Phone</th>
                    <th>Shop</th>
                    <th>Remarks</th>
                    @if($loginRole == '3' || $loginRole == '4')
                    <th>Action</th>
                    @endif
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
                    <td>{{$retailer->phone}} </td>
                    <td>{{$retailer->shop}} </td>

                    @if($topups->topup_remarks == '')
                    <td> No details Available </td>
                    @else
                    <td> CREDIT_TOPUP_ {{$company_name->name}} _ {{$topups->topup_remarks}} </td>
                    @endif
                    @if($loginRole == '3' || $loginRole == '4')
                    @if($topups->status == '1')
                     <td><p>Done</P></td>
                    @else
                    <td>
                    <div class="btn-group">
                    <button type="button" class="btn btn-info">Action</button>
                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a class="dropdown-item" href="{{asset('approve-topup-request/'. $topups->id)}}">Action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{asset('delete-topup-request/'. $topups->id)}}">Remove</a>
                    </div>
                  </div>
                    </td>
                    @endif
                    @endif
                  </tr>
                  @php 
                    $count++;
                    @endphp
                @endforeach
                  </tbody>
                  <tfoot>
                           <tr>
                    <th>Sr No.</th>
                    <th>Date & Time</th>
                    <th>Company Name</th>
                    <th>Amount</th>
                    <th>Retailer Name</th>
                    <th>Phone</th>
                    <th>Shop</th>
                    <th>Remarks</th>
                    @if($loginRole == '3' || $loginRole == '4')
                    <th>Action</th>
                    @endif
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