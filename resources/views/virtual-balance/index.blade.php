@include('component.table-head')
@include('component.header')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Virtual Balance</h1>
    </section>

    <section class="content">

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- ADD BALANCE FORM -->
        <div class="card">
            <div class="card-header">
                <h3>Add Virtual Balance</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('virtual-balance.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Company</label>
                        <select name="company_id" class="form-control" required>
                            <option value="">Select Company</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Add Balance
                    </button>
                </form>
            </div>
        </div>

        <!-- TABLE -->
        <div class="card mt-4">
            <div class="card-header">
                <h3>Virtual Balance History</h3>
            </div>

            <div class="card-body table-responsive">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Amount</th>
                            <th>Remarks</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($virtual_balances as $vb)
                            <tr>
                                <td>{{ $vb->id }}</td>

                                {{-- Company name (better than ID) --}}
                                <td>
                                    {{ $vb->company_name ?? $vb->company_id }}
                                </td>

                                <td>{{ $vb->amount }}</td>

                                <td>{{ $vb->remarks ?? '-' }}</td>

                                {{-- FIXED: use created_at instead of missing date column --}}
                                <td>
                                    {{ \Carbon\Carbon::parse($vb->created_at)->format('d-m-Y') }}
                                </td>

                                <td>
                                    <a href="{{ route('virtual-balance.delete', $vb->id) }}"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this record?')">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No records found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>

    </section>
</div>

@include('component.table-footer')