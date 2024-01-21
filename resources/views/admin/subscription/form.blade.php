<div class="row">
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('email') }}
        {{ Form::email('email', $subscription->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email','required']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('start_date') }}
        {{ Form::text('start_date', date('m-d-Y', $subscription->start_date), ['class' => 'form-control start_date' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date','required']) }}
        {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('end_date') }}
        {{ Form::text('end_date', date('m-d-Y', $subscription->end_date), ['class' => 'form-control end_date' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date','required']) }}
        {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>