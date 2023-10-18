@foreach ($groups as $group)
    <div class="tab-pane fade pt-3 {{ $loop->first ? 'active show' : '' }}"
        id="{{ $group->title }}-tab{{ $group->id }}" role="tabpanel">



        <form method="POST" action="{{ route('settings.save') }}" class="form-horizontal form-bordered" role="form"
            enctype="multipart/form-data">
            @csrf

            @foreach ($group->fields as $field)
                <div class="form-group row mt-2">
                    <label class="col-lg-2 col-form-label text-capitalize">{{ $field->label }}</label>

                    <div class="col-lg-8">

                        @if ($field->type == 'select')
                            <select class="form-control form-select" name="values[{{ $field->field_name }}]"
                                placeholder="{{ $field->placeholder }}" {{ $field->is_required ? 'required' : '' }}>
                                @foreach (explode(',', $field->options) as $option)
                                    <option>{{ $option }}</option>
                                @endforeach
                            </select>
                        @elseif ($field->type == 'textarea')
                            <textarea class="form-control" name="values[{{ $field->field_name }}]">{{ settings($group->title . '_' . $field->name) }}</textarea>
                        @else
                            <input type="{{ $field->type }}" class="form-control"
                                name="values[{{ $field->field_name }}]" placeholder="{{ $field->placeholder }}"
                                value="{{ settings($field->field_name) }}"
                                {{ $field->is_required ? 'required' : '' }}>
                        @endif
                    </div>

                    <div class="col-lg-2 text-center">
                        <button type="button" class="btn btn-danger delete-btn" data-id="{{ $field->id }}">Delete
                            Field <i class="ph-trash ms-2"></i></button>
                    </div>


                </div>
            @endforeach

            <div class="text-start mt-3">
                <button type="submit" class="btn btn-primary">Submit form <i
                        class="ph-paper-plane-tilt ms-2"></i></button>
            </div>
        </form>
    </div>
@endforeach
