<div class="row">
      
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('user_id') }}
        {{ Form::text('user_id', $invoice->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id','required']) }}
        {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('consignee_id') }}
        {{ Form::text('consignee_id', $invoice->consignee_id, ['class' => 'form-control' . ($errors->has('consignee_id') ? ' is-invalid' : ''), 'placeholder' => 'Consignee Id','required']) }}
        {!! $errors->first('consignee_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('shipment_type') }}
        {{ Form::text('shipment_type', $invoice->shipment_type, ['class' => 'form-control' . ($errors->has('shipment_type') ? ' is-invalid' : ''), 'placeholder' => 'Shipment Type','required']) }}
        {!! $errors->first('shipment_type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('invoice_date') }}
        {{ Form::text('invoice_date', $invoice->invoice_date, ['class' => 'form-control' . ($errors->has('invoice_date') ? ' is-invalid' : ''), 'placeholder' => 'Invoice Date','required']) }}
        {!! $errors->first('invoice_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('file') }}
        {{ Form::text('file', $invoice->file, ['class' => 'form-control' . ($errors->has('file') ? ' is-invalid' : ''), 'placeholder' => 'File','required']) }}
        {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('total_points') }}
        {{ Form::text('total_points', $invoice->total_points, ['class' => 'form-control' . ($errors->has('total_points') ? ' is-invalid' : ''), 'placeholder' => 'Total Points','required']) }}
        {!! $errors->first('total_points', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('status') }}
        {{ Form::text('status', $invoice->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status','required']) }}
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>

      <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
            <button type="submit" class="btn btn-primary ms-3">
                Submit <i class="ph-paper-plane-tilt ms-2"></i>
            </button>
      </div>
 </div>
