@extends('admin.layout.app')

@section('title')
    {{ __('Show Shipment') }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Shipment Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('invoices.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                Back
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Show') }} Shipment</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>User:</strong>
                {{ $invoice->user->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Consignee:</strong>
                {{ $invoice->consignee->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Shipment Type:</strong>
                {{ $invoice->shipment_type }}
            </div>
            <div class="form-group mb-3">
                <strong>Invoice Date:</strong>
                {{ $invoice->invoice_date }}
            </div>
            <div class="form-group mb-3">
                <strong>File:</strong>
                {{ $invoice->file }}
            </div>
            <div class="form-group mb-3">
                <strong>Total Points:</strong>
                {{ $invoice->total_points }}
            </div>
            <div class="form-group mb-3">
                <strong>Status:</strong>
                {{ $invoice->status }}
            </div>
            @foreach($invoice->invoiceItems()->get() as $item)
                <div class="card card-body">
                    <div class="d-sm-flex align-items-lg-start text-center text-lg-start">
                        <div class="flex-fill">
                            <h6 class="mb-1">
                                <a href="#">{{ $item->chemical->un_number }}</a>
                            </h6>
                            <p class="mb-3">{{ $item->chemical->name_en }}</p>
                            <p class="mb-3">{{ $item->chemical->name_it }}</p>
                        </div>
                        <div class="flex-shrink-0 text-center mt-3 mt-lg-0 ms-lg-3">
                            <h5 class="mb-0">Points = {{ $item->point }}</h5>
                            <div class="text-muted">{{ $item->quantity }} Quantity</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection