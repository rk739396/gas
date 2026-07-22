@include('component.table-head')
@include('component.header')

<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Add Commission</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Commission
                        </li>
                    </ol>
                </div>

            </div>

        </div>
    </section>

    <!-- Main Content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header bg-dark">

                            <h3 class="card-title text-white">
                                Add Commission
                            </h3>

                        </div>

                        @if(session('status'))
                            <div class="alert alert-success m-3">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger m-3">

                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach

                            </div>
                        @endif

                        <form action="{{ route('save-commission') }}" method="POST">

                            @csrf

                            <div class="card-body">

                                <div class="row">

                                    <!-- Company -->
                                    <div class="form-group col-md-6">
                                        <label>Company</label>

                                        <select name="company_id" class="form-control" required>
                                            <option value="">Select Company</option>

                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Commission Amount -->
                                    <div class="form-group col-md-6">
                                        <label>Commission Amount</label>

                                        <input type="number"
                                               name="amount"
                                               step="0.01"
                                               class="form-control"
                                               value="{{ old('amount') }}"
                                               required>
                                    </div>

                                    <!-- Date -->
                                    <div class="form-group col-md-6">
                                        <label>Date</label>

                                        <input type="date"
                                               name="date"
                                               value="{{ old('date', date('Y-m-d')) }}"
                                               class="form-control">
                                    </div>

                                    <!-- Remarks -->
                                    <div class="form-group col-md-12">
                                        <label>Remarks</label>

                                        <textarea name="topup_remarks"
                                                  rows="4"
                                                  class="form-control">{{ old('topup_remarks') }}</textarea>
                                    </div>

                                </div>

                            </div>

                            <div class="card-footer">

                                <button type="submit" class="btn btn-success">
                                    Save Commission
                                </button>

                                <button type="reset" class="btn btn-secondary float-right">
                                    Reset
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

@include('component.table-footer')