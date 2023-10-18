@extends('admin.layout.app')

@section('title')
    Show Chemical
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Chemical Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('chemicals.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Chemical</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>Un Number:</strong>
                {{ $chemical->un_number }}
            </div>
            <div class="form-group mb-3">
                <strong>Name En:</strong>
                {{ $chemical->name_en }}
            </div>
            <div class="form-group mb-3">
                <strong>Name It:</strong>
                {{ $chemical->name_it }}
            </div>
            <div class="form-group mb-3">
                <strong>Class:</strong>
                {{ $chemical->class }}
            </div>
            <div class="form-group mb-3">
                <strong>Classification Code:</strong>
                {{ $chemical->classification_code }}
            </div>
            <div class="form-group mb-3">
                <strong>Packing Group:</strong>
                {{ $chemical->packing_group }}
            </div>
            <div class="form-group mb-3">
                <strong>Label:</strong>
                {{ $chemical->label }}
            </div>
            <div class="form-group mb-3">
                <strong>Special Provisions:</strong>
                {{ $chemical->special_provisions }}
            </div>
            <div class="form-group mb-3">
                <strong>Limited:</strong>
                {{ $chemical->limited }}
            </div>
            <div class="form-group mb-3">
                <strong>Expected Quantities:</strong>
                {{ $chemical->expected_quantities }}
            </div>
            <div class="form-group mb-3">
                <strong>Packing Instruction:</strong>
                {{ $chemical->packing_instruction }}
            </div>
            <div class="form-group mb-3">
                <strong>Special Packing Provision:</strong>
                {{ $chemical->special_packing_provision }}
            </div>
            <div class="form-group mb-3">
                <strong>Mixed Packing Provision:</strong>
                {{ $chemical->mixed_packing_provision }}
            </div>
            <div class="form-group mb-3">
                <strong>Instructions:</strong>
                {{ $chemical->instructions }}
            </div>
            <div class="form-group mb-3">
                <strong>P Tank Special Provisions:</strong>
                {{ $chemical->p_tank_special_provisions }}
            </div>
            <div class="form-group mb-3">
                <strong>Tank Code:</strong>
                {{ $chemical->tank_code }}
            </div>
            <div class="form-group mb-3">
                <strong>Ard Special Provisions:</strong>
                {{ $chemical->ard_special_provisions }}
            </div>
            <div class="form-group mb-3">
                <strong>Vehicle For Tank Carriage:</strong>
                {{ $chemical->vehicle_for_tank_carriage }}
            </div>
            <div class="form-group mb-3">
                <strong>Trc Transport Category:</strong>
                {{ $chemical->trc_transport_category }}
            </div>
            <div class="form-group mb-3">
                <strong>Packages:</strong>
                {{ $chemical->packages }}
            </div>
            <div class="form-group mb-3">
                <strong>Bulk:</strong>
                {{ $chemical->bulk }}
            </div>
            <div class="form-group mb-3">
                <strong>Loading Unloading Handling:</strong>
                {{ $chemical->loading_unloading_handling }}
            </div>
            <div class="form-group mb-3">
                <strong>Operation:</strong>
                {{ $chemical->operation }}
            </div>
            <div class="form-group mb-3">
                <strong>Hazard Identification No:</strong>
                {{ $chemical->hazard_identification_no }}
            </div>
        </div>
    </div>
</div>
@endsection