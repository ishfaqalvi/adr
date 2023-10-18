<div class="row">
      
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('un_number') }}
        {{ Form::text('un_number', $chemical->un_number, ['class' => 'form-control' . ($errors->has('un_number') ? ' is-invalid' : ''), 'placeholder' => 'Un Number','required']) }}
        {!! $errors->first('un_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('name_en') }}
        {{ Form::text('name_en', $chemical->name_en, ['class' => 'form-control' . ($errors->has('name_en') ? ' is-invalid' : ''), 'placeholder' => 'Name En','required']) }}
        {!! $errors->first('name_en', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('name_it') }}
        {{ Form::text('name_it', $chemical->name_it, ['class' => 'form-control' . ($errors->has('name_it') ? ' is-invalid' : ''), 'placeholder' => 'Name It','required']) }}
        {!! $errors->first('name_it', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('class') }}
        {{ Form::text('class', $chemical->class, ['class' => 'form-control' . ($errors->has('class') ? ' is-invalid' : ''), 'placeholder' => 'Class','required']) }}
        {!! $errors->first('class', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('classification_code') }}
        {{ Form::text('classification_code', $chemical->classification_code, ['class' => 'form-control' . ($errors->has('classification_code') ? ' is-invalid' : ''), 'placeholder' => 'Classification Code','required']) }}
        {!! $errors->first('classification_code', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('packing_group') }}
        {{ Form::text('packing_group', $chemical->packing_group, ['class' => 'form-control' . ($errors->has('packing_group') ? ' is-invalid' : ''), 'placeholder' => 'Packing Group','required']) }}
        {!! $errors->first('packing_group', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('label') }}
        {{ Form::text('label', $chemical->label, ['class' => 'form-control' . ($errors->has('label') ? ' is-invalid' : ''), 'placeholder' => 'Label','required']) }}
        {!! $errors->first('label', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('special_provisions') }}
        {{ Form::text('special_provisions', $chemical->special_provisions, ['class' => 'form-control' . ($errors->has('special_provisions') ? ' is-invalid' : ''), 'placeholder' => 'Special Provisions','required']) }}
        {!! $errors->first('special_provisions', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('limited') }}
        {{ Form::text('limited', $chemical->limited, ['class' => 'form-control' . ($errors->has('limited') ? ' is-invalid' : ''), 'placeholder' => 'Limited','required']) }}
        {!! $errors->first('limited', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('expected_quantities') }}
        {{ Form::text('expected_quantities', $chemical->expected_quantities, ['class' => 'form-control' . ($errors->has('expected_quantities') ? ' is-invalid' : ''), 'placeholder' => 'Expected Quantities','required']) }}
        {!! $errors->first('expected_quantities', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('packing_instruction') }}
        {{ Form::text('packing_instruction', $chemical->packing_instruction, ['class' => 'form-control' . ($errors->has('packing_instruction') ? ' is-invalid' : ''), 'placeholder' => 'Packing Instruction','required']) }}
        {!! $errors->first('packing_instruction', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('special_packing_provision') }}
        {{ Form::text('special_packing_provision', $chemical->special_packing_provision, ['class' => 'form-control' . ($errors->has('special_packing_provision') ? ' is-invalid' : ''), 'placeholder' => 'Special Packing Provision','required']) }}
        {!! $errors->first('special_packing_provision', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('mixed_packing_provision') }}
        {{ Form::text('mixed_packing_provision', $chemical->mixed_packing_provision, ['class' => 'form-control' . ($errors->has('mixed_packing_provision') ? ' is-invalid' : ''), 'placeholder' => 'Mixed Packing Provision','required']) }}
        {!! $errors->first('mixed_packing_provision', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('instructions') }}
        {{ Form::text('instructions', $chemical->instructions, ['class' => 'form-control' . ($errors->has('instructions') ? ' is-invalid' : ''), 'placeholder' => 'Instructions','required']) }}
        {!! $errors->first('instructions', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('p_tank_special_provisions') }}
        {{ Form::text('p_tank_special_provisions', $chemical->p_tank_special_provisions, ['class' => 'form-control' . ($errors->has('p_tank_special_provisions') ? ' is-invalid' : ''), 'placeholder' => 'P Tank Special Provisions','required']) }}
        {!! $errors->first('p_tank_special_provisions', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('tank_code') }}
        {{ Form::text('tank_code', $chemical->tank_code, ['class' => 'form-control' . ($errors->has('tank_code') ? ' is-invalid' : ''), 'placeholder' => 'Tank Code','required']) }}
        {!! $errors->first('tank_code', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('ard_special_provisions') }}
        {{ Form::text('ard_special_provisions', $chemical->ard_special_provisions, ['class' => 'form-control' . ($errors->has('ard_special_provisions') ? ' is-invalid' : ''), 'placeholder' => 'Ard Special Provisions','required']) }}
        {!! $errors->first('ard_special_provisions', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('vehicle_for_tank_carriage') }}
        {{ Form::text('vehicle_for_tank_carriage', $chemical->vehicle_for_tank_carriage, ['class' => 'form-control' . ($errors->has('vehicle_for_tank_carriage') ? ' is-invalid' : ''), 'placeholder' => 'Vehicle For Tank Carriage','required']) }}
        {!! $errors->first('vehicle_for_tank_carriage', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('trc_transport_category') }}
        {{ Form::text('trc_transport_category', $chemical->trc_transport_category, ['class' => 'form-control' . ($errors->has('trc_transport_category') ? ' is-invalid' : ''), 'placeholder' => 'Trc Transport Category','required']) }}
        {!! $errors->first('trc_transport_category', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('packages') }}
        {{ Form::text('packages', $chemical->packages, ['class' => 'form-control' . ($errors->has('packages') ? ' is-invalid' : ''), 'placeholder' => 'Packages','required']) }}
        {!! $errors->first('packages', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('bulk') }}
        {{ Form::text('bulk', $chemical->bulk, ['class' => 'form-control' . ($errors->has('bulk') ? ' is-invalid' : ''), 'placeholder' => 'Bulk','required']) }}
        {!! $errors->first('bulk', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('loading_unloading_handling') }}
        {{ Form::text('loading_unloading_handling', $chemical->loading_unloading_handling, ['class' => 'form-control' . ($errors->has('loading_unloading_handling') ? ' is-invalid' : ''), 'placeholder' => 'Loading Unloading Handling','required']) }}
        {!! $errors->first('loading_unloading_handling', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('operation') }}
        {{ Form::text('operation', $chemical->operation, ['class' => 'form-control' . ($errors->has('operation') ? ' is-invalid' : ''), 'placeholder' => 'Operation','required']) }}
        {!! $errors->first('operation', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('hazard_identification_no') }}
        {{ Form::text('hazard_identification_no', $chemical->hazard_identification_no, ['class' => 'form-control' . ($errors->has('hazard_identification_no') ? ' is-invalid' : ''), 'placeholder' => 'Hazard Identification No','required']) }}
        {!! $errors->first('hazard_identification_no', '<div class="invalid-feedback">:message</div>') !!}
    </div>

      <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
            <button type="submit" class="btn btn-primary ms-3">
                Submit <i class="ph-paper-plane-tilt ms-2"></i>
            </button>
      </div>
 </div>
