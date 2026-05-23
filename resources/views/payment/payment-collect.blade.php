@include('component.head')
@include('component.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payment</li>
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
                    <h3 class="card-title text-white">Payment</h3>

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
                <form action="" method="POST"  enctype='multipart/form-data'>
                    @csrf
                    @method('put')
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                        <div class="form-group col-md-12 text-center">
                               <img src="{{asset('uploads/image/'. $debit->image)}}"  width="250px" alt="">
                               <h5 class="pt-3" >Date : {{$debit->payment_date}}</h5>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="exampleInputUsername1">Company Name</label>
                            @php $company_name =  DB::table('companies')->where('id', $debit->company_id)->select('name')->first();  @endphp
                            <input type="text" class="form-control" value="{{$company_name->name}}"  disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputUsername1">Amount</label>
                                <input type="text" class="form-control"  value="{{$debit->total_amount}}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-3">Payment Mode</label>
                                <input type="text" class="form-control"  value="{{$debit->payment_mode}}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputUsername1">Transaction Id</label>
                                <input type="text" class="form-control"  value="{{$debit->transaction_id}}" disabled>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="input-3">Payment Collect</label>
                                <select class="form-control" name="payment_collect">
                                    <option disabled>Choose...</option>
                                    <option  {{ $debit->payment_collect === '1' ? 'selected' : '' }} value="1">Recieved</option>
                                    <option {{ $debit->payment_collect === '0' ? 'selected' : '' }} value="0">Pending</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputUsername1">Remarks</label>
                                <textarea class="form-control"  name="remarks"cols="30" rows="4">{{$debit->collect_remarks}}</textarea>
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