@include('component.table-head')
@include('component.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View User</li>
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
                <h3 class="card-title">View User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Document Detail</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($user as $users)
                  <tr>
                    <td>{{$users->name}}</td>
                    <td><?php if($users->role == '1'){ ?> Super Distributor <?php } else if($users->role == '2'){ ?> Distributor  <?php }else if($users->role == '3'){ ?> 
                       Topup Team <?php }else if($users->role == '4'){ ?>  FOS <?php }else{ ?> Retailes <?php } ?> </td>
                    <td>{{$users->email}} / {{$users->phone}} / {{$users->whatsapp}}</td>
                    <td>{{$users->shop}} / {{$users->address}} / {{$users->per_address}}</td>
                    <td>{{$users->adhaar}} / {{$users->pan}}</td>
                    <td>@if($users->status == '1')
                    <button type="button" class="btn btn-success">Active</button>
                    @else
                    <button type="button" class="btn btn-danger">Inactive</button>
                    @endif
                    </td>
                    <td>
                    <div class="btn-group">
                    <button type="button" class="btn btn-info">Action</button>
                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a class="dropdown-item" href="{{asset('update-user/'. $users->id)}}">Edit</a>
                      <!--<div class="dropdown-divider"></div>-->
                      <!--<a class="dropdown-item" href="{{asset('delete-user/'. $users->id)}}">Delete</a>-->
                    </div>
                  </div>
                    </td>
                  </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Document Detail</th>
                    <th>Status</th>
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