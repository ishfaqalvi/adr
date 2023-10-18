<div class="row">
      
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('invoice_id') }}
        {{ Form::text('invoice_id', $invoiceItem->invoice_id, ['class' => 'form-control' . ($errors->has('invoice_id') ? ' is-invalid' : ''), 'placeholder' => 'Invoice Id','required']) }}
        {!! $errors->first('invoice_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('chemical_id') }}
        {{ Form::text('chemical_id', $invoiceItem->chemical_id, ['class' => 'form-control' . ($errors->has('chemical_id') ? ' is-invalid' : ''), 'placeholder' => 'Chemical Id','required']) }}
        {!! $errors->first('chemical_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('point') }}
        {{ Form::text('point', $invoiceItem->point, ['class' => 'form-control' . ($errors->has('point') ? ' is-invalid' : ''), 'placeholder' => 'Point','required']) }}
        {!! $errors->first('point', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('quantity') }}
        {{ Form::text('quantity', $invoiceItem->quantity, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Quantity','required']) }}
        {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
    </div>

      <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
            <button type="submit" class="btn btn-primary ms-3">
                Submit <i class="ph-paper-plane-tilt ms-2"></i>
            </button>
      </div>
 </div>
