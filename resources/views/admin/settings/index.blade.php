@extends('admin.layout.app')

@section('title', 'Settings')

@section('header')
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Home - <span class="fw-normal">Settings</span>
            </h4>
        </div>
        {{-- @can('users-create') --}}
        <div class="d-lg-block my-lg-auto ms-lg-auto">
            <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
                <button class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill" data-bs-toggle="modal"
                    data-bs-target="#modal_default">
                    <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                        <i class="ph-plus"></i>
                    </span>
                    Create Setting Fields
                </button>
            </div>
        </div>
        {{-- @endcan --}}
    </div>
@endsection

@section('content')



    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight" role="tablist">

                    @foreach ($groups as $group)
                        <li class="nav-item" role="presentation">
                            <a href="#{{ $group->title }}-tab{{ $group->id }}"
                                class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                aria-selected="true" role="tab">
                                {{-- <i class="ph-user-circle me-2"></i> --}}
                                {{ $group->title }}
                            </a>
                        </li>
                    @endforeach


                </ul>

                <div class="tab-content flex-lg-fill">

                    @include('admin.settings.form')

                </div>

            </div>
        </div>
    </div>

    @include('admin.settings.create-field')

@endsection

@section('script')
    <link rel="stylesheet" href="{{ asset('assets/js/vendor/tagify/tagify.css') }}">
    <script src="{{ asset('assets/js/vendor/tagify/tagify.js') }}"></script>
    <script>
        $(function() {
            const tagifyBasicEl = document.querySelector('#options');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $(".select").select2({
                dropdownParent: $("#modal_default"),
                placeholder: 'Select type',

            }).on('select2:close', function() {
                var el = $(this);
                if (el.val() === "NEW") {
                    let newval = prompt("Enter new value: ");
                    if (newval !== null) {
                        $.ajax({
                            url: "add-group",
                            method: "POST",
                            data: {
                                title: newval,
                            },
                            success: function(data) {
                                // Handle the data (e.g., update the DOM)
                                if (data.success) {
                                    el.append('<option>' + newval + '</option>')
                                        .val(newval);
                                }
                            },
                            error: function(error) {
                                // Handle errors
                                console.error(error);
                            },
                        });
                    }
                }
            });

            $('#type').on('change', function() {
                const selectedValue = $(this).val();
                const optionsDiv = $('#options-div');
                const optionsInput = $("#options");
                const placeholderInput = $("#placeholder");
                const editorDiv = $("#editor-div");
                const editorInput = $("#editor");

                optionsDiv.toggleClass('d-none', selectedValue != 'select');
                optionsInput.prop("disabled", selectedValue != 'select');
                editorDiv.toggleClass('d-none', selectedValue != 'textarea');
                editorInput.prop("disabled", selectedValue != 'textarea');

                placeholderInput.prop("disabled", selectedValue === 'select' || selectedValue ===
                    'textarea' || selectedValue === 'file' || selectedValue === 'number');

                if (selectedValue === 'select') {
                    const TagifyBasic = new Tagify(tagifyBasicEl);
                }

            });

            $('.select').val(null).trigger('change');

            $('.delete-btn').on('click', function() {
                let id = $(this).data("id");
                $.ajax({
                    url: "fields" + '/' + id,
                    type: "DELETE",
                    success: function(data) {
                        // Handle the data (e.g., update the DOM)
                        if (data.success) {
                            location.reload();
                        }
                    },
                    error: function(error) {
                        // Handle errors
                        console.error(error);
                    },
                });
            });

            jQuery.validator.addMethod("noSpace", function(value, element) {
                return value.indexOf(" ") < 0 && value != "" && value.match(/^[a-z_]+$/);;
            }, "Only use small letter seprated with _");

            $('.validate').validate({
                errorClass: 'validation-invalid-label',
                successClass: 'validation-valid-label',
                validClass: 'validation-valid-label',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                    $(element).addClass('is-invalid');
                    $(element).removeClass('is-valid');
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                    $(element).removeClass('is-invalid');
                    $(element).addClass('is-valid');
                },
                success: function(label) {
                    label.addClass('validation-valid-label').text('Success.');
                },
                errorPlacement: function(error, element) {
                    if (element.hasClass('select2-hidden-accessible')) {
                        error.appendTo(element.parent());
                    } else if (element.parents().hasClass('form-control-feedback') || element
                        .parents().hasClass('form-check') || element.parents().hasClass(
                            'input-group')) {
                        error.appendTo(element.parent().parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    name: {
                        noSpace: true
                    }
                }
            });
        })
    </script>
@endsection
