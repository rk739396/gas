@include('component.head')
@include('component.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update User</li>
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
                    <h3 class="card-title text-white">Update User</h3>
                    <div class="card-tools text-white">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
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
                            <div class="form-group col-md-4">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Mobile Number</label>
                                <input type="text" class="form-control" name="phone" value="{{$user->phone}}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputUsername1">Whatsapp Number</label>
                                <input type="text" class="form-control" name="whatsapp" value="{{$user->whatsapp}}" >
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Shop name</label>
                                <input type="text" class="form-control" name="shop"  value="{{$user->shop}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Refrence Id</label>
                                <input type="text" class="form-control" name="refrence"
                                value="{{$user->refrence}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Adhaar Number</label>
                                <input type="text" class="form-control" name="adhaar"
                                value="{{$user->adhaar}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Pan Number</label>
                                <input type="text" class="form-control" name="pan" value="{{$user->pan}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="date" class="form-control" name="date" value="{{$user->date}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Address</label>
                                <textarea class="form-control" name="address" id="" cols="30" rows="2"
                                >{{$user->address}}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputUsername1">Permanent Address</label>
                                <textarea class="form-control" name="per_address" id="" cols="30" rows="2" >{{$user->per_address}}</textarea>
                            </div>
                            
                              <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="text" class="form-control" name="password" value="{{$user->password}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input-3">Role</label>
                                <input type="text" class="form-control"   value="<?php if($user->role == '1'){ ?> Super Distributor <?php } else if($user->role == '2'){ ?> Distributor  <?php }else if($user->role == '3'){ ?> 
                       Topup Team <?php }else if($user->role == '4'){ ?>  FOS <?php }else{ ?> Retailes <?php } ?>" readonly>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="input-3">Status</label>
                                <select class="form-control" name="status">
                                    <option disabled>Choose...</option>
                                    <option {{ $user->status === '1' ? 'selected' : '' }}  value="1" >Active</option>
                                    <option {{ $user->status === '0' ? 'selected' : '' }} value="0">Inactive</option>

                                </select>
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