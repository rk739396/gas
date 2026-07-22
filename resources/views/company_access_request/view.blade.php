@include('component.head')
@include('component.header')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Company Access Requests</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Pending / Approved Company Access Requests
                    </h3>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company</th>
                                <th>Retailer</th>
                                <th>Shop</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Request Date</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($requests as $row)

                                <tr>

                                    <td>{{ $row->id }}</td>

                                    <td>{{ $row->company_name }}</td>

                                    <td>{{ $row->retailer_name }}</td>

                                    <td>{{ $row->shop }}</td>

                                    <td>{{ $row->phone }}</td>

                                    <td>
                                        @if($row->status == 0)
                                            <span class="badge badge-warning">
                                                Pending
                                            </span>

                                        @elseif($row->status == 1)
                                            <span class="badge badge-success">
                                                Approved
                                            </span>

                                        @elseif($row->status == 2)
                                            <span class="badge badge-danger">
                                                Rejected
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ date('d M Y h:i A', strtotime($row->created_at)) }}
                                    </td>

                                    <td>

                                        @if($row->status == 0)

                                            <a href="{{ route('approve-company-access-request',$row->id) }}"
                                               class="btn btn-success btn-sm"
                                               onclick="return confirm('Are you sure you want to approve this request?')">
                                                Approve
                                            </a>

                                            <a href="{{ route('reject-company-access-request',$row->id) }}"
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to reject this request?')">
                                                Reject
                                            </a>

                                        @elseif($row->status == 1)

                                            <span class="badge badge-success">
                                                Approved
                                            </span>

                                        @elseif($row->status == 2)

                                            <span class="badge badge-danger">
                                                Rejected
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="text-center">
                                        No Company Access Requests Found
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

@include('component.footer')