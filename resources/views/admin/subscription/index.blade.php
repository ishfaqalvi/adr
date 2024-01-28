@extends('admin.layout.app')

@section('title')
    Subscription
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Subscription Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('subscriptions-create')
            <a href="{{ route('subscriptions.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill me-2">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Create New
            </a>
            @endcan
            @can('subscriptions-create')
            <a href="#" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#import">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-microsoft-excel-logo"></i>
                </span>
                Import
            </a>
            <a href="{{ asset('sample.xlsx') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill" target="_blank">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-download-simple"></i>
                </span>
                Download Sample
            </a>
            @endcan
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Subscription</h5>
        </div>
        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Email</th>
					<th>Start Date</th>
					<th>End Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($subscriptions as $key => $subscription)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $subscription->email }}</td>
					<td>{{ date('d M Y', $subscription->start_date) }}</td>
					<td>{{ date('d M Y', $subscription->end_date) }}</td>
                    <td class="text-center">@include('admin.subscription.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.subscription.import')
@endsection

@section('script')
<script>
    $(function () {
        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });
        $(".sa-confirm").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.value === true)  $(this).closest("form").submit();
            });
        });
    });
</script>
@endsection