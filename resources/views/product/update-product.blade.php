@include('component.head')
@include('component.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Product Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Product Detail</li>
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
                    <h3 class="card-title text-white">Update Product Detail</h3>

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
<form action="" method="POST"  enctype='multipart/form-data'>
     @csrf
     @method('put')
                    <!-- /.card-header -->
        <div class="card-body">
             <div class="row">
           <div class="form-group col-md-6">
            <label for="input-1">Product Name</label>
            <input type="text" class="form-control" id="input-1" name="product_name" value="{{$product->product_name}}">
             @error('product_name')
            <span class="text-danger"> {{$message}}</span>
            @enderror
           </div>
           <div class="form-group col-md-6">
            <label for="input-1">Product Code</label>
            <input type="text" class="form-control" id="input-1" name="product_code" value="{{$product->product_code}}">
           </div>
           <div class="form-group col-md-6">
            <label for="input-1">Category</label>
            <input type="text" class="form-control" id="input-1" name="category" value="{{$product->category}}" required>
           </div>
           <div class="form-group col-md-6">
            <label for="input-1">Brand</label>
            <input type="text" class="form-control" id="input-1" name="brand" value="{{$product->brand}}" required>
           </div>
           <div class="form-group col-md-12">
            <label for="input-3">Product Image</label>
            <input type="file" class="form-control" value="{{$product->image}}" id="input-3" name="image" >
           </div>
           <div class="form-group col-md-12">
            <label for="input-4">Available Quantity</label>
            <input type="text" class="form-control" id="input-4" value="{{$product->available_quantity}}" name="available_quantity">
           </div>
           <div class="form-group col-md-12">
            <label for="input-4">Product Price</label>
            <input type="text" class="form-control" id="input-4" value="{{$product->price}}" name="price">
           </div>
           <div class="form-group col-md-12">
            <label for="exampleInputUsername1">Details</label>
            <textarea class="form-control"  name="detail" cols="30" rows="3">{{$product->detail}}</textarea>
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