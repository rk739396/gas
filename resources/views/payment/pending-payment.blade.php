@include('component.table-head')
@include('component.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Pending Payment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Pending Payment</li>
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
                <h3 class="card-title">View Pending Payment</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Company Name</th>
                    <th>Amount</th>
                    <th>Payment Mode</th>
                    <th>Retailer Detail</th>
                    <th>Contact Detail</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    @if($loginRole == '3' || $loginRole == '4')
                    <th>Action</th>
                    @endif
                  </tr>
                  </thead>
                  <tbody>
                    @php 
                    $count = 1;
                    @endphp
                @foreach($debit as $debits)
                  <tr>
                    <td>{{$count}}</td>
                    @php $company_name =  DB::table('companies')->where('id', $debits->company_id)->select('name')->first();  @endphp
                    <td>{{$company_name->name}}</td>
                    <td>{{$debits->total_amount}}</td>
                    <td>{{$debits->payment_mode}}</td>
                    <td> 
                    @php $retailer =  DB::table('users')->where('user_id', $debits->user_id)->first();  @endphp
                    <ul>
                        <li>Name : {{$retailer->name}}</li>
                        <li>Shop Name : {{$retailer->shop}}</li>
                    </ul>
                    </td>
                    <td> 
                    <ul>
                        <li>{{$retailer->email}}</li>
                        <li>{{$retailer->phone}} / {{$retailer->whatsapp}}</li>
                    </ul>
                    </td>
                    <td>{{$debits->created_at}}</td>
                    <td>@if($debits->payment_status == '1')
                    <button type="button" class="btn btn-warning btn-sm" >Approval Pending</button>
                    @else
                    <button type="button" class="btn btn-danger btn-sm" >Payment Pending</button>
                    @endif
                    </td>
                    @if($loginRole == '3' || $loginRole == '4')
                    <td>
                    <div class="btn-group">
                    <button type="button" class="btn btn-info">Action</button>
                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      @if($debits->payment_status == '1')
                      <a class="dropdown-item" href="{{asset('payment-collect/'. $debits->id)}}">Collect</a>
                      @else
                      <a class="dropdown-item" href="#">Payment Pending</a>
                      @endif
                    </div>
                    </div>
                  </div>
                    </td>
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
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Payment Mode</th>
                    <th>Retailer Detail</th>
                    <th>Contact Detail</th>
                    <th>Date & Time</th>
                    <th>Status</th>
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