@include('component.table-head')
@include('component.header')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Commission</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            View Commission
                        </li>
                    </ol>
                </div>
            </div>

        </div>
    </section>

    <!-- Main Content -->
    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header bg-dark">

                    <h3 class="card-title text-white">
                        Commission List
                    </h3>

                    <div class="card-tools">
                        <a href="/add-commission" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Add Commission
                        </a>
                    </div>

                </div>

                <div class="card-body">

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Commission ID</th>
                                <th>Company</th>
                                <th>Amount</th>
                                <th>Remarks</th>
                                <th>Date</th>
                                <th>Created By</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($commissions as $key => $commission)

                                <tr>

                                    <td>{{ $key + 1 }}</td>

                                    <td>{{ $commission->topup_id }}</td>

                                    <td>{{ $commission->company_name }}</td>

                                    <td>₹ {{ number_format($commission->amount, 2) }}</td>

                                    <td>{{ $commission->topup_remarks }}</td>

                                    <td>{{ date('d-m-Y', strtotime($commission->date)) }}</td>

                                    <td>{{ $commission->approver_id }}</td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center">
                                        No Commission Found
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

@include('component.table-footer')