@include('component.head')
@include('component.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Consolidated Account Statement</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Statement</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

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

            <!-- Filter Card -->
            <div class="card card-default">
                <div class="card-header bg-dark">
                    <h3 class="card-title text-white">Filter Statement</h3>
                    <div class="card-tools text-white">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('consolidate-account-statement') }}" method="GET">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="from_date">From Date</label>
                                <input type="date" class="form-control" id="from_date" name="from_date" value="{{ $fromDate }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="to_date">To Date</label>
                                <input type="date" class="form-control" id="to_date" name="to_date" value="{{ $toDate }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="company_id">Company</label>
                                <select class="form-control" id="company_id" name="company_id">
                                    <option value="">All Companies</option>
                                    @foreach($companies as $c)
                                        <option value="{{ $c->id }}" @selected(request('company_id') == $c->id)>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Filter</button>
                        <a href="{{ route('consolidate-account-statement') }}" class="btn btn-default float-right">Reset</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->

            <!-- Summary Cards -->
            <div class="row">
                <div class="col-md-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4>{{ number_format($summary['total_topup'], 2) }}</h4>
                            <p>Total Topups (Approved)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h4>{{ number_format($summary['total_debit'], 2) }}</h4>
                            <p>Total Debits (Collected)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4>{{ number_format($summary['closing_balance'], 2) }}</h4>
                            <p>Closing Balance</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Company & Date-wise Summary -->
            <div class="card card-default">
                <div class="card-header bg-dark">
                    <h3 class="card-title text-white">Company &amp; Date-wise Summary</h3>
                    <div class="card-tools text-white">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Company Name</th>
                            <th>Credit (Topup)</th>
                            <th>Debit (Collected)</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($grouped as $g)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($g->date)->format('d-m-Y') }}</td>
                                <td>{{ $g->company_name }}</td>
                                <td>{{ number_format($g->credit, 2) }}</td>
                                <td>{{ number_format($g->debit, 2) }}</td>
                                <td>
                                    @if($g->total < 0)
                                        <small class="label bg-red p-1">{{ number_format($g->total, 2) }}</small>
                                    @else
                                        <small class="label bg-green p-1">{{ number_format($g->total, 2) }}</small>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No records found for the selected filters.</td>
                            </tr>
                        @endforelse
                        </tbody>
                        @if($grouped->isNotEmpty())
                        <tfoot>
                        <tr>
                            <th colspan="2">Grand Total</th>
                            <th>{{ number_format($grouped->sum('credit'), 2) }}</th>
                            <th>{{ number_format($grouped->sum('debit'), 2) }}</th>
                            <th>{{ number_format($grouped->sum('total'), 2) }}</th>
                        </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- Detailed Statement -->
            <div class="card card-default">
                <div class="card-header bg-dark">
                    <h3 class="card-title text-white">Detailed Statement</h3>
                    <div class="card-tools text-white">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Date</th>
                            <th>Topup ID</th>
                            <th>Company Name</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Balance</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $count = $statement->firstItem() ?? 1; @endphp
                        @forelse($statement as $row)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}</td>
                                <td>{{ $row->topup_id }}</td>
                                <td>{{ $row->company_name }}</td>
                                <td>
                                    @if($row->topup_type == '1')
                                        <small class="label bg-blue p-1">Topup Request</small>
                                    @else
                                        <small class="label bg-yellow p-1">Debit Payment</small>
                                    @endif
                                </td>
                                <td>{{ number_format($row->topup_type == '1' ? $row->amount : $row->total_amount, 2) }}</td>
                                <td>{{ number_format($row->total_balance, 2) }}</td>
                                <td>
                                    @if($row->topup_type == '1')
                                        @if($row->status == '1')
                                            <small class="label bg-green p-1">Approved</small>
                                        @elseif($row->status == '0')
                                            <small class="label bg-gray p-1">Pending</small>
                                        @else
                                            <small class="label bg-red p-1">Rejected</small>
                                        @endif
                                    @else
                                        @if($row->payment_collect == '1')
                                            <small class="label bg-green p-1">Collected</small>
                                        @else
                                            <small class="label bg-gray p-1">Pending Collection</small>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @php $count++; @endphp
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No records found for the selected filters.</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sr No.</th>
                            <th>Date</th>
                            <th>Topup ID</th>
                            <th>Company Name</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Balance</th>
                            <th>Status</th>
                        </tr>
                        </tfoot>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $statement->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('component.footer')