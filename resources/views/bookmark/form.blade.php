<div class="row">
      
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('user_id') }}
        {{ Form::text('user_id', $bookmark->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id','required']) }}
        {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('chemical_id') }}
        {{ Form::text('chemical_id', $bookmark->chemical_id, ['class' => 'form-control' . ($errors->has('chemical_id') ? ' is-invalid' : ''), 'placeholder' => 'Chemical Id','required']) }}
        {!! $errors->first('chemical_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>

      <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
            <button type="submit" class="btn btn-primary ms-3">
                Submit <i class="ph-paper-plane-tilt ms-2"></i>
            </button>
      </div>
 </div>
