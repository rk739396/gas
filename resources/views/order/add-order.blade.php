@include('component.head')
@include('component.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Order Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Order Detail</li>
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
                    <h3 class="card-title text-white">Add Order Detail</h3>

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
<form action="{{route('save-order')}}" method="POST"  enctype='multipart/form-data'>
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
            <div class="row">
            <div class="form-group col-md-4">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" name="retailer_name" placeholder="Enter Your Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Mobile Number</label>
                                <input type="text" class="form-control" name="phone" placeholder="Enter Your Number">
                            </div>
           <div class="form-group col-md-12">
            <label for="input-1">Required Date</label>
            <input type="date" class="form-control" id="input-1" name="required_date" placeholder="Enter Date">
           </div>
           <div class="form-group col-md-6">
            <label for="exampleInputUsername1">Address</label>
            <textarea class="form-control"  name="address" cols="30" rows="3"></textarea>
            </div>
            <div class="form-group col-md-6">
            <label for="exampleInputUsername1">Details</label>
            <textarea class="form-control"  name="detail" cols="30" rows="3"></textarea>
            </div>
           <div class="card  col-md-12">
        <div class="card-header">
            Order Product
        </div>

    <div class="card-body">
            <table class="table" id="products_table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="product0">
                        <td>
                            <select name="products[]" class="form-control">
                                <option value="">-- Choose product --</option>
                                @foreach ($product as $products)
                                    <option value="{{$products->id}}">
                                        {{$products->product_name}} (Brand : {{$products->brand}} , PP : {{$products->price}}) 
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="quantitiess[]" class="form-control" value="1" />
                        </td>
                    </tr>
                    <tr id="product1"></tr>
                </tbody>
            </table>

            <div class="row mt-4">
                <div class="col-md-12">
                    <button id="add_row1" class="btn btn-success pull-left">+ Add Row</button>
                    <button id='delete_row1' class="pull-right btn btn-danger">- Delete Row</button>
                </div>
            </div>
        </div>
    </div>
           </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Save Product</button>
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