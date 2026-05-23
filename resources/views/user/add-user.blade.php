@include('component.head')
@include('component.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add User</li>
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
                    <h3 class="card-title text-white">Add User</h3>

                    <div class="card-tools text-white">
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button> -->
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> -->
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
                <form action="{{route('save-user')}}" method="POST">
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Mobile Number</label>
                                <input type="text" class="form-control" name="phone" placeholder="Enter Your Number">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputUsername1">Whatsapp Number</label>
                                <input type="text" class="form-control" name="whatsapp" placeholder="Enter Your Number">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Shop name</label>
                                <input type="text" class="form-control" name="shop" placeholder="Enter Your Shop name">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Adhaar Number</label>
                                <input type="text" class="form-control" name="adhaar"
                                    placeholder="Enter Your Adhaar Number">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Pan Number</label>
                                <input type="text" class="form-control" name="pan" placeholder="Enter Your Pan Number">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="date" class="form-control" name="date">
                            </div>

                            
                            <div class="form-group col-md-4">
                                <label for="input-3">Role</label>
                                <select class="form-control" id="user_role" name="role">
                                    <option disabled>Choose...</option>
                            <?php if($loginRole == '0'){ ?>
                                    <option value="1">Super Distributor</option>
                            <?php }else if($loginRole == '1'){ ?>
                                    <option value="2">Distributor</option>
                            <?php }else if($loginRole == '2'){ ?>
                                    <option value="3">Topup Team</option>
                                    <option value="4">FOS</option>
                                    <option value="5">Retailer</option>
                            <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Address</label>
                                <textarea class="form-control" name="address" id="" cols="30" rows="2"
                                    placeholder="Enter Your address"></textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputUsername1">Permanent Address</label>
                                <textarea class="form-control" name="per_address" id="" cols="30" rows="2"
                                    placeholder="Enter Your address"></textarea>
                            </div>


                            <div class="form-group col-md-12" id="user_fos"  style="display:none">
                                <label for="exampleInputEmail1">FOS</label>
                                <select class="form-control"  name="fos">
                                    <option disabled>Choose...</option>
                                    @foreach($fos as $foses)
                                    <option value="{{$foses->user_id}}">{{$foses->name}}</option>
                                    @endforeach
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const role1 = document.getElementById('user_role');
        const fos1 = document.getElementById('user_fos');

        if (!role1 || !fos1) {
            console.error("Elements with IDs 'user_role' or 'user_fos' not found.");
            return;
        }

        role1.addEventListener('change', function handleChange(event) {
            if (event.target.value !== '5') {
                fos1.style.display = 'none';
            } else {
                fos1.style.display = 'block';
            }
        });
    });
</script>



@include('component.footer')