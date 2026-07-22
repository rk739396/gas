@include('component.table-head')
@include('component.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pending Payment To Retailer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pending Payment To Retailer</li>
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
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="tt_fr_date">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="input-3">To</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="tt_to_date">
                            </div>
                              <div class="form-group col-md-3">
                                <label for="input-3">Company</label>
                                <select class="form-control"  name="tt_com_name">
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
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="tt_fr_date">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="input-3">To</label>
                                <input type="date" class="form-control" pattern="\d{4}-\d{2}-\d{2}"  name="tt_to_date">
                            </div>
                              <div class="form-group col-md-2">
                                <label for="input-3">Company</label>
                                <select class="form-control"  name="tt_com_name">
                                    <option value = "">Choose...</option>
                                    @foreach($company as $companies)
                                    <option value="{{$companies->id}}">{{$companies->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="input-3">Retailer</label>
                                <select class="form-control" id="User_role" name="tt_ret_name">
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
                <h3 class="card-title">Pending Payment To Retailer</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Retailer Id</th>
                     <th>Retailer Name</th>
                     <th>Mobile No</th>
                    <th>Agency Name</th>
                    <th>Total Topup To Retailer</th>
                    <th>Total Topup Fee From Retailer</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php 
                    $count = 1;
                    @endphp
                @foreach($topup as $topups)
                  <tr>
                    <td>{{$count}}</td>
                    <td>{{$topups->user_id}}</td>
                    @php $retailer =  DB::table('users')->where('user_id', $topups->user_id)->first();  @endphp
                     <td> {{$retailer->phone}}</td>
                     <td> {{$retailer->name}}</td>
                    <td> {{$retailer->shop}}</td>
                    <td>{{$topups->total_amount}}</td>
                    <td>{{$topups->paid_amount}}</td>
                  </tr>
                  @php 
                    $count++;
                    @endphp
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Sr No.</th>
                    <th>Retailer Id</th>
                     <th>Retailer Name</th>
                     <th>Mobile No</th>
                    <th>Agency Name</th>
                    <th>Total Topup To Retailer</th>
                    <th>Total Topup Fee From Retailer</th>
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