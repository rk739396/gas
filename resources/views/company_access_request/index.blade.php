@include('component.head')
@include('component.header')

<div class="content-wrapper">

```
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Company Access Request</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Company Access Request</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="container-fluid">

        @if(session()->has('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <div class="card">
            <div class="card-header bg-dark">
                <h3 class="card-title text-white">
                    Available Companies
                </h3>
            </div>

            <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Company Name</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @php $count = 1; @endphp

                        @foreach($companies as $company)

                        @php

                        $accessRequest =
                        App\Models\CompanyAccessRequest::where(
                            'company_id',
                            $company->id
                        )
                        ->where(
                            'user_id',
                            session('loginUser')
                        )
                        ->first();

                        @endphp

                        <tr>

                            <td>{{ $count++ }}</td>

                            <td>{{ $company->name }}</td>

                            <td>{{ $company->amount }}</td>

                            <td>

                                @if(!$accessRequest)

                                <form action="{{ route('save-company-access-request') }}" method="POST">
                                    @csrf

                                    <input type="hidden"
                                        name="company_id"
                                        value="{{ $company->id }}">

                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-sm">

                                        Send Request

                                    </button>
                                </form>

                                @elseif($accessRequest->status == 0)

                                <span class="badge badge-warning">
                                    Pending
                                </span>

                                @elseif($accessRequest->status == 1)

                                <span class="badge badge-success">
                                    Approved
                                </span>

                                @else

                                <span class="badge badge-danger">
                                    Rejected
                                </span>

                                @endif

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>
```

</div>

@include('component.footer')
