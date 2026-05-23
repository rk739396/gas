@include('component.table-head')
@include('component.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Charges</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Charges</li>
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
                <h3 class="card-title">View Charges</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Date</th>
                    <th>Company Name</th>
                    <th>Charges</th>
                    <th>Operation</th>
                    <th>Total Balance</th>
                    <th>Retailer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Shop</th>
                    <th>Remarks</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                    @php 
                    $count = 1;
                    @endphp
                @foreach($charge as $charges)
                  <tr>
                    <td>{{$count}}</td>
                    <td>{{$charges->date}}</td>
                    @php $company_name =  DB::table('companies')->where('id', $charges->company_id)->select('name')->first();  @endphp
                    <td>{{$company_name->name}}</td>
                    <td>{{$charges->ch_amount}}</td>
                    <td>@if($charges->operation == 'add')
                    <button type="button" class="btn btn-success">Addition</button>
                    @else
                    <button type="button" class="btn btn-danger">Substraction</button>
                    @endif
                    <td>{{$charges->total_balance}}</td>
                    @php $retailer =  DB::table('users')->where('user_id', $charges->retailer_id)->first();  @endphp
                    <td> {{$retailer->name}}</td>
                    <td>{{$retailer->email}}</td>
                    <td>{{$retailer->phone}} </td>
                    <td>{{$retailer->shop}} </td>
                    <td>{{$charges->remarks}}</td>
                  </tr>
                  @php 
                    $count++;
                    @endphp
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Sr No.</th>
                    <th>Date</th>
                    <th>Company Name</th>
                    <th>Charges</th>
                    <th>Operation</th>
                    <th>Total Balance</th>
                    <th>Retailer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Shop</th>
                    <th>Remarks</th>
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