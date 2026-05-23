@include('component.head')
@include('component.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>FOS Assign</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">FOS Assign</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header bg-dark">
                    <h3 class="card-title text-white">Update FOS Assign</h3>

                    <div class="card-tools text-white">
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button> -->
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
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
                <form action="" method="POST">
                    @csrf
                    @method('put')
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-3">Current FOS</label>
                                <select class="form-control" id="current_fos" name="current_fos">
                                    <option disabled>Choose...</option>
                                    @foreach($userfos as $userfoses)
                                    <option  {{$fos->old_fos_id === $userfoses->user_id ? 'selected' : '' }} value="{{$userfoses->user_id}}">{{$userfoses->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input-3">New FOS</label>
                                <select class="form-control" id="User_role" name="newfos">
                                    <option disabled>Choose...</option>
                                    @foreach($userfos as $userfoses)
                                    <option {{$fos->fos_id === $userfoses->user_id ? 'selected' : '' }} value="{{$userfoses->user_id}}">{{$userfoses->name}}</option>
                                    @endforeach
                                </select>
                            </div>

            <div class="col-md-12">
                <div class="form-group">
                  <label>Retailer</label>
                  <div class="select2-purple">
                  <input type="text" class="form-control" value="{{$fos->retailer_id}}" disabled>
                    </select>
                  </div>
                </div>
                <!-- /.form-group -->
              </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <button type="reset" class="btn btn-default float-right">Cancel</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->




@include('component.footer')