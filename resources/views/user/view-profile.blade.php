@include('component.table-head')
@include('component.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  <strong><i class="fas fa-user mr-1"></i> User Detail</strong>

                <p class="text-muted">
                  {{$user->name}} / {{$user->user_id}} 
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i>Location</strong>

                <p class="text-muted">{{$user->address}}</p>

                <hr>

                <strong><i class="fas fa-phone mr-1"></i> Contact Details</strong>
                 <p class="text-muted"> Mobile : {{$user->phone}}</p>
                  <p class="text-muted"> Whatsapp : {{$user->address}}</p>
                   <p class="text-muted"> Email : {{$user->email}}</p>
             
               @php $fos = DB::table('users')->where('user_id', $user->fos)->first(); @endphp
               @if($fos)
               <hr>
                <strong><i class="far fa-file-alt mr-1"></i> FOS</strong>

                <p class="text-muted"> FOS Name : {{$fos->name}}</p>
                <p class="text-muted"> FOS Mobile : {{$fos->phone}}</p>
                <p class="text-muted"> FOS Whatsapp : {{$fos->address}}</p>
                <p class="text-muted"> FOS Email : {{$fos->email}}</p>
                @endif
                
                @if($loginRole != '0' && $loginRole != '1' && $loginRole != '2')
               @php $distribuor = DB::table('users')->where('user_id', $user->distributor_id)->first(); @endphp
               @if($distribuor)
               <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Distributor</strong>
                
                <p class="text-muted"> Distributor Name : {{$distribuor->name}}</p>
                <p class="text-muted"> Distributor Mobile : {{$distribuor->phone}}</p>
                <p class="text-muted"> Distributor Whatsapp : {{$distribuor->address}}</p>
                <p class="text-muted"> Distributor Email : {{$distribuor->email}}</p>
                @endif
                @endif
                  </div>

                  <div class="tab-pane" id="settings">
                                    @if(session()->has('status'))
                <div class="alert my-3 p-3 alert-success">
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
                    <form class="form-horizontal" method="post" action="{{route('update-password')}}">
                        @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="current_password" id="inputName" placeholder="Current Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name = 'new_password' id="inputEmail" placeholder="New Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Confirm password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="new_password_confirmation" id="inputName2" placeholder="Confirm password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @include('component.table-footer')