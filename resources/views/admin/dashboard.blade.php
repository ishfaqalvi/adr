@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Dashboard</span>
        </h4>
        <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="ph-atom ph-2x text-success me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($data['chemicals']) }}</h4>
                    <span class="text-muted">Total Chemicals</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <i class="ph-users ph-2x text-indigo me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($data['users']) }}</h4>
                    <span class="text-muted">Total Users</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">{{ number_format($data['invoices']) }}</h4>
                    <span class="text-muted">Total Invoices</span>
                </div>
                <i class="ph-notepad ph-2x text-primary ms-3"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">{{ number_format($data['subscription']) }}</h4>
                    <span class="text-muted">Total Subscription</span>
                </div>
                <i class="ph-package ph-2x text-danger ms-3"></i>
            </div>
        </div>
    </div>
</div>
@endsection