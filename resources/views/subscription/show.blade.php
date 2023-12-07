@extends('admin.layout.app')

@section('title')
    {{ $subscription->name ?? "{{ __('Show') Subscription" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Subscription Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('subscriptions.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Subscription</h5>
        </div>
        <div class="card-body d-flex justify-content-around">
            <div class="form-group d-flex flex-column">
                 
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $subscription->email }}
                        </div>
                        <div class="form-group">
                            <strong>Start Date:</strong>
                            {{ $subscription->start_date }}
                        </div>
                        <div class="form-group">
                            <strong>End Date:</strong>
                            {{ $subscription->end_date }}
                        </div>

            </div>

        </div>
    </div>
</div>
@endsection
