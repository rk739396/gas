@include('component.table-head')
@include('component.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View FOS Change</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View FOS Change</li>
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
                <h3 class="card-title">View FOS Change</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Date</th>
                    <th>Old FOS</th>
                    <th>New FOS</th>
                    <th>Retailer</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php 
                    $count = 1;
                    @endphp
                @foreach($fos as $foses)
                  <tr>
                    <td>{{$count}}</td>
                    <td>{{$foses->date}}</td>
                    @php
                    $oldfos = DB::table('users')->where('user_id', $foses->old_fos_id)->select('name')->first();
                    @endphp
                    <td>{{$oldfos->name}}</td>
                    @php
                    $newfos = DB::table('users')->where('user_id', $foses->fos_id)->select('name')->first();
                    @endphp
                    <td>{{$newfos->name}}</td>
                    <td> 
                    @php $retailer_detail =  DB::table('users')->where('user_id', $foses->retailer_id)->first();  @endphp
                    <ul>
                        <li>Name : {{$retailer_detail->name}}</li>
                        <li>Contact : {{$retailer_detail->email}} / <br> {{$retailer_detail->phone}} / {{$retailer_detail->whatsapp}} </li>
                        <li>Shop Name : {{$retailer_detail->shop}}</li>
                    </ul>
                    </td>

                    @php
                    $created_name = DB::table('users')->where('user_id', $foses->created_by)->select('name')->first();
                    @endphp
                    <td>{{$created_name->name}}</td>
                    <td>
                    <div class="btn-group">
                    <button type="button" class="btn btn-info">Action</button>
                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a class="dropdown-item" href="{{asset('update-fos/'. $foses->id)}}">Edit</a>
                    </div>
                  </div>
                    </td>
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
                    <th>Old FOS</th>
                    <th>New FOS</th>
                    <th>Retailer</th>
                    <th>Created By</th>
                    <th>Action</th>
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