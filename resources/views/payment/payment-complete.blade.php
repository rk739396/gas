@include('component.table-head')
@include('component.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payment Collect</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payment Collect</li>
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
                <h3 class="card-title">Payment Collect</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Company Name</th>
                    <th>Retailer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Shop</th>
                    <th>Amount</th>
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
                    @php $retailer =  DB::table('users')->where('user_id', $debits->user_id)->first();  @endphp
                    <td>{{$retailer->name}}</td>
                    <td>{{$retailer->email}}</td>
                    <td>{{$retailer->phone}}</td>
                    <td>{{$retailer->shop}}</td>
                    <td>{{$debits->total_amount}}</td>
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
                    <th>Retailer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Shop</th>
                    <th>Amount</th>
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