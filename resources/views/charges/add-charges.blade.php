@include('component.head')
@include('component.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Charges To Retailer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Charges To Retailer</li>
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
                    <h3 class="card-title text-white">Charges To Retailer</h3>

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
                <div class="alert my-3 p-3 alert-danger">
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
                <form action="{{route('save-charges')}}" method="POST">
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                        <div class="form-group col-md-12">
                                <label for="input-3">Retailer Name</label>
                                <select class="form-control"  name="retailer_id">
                                    <option value="" >Choose...</option>
                                    @foreach($retailer as $retailers)
                                    <option value="{{$retailers->user_id}}">{{$retailers->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="form-group col-md-12">
                                <label for="input-3">Company Name</label>
                                <select class="form-control" id="company_id" name="company_id">
                                    <option value="" >Choose...</option>
                                    @foreach($company as $companies)
                                    <option value="{{$companies->id}}">{{$companies->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="exampleInputUsername1">Amount</label>
                                <input type="text" class="form-control" name="ch_amount" placeholder="Enter Amount">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="input-3">Operation</label>
                                <select class="form-control"  name="operation">
                                    <option disabled>Choose...</option>
                                    <option value="add">Credit</option>
                                    <option value="sub">Debit</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="exampleInputUsername1">Remarks</label>
                                <textarea class="form-control"  name="remarks" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Credit Charges</button>
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
